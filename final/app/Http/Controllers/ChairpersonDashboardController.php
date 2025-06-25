<?php

namespace App\Http\Controllers;

use App\Mail\TaskAssignedMail;
use App\Models\Attachment;
use App\Models\Department;
use App\Models\Task;
use App\Models\User;
use App\Models\Status;
use App\Models\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\Task_User;

class ChairpersonDashboardController extends Controller
{
    // Cache status IDs to avoid repeated queries
    protected $statusIds = [];

    public function __construct()
    {
        $this->statusIds = [
            'completed' => Status::firstOrCreate(['name' => 'completed'])->id,
            'pending_approval' => Status::firstOrCreate(['name' => 'pending_approval'])->id,
            'pending' => Status::firstOrCreate(['name' => 'pending'])->id,
            'rejected' => Status::firstOrCreate(['name' => 'rejected'])->id,
            'in_progress' => Status::firstOrCreate(['name' => 'in_progress'])->id,
        ];
    }

    public function index()
    {
        // Get the authenticated user's department ID
        $userDepartmentId = Auth::user()->department_id;

        // Base query for tasks in the same department
        $departmentTasksQuery = function ($query) use ($userDepartmentId) {
            $query->whereHas('users', function ($q) use ($userDepartmentId) {
                $q->where('department_id', $userDepartmentId);
            });
        };

        // Get total tasks count for the user's department
        $totalTasks = Task::where('created_by', Auth::id())
            ->whereHas('users', function ($query) use ($userDepartmentId) {
                $query->where('department_id', $userDepartmentId);
            })
            ->count();

        // Get overdue tasks created by the authenticated user
        $overdueTasks = Task::where('created_by', Auth::id())
            ->where('due_date', '<', now())
            ->whereHas('users', function ($query) use ($userDepartmentId) {
                $query->where('department_id', $userDepartmentId)
                    ->where('status_id', '!=', $this->statusIds['completed']);
            })
            ->count();

        // Get completed tasks created by the authenticated user
        $completedTasks = Task::where('created_by', Auth::id())
            ->whereHas('users', function ($query) use ($userDepartmentId) {
                $query->where('department_id', $userDepartmentId)
                    ->where('status_id', $this->statusIds['pending']);
            })
            ->count();

        // Get pending approvals in the user's department
        $pendingApprovals = Task::whereHas('users', function ($query) use ($userDepartmentId) {
            $query->where('department_id', $userDepartmentId);
        })
            ->whereHas('users', function ($query) {
                $query->where('status_id', $this->statusIds['pending_approval']);
            })
            ->with([
                'priority',
                'creator',
                'users' => function ($query) {
                    $query->withPivot('status_id');
                }
            ])
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get()
            ->map(function ($task) {
                $task->current_status = Status::find($task->users->first()->pivot->status_id ?? null);
                return $task;
            });
        $teamMembers = User::where('department_id', Auth::user()->department_id)
            ->where('id', '!=', Auth::id())
            ->withCount([
                'tasks as completed_tasks' => function ($query) use ($userDepartmentId) {
                    $query->whereHas('users', function ($q) use ($userDepartmentId) {
                        $q->where('department_id', $userDepartmentId);
                    })
                        ->where('status_id', $this->statusIds['completed']);
                },
                'tasks as overdue_tasks' => function ($query) use ($userDepartmentId) {
                    $query->whereHas('users', function ($q) use ($userDepartmentId) {
                        $q->where('department_id', $userDepartmentId);
                    })
                        ->where('due_date', '<', now())
                        ->where('status_id', '!=', $this->statusIds['completed']);
                }
            ])
            ->orderBy('completed_tasks', 'desc')
            ->take(4)
            ->get();
        $teamMembersCount = User::where('id', '!=', Auth::id())
            ->where('role_id', '!=', 1) // Exclude users with role 1 (admin)
            ->count();

        // Get upcoming deadlines (tasks due in the next 7 days)
        $upcomingDeadlines = Task::whereBetween('due_date', [now(), now()->addDays(7)])
            ->where(function ($query) use ($userDepartmentId) {
                // Tasks assigned to users in the same department
                $query->whereHas('users', function ($q) use ($userDepartmentId) {
                    $q->where('department_id', $userDepartmentId);
                })
                    // OR tasks created by users in the same department
                    ->orWhereHas('creator', function ($q) use ($userDepartmentId) {
                    $q->where('department_id', $userDepartmentId);
                });
            })
            ->with([
                'priority',
                'creator', // Include creator relationship
                'assignees' => function ($query) {
                    $query->withPivot('status_id');
                }
            ])
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get()
            ->map(function ($task) {
                $task->current_status = Status::find($task->assignees->first()->pivot->status_id ?? null);
                return $task;
            });

        $recentActivity = Task::with([
            'creator',
            'users' => function ($query) {
                $query->withPivot('status_id');
            }
        ])
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($task) {
                $task->current_status = Status::find($task->users->first()->pivot->status_id ?? null);
                return $task;
            });
        // Continue with the rest of your queries, modifying each to include the department filter
        // ...

        return view('chairperson.dashboard2', compact(
            'totalTasks',
            'overdueTasks',
            'completedTasks',
            'teamMembersCount',
            'pendingApprovals',
            'recentActivity',
            'teamMembers',
            'upcomingDeadlines'
        ));
    }

    public function pendingApprovals()
    {
        $pendingApprovals = Task::whereHas('users', function ($query) {
            $query->where('status_id', $this->statusIds['pending_approval']);
        })
            ->with([
                'priority',
                'creator',
                'users' => function ($query) {
                    $query->withPivot('status_id');
                }
            ])
            ->orderBy('due_date', 'asc')
            ->paginate(10)
            ->through(function ($task) {
                $task->current_status = Status::find($task->users->first()->pivot->status_id ?? null);
                return $task;
            });

        return view('chairperson.pending-approvals', compact('pendingApprovals'));
    }

    public function reviewTask($id)
    {
        $task = Task::with([
            'priority',
            'creator',
            'assignees' => function ($query) {
                $query->withPivot('status_id');
            },
            'comments.user',
            'attachments'
        ])
            ->findOrFail($id);

        $task->current_status = Status::find($task->assignees->first()->pivot->status_id ?? null);



        return view('chairperson.task-review', compact('task'));
    }

    public function approveTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->users()->updateExistingPivot(Auth::id(), [
            'status_id' => $this->statusIds['completed']
        ]);

        return redirect()->route('chairperson.dashboard')->with('success', 'Task approved successfully!');
    }

    public function rejectTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->users()->updateExistingPivot(Auth::id(), [
            'status_id' => $this->statusIds['pending']
        ]);

        return redirect()->route('chairperson.dashboard')->with('success', 'Task rejected and sent back for revision!');
    }

    public function teamPerformance()
    {
        $departmentId = Auth::user()->department_id;

        $teamMembers = User::where('department_id', $departmentId)
            ->with([
                'tasks' => function ($query) {
                    $query->withPivot('status_id');
                }
            ])
            ->where('id', '!=', Auth::id())
            ->where('id', '!=', 1) // Exclude users with user_id 1
            ->withCount([
                'tasks as completed_tasks' => function ($query) {
                    $query->where('status_id', $this->statusIds['completed']);
                },
                'tasks as overdue_tasks' => function ($query) {
                    $query->where('due_date', '<', now())
                        ->where('status_id', '!=', $this->statusIds['completed']);
                },
                'tasks as total_tasks'
            ])
            ->orderBy('completed_tasks', 'desc')
            ->paginate(10);
        // dd($teamMembers);

        return view('chairperson.team-performance', compact('teamMembers'));
    }

    public function upcomingTasks()
    {
        $upcomingDeadlines = Task::where('due_date', '>=', now())
            ->with([
                'priority',
                'assignees' => function ($query) {
                    $query->withPivot('status_id');
                }
            ])
            ->orderBy('due_date', 'asc')
            ->paginate(10)
            ->through(function ($task) {
                $task->current_status = Status::find($task->assignees->first()->pivot->status_id ?? null);
                return $task;
            });

        return view('chairperson.upcoming-tasks', compact('upcomingDeadlines'));
    }

    public function activityLog()
    {
        $recentActivity = Task::with([
            'creator',
            'users' => function ($query) {
                $query->withPivot('status_id');
            }
        ])
            ->orderBy('updated_at', 'desc')
            ->paginate(10)
            ->through(function ($task) {
                $task->current_status = Status::find($task->users->first()->pivot->status_id ?? null);
                return $task;
            });

        return view('chairperson.activity-log', compact('recentActivity'));
    }
    public function approveAssignee(Task $task, User $user)
    {
        $task->users()->updateExistingPivot($user->id, [
            'status_id' => $this->statusIds['completed']
        ]);


        return back()->with('success', "Approved task for {$user->name}");
    }
    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);

        // Detach all associated users
        $task->users()->detach();

        // Delete all associated attachments
        foreach ($task->attachments as $attachment) {
            $attachment->delete();
        }
        // Delete all associated comments
        foreach ($task->comments as $comment) {
            $comment->delete();
        }
        // Delete the task
        $task->delete();

        return back()->with('success', 'Task deleted successfully!');
    }

    public function rejectAssignee(Task $task, User $user)
    {
        $task->users()->updateExistingPivot($user->id, [
            'status_id' => $this->statusIds['rejected']
        ]);

        return back()->with('success', "Rejected task for {$user->name}");
    }
    public function taskManagement()
    {
        $departmentId = Auth::user()->department_id;

        // Get all assignees in the department
        $assignees = User::where('department_id', $departmentId)
            ->where('id', '!=', Auth::id())
            ->withCount([
                'tasks' => function ($query) {
                    $query->where('status_id', $this->statusIds['pending_approval']);
                }
            ])
            ->orderBy('name')
            ->get();

        // All tasks for the department
        $tasks = Task::with([
            'priority',
            'creator',
            'users' => function ($query) {
                $query->withPivot('status_id');
            },
            'assignees' => function ($query) {
                $query->select('users.id', 'users.name'); // Select only necessary fields
            }
        ])
            ->whereHas('users', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })
            ->latest()
            ->get()
            ->each(function ($task) {
                $task->current_status = $task->users->first()->pivot->status_id
                    ? Status::find($task->users->first()->pivot->status_id)
                    : null;
                $task->assignee_names = $task->assignees->pluck('name')->toArray(); // Collect assignee names
            });

        // Get tasks by status
        $pendingApprovals = User::with([
            'taskAssignments' => function ($query) {
                $query->where('status_id', $this->statusIds['pending_approval'])
                    ->with('task', 'status'); // assumes task and status relationships exist in TaskUser model
            }
        ])->whereHas('taskAssignments', function ($query) {
            $query->where('status_id', $this->statusIds['pending_approval']);
        })->where('department_id', $departmentId)->get();
        // dd($pendingApprovals);
        $inProgressTasks = User::with([
            'taskAssignments' => function ($query) {
                $query->whereIn('status_id', [$this->statusIds['in_progress'], $this->statusIds['pending']])
                    ->with('task', 'status'); // assumes task and status relationships exist in TaskUser model
            }
        ])->whereHas('taskAssignments', function ($query) {
            $query->whereIn('status_id', [$this->statusIds['in_progress'], $this->statusIds['pending']]);
        })->where('department_id', $departmentId)->get();

        $completedTasks = User::with([
            'taskAssignments' => function ($query) {
                $query->where('status_id', $this->statusIds['completed'])
                    ->with('task', 'status'); // assumes task and status relationships exist in TaskUser model
            }
        ])->whereHas('taskAssignments', function ($query) {
            $query->where('status_id', $this->statusIds['completed']);
        })->where('department_id', $departmentId)->get();

        $myTasks = Task::whereHas('assignees', function ($query) {
            $query->where('user_id', Auth::id()); // Only tasks assigned to current user
        })
            ->with(['priority', 'assignees'])
            ->orderBy('due_date', 'asc')
            ->get();

        return view('chairperson.taskmanagement', compact(
            'tasks',
            'pendingApprovals',
            'inProgressTasks',
            'completedTasks',
            'assignees',
            'myTasks'
        ));
    }

    // public function taskDetails($id)
    // {
    //     $task = Task::with([
    //         'priority',
    //         'creator',
    //         'attachments',
    //         'comments.user',
    //         'users' => function ($query) {
    //             $query->withPivot('status_id');
    //         },
    //     ])->findOrFail($id);

    //     // Get all assignees with their status
    //     $assignees = $task->users->map(function ($user) {
    //         $status = Status::find($user->pivot->status_id);
    //         return [
    //             'id' => $user->id,
    //             'name' => $user->name,
    //             'avatar_url' => $user->avatar_url ?? asset('storage/profile/avatars/profile.png'),
    //             'status' => $status ? $status->name : 'pending',
    //             'status_id' => $status ? $status->id : null
    //         ];
    //     });


    //     return response()->json([
    //         'success' => true,
    //         'data' => [
    //             'id' => $task->id,
    //             'title' => $task->title,
    //             'description' => $task->description,
    //             'status' => $task->status->name ?? 'pending',
    //             'status_id' => $task->status->id ?? null,
    //             'priority' => [
    //                 'id' => $task->priority->id,
    //                 'name' => $task->priority->name
    //             ],
    //             'due_date' => $task->due_date->format('Y-m-d'),
    //             'due_date_formatted' => $task->due_date->format('M d, Y'),
    //             'creator' => [
    //                 'id' => $task->creator->id,
    //                 'name' => $task->creator->name,
    //                 'avatar_url' => $task->creator->avatar_url ?? asset('storage/profile/avatars/profile.png')
    //             ],
    //             'assignees' => $assignees,
    //             'created_at' => $task->created_at->format('Y-m-d H:i:s'),
    //             'created_at_formatted' => $task->created_at->format('M d, Y h:i A'),
    //             'attachments' => $task->attachments->map(function ($attachment) {
    //                 return [
    //                     'id' => $attachment->id,
    //                     'original_name' => $attachment->filename,
    //                     'path' => $attachment->path,
    //                     'mime_type' => $attachment->type,
    //                     'size' => $attachment->size,
    //                     'url' => $attachment->path,
    //                     'uploaded_at' => $attachment->created_at->format('M d, Y h:i A')
    //                 ];
    //             }),
    //             'comments' => $task->comments->map(function ($comment) {
    //                 return [
    //                     'id' => $comment->id,
    //                     'content' => $comment->comment,
    //                     'created_at' => $comment->created_at->format('M d, Y h:i A'),
    //                     'user' => [
    //                         'id' => $comment->user->id,
    //                         'name' => $comment->user->name,
    //                         'avatar_url' => $comment->user->avatar_url ?? asset('storage/profile/avatars/profile.png')
    //                     ]
    //                 ];
    //             })
    //         ]
    //     ]);
    // }
    public function taskDetails($id)
    {
        $task = Task::with([
            'priority',
            'creator',
            'attachments',
            'comments.user',
            'users' => function ($query) {
                $query->withPivot('status_id');
            },
        ])->findOrFail($id);

        // Get all assignees with their status
        $assignees = $task->users->map(function ($user) {
            $status = Status::find($user->pivot->status_id);
            return [
                'id' => $user->id,
                'name' => $user->name,
                'avatar_url' => $user->avatar_url ?? asset('storage/profile/avatars/profile.png'),
                'status' => $status ? $status->name : 'pending',
                'status_id' => $status ? $status->id : null
            ];
        });

        // Separate attachments by uploader
        $creatorAttachments = $task->attachments->filter(function ($attachment) use ($task) {
            return $attachment->user_id === $task->creator_id;
        })->values();

        $assigneeAttachments = $task->attachments->filter(function ($attachment) use ($task) {
            return $attachment->user_id !== $task->creator_id;
        })->values();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'status' => $task->status->name ?? 'pending',
                'status_id' => $task->status->id ?? null,
                'priority' => [
                    'id' => $task->priority->id,
                    'name' => $task->priority->name
                ],
                'due_date' => $task->due_date->format('Y-m-d'),
                'due_date_formatted' => $task->due_date->format('M d, Y'),
                'creator' => [
                    'id' => $task->creator->id,
                    'name' => $task->creator->name,
                    'avatar_url' => $task->creator->avatar_url ?? asset('storage/profile/avatars/profile.png')
                ],
                'assignees' => $assignees,
                'created_at' => $task->created_at->format('Y-m-d H:i:s'),
                'created_at_formatted' => $task->created_at->format('M d, Y h:i A'),
                'attachments' => [
                    'creator' => $creatorAttachments->map(function ($attachment) {
                        return [
                            'id' => $attachment->id,
                            'original_name' => $attachment->filename,
                            'path' => $attachment->path,
                            'mime_type' => $attachment->type,
                            'size' => $attachment->size,
                            'url' => $attachment->path,
                            'uploaded_at' => $attachment->created_at->format('M d, Y h:i A'),
                            'uploaded_by' => 'creator'
                        ];
                    }),
                    'assignees' => $assigneeAttachments->map(function ($attachment) {
                        return [
                            'id' => $attachment->id,
                            'original_name' => $attachment->filename,
                            'path' => $attachment->path,
                            'mime_type' => $attachment->type,
                            'size' => $attachment->size,
                            'url' => $attachment->path,
                            'uploaded_at' => $attachment->created_at->format('M d, Y h:i A'),
                            'uploaded_by' => 'assignee',
                            'uploader_name' => $attachment->user->name ?? 'Unknown'
                        ];
                    })
                ],
                'comments' => $task->comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'content' => $comment->comment,
                        'created_at' => $comment->created_at->format('M d, Y h:i A'),
                        'user' => [
                            'id' => $comment->user->id,
                            'name' => $comment->user->name,
                            'avatar_url' => $comment->user->avatar_url ?? asset('storage/profile/avatars/profile.png')
                        ]
                    ];
                })
            ]
        ]);
    }
    // public function approveTask($id)
    // {
    //     $task = Task::findOrFail($id);

    //     // Update task status to approved
    //     $approvedStatus = Status::where('name', 'approved')->first();
    //     if (!$approvedStatus) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Approved status not found in system'
    //         ], 400);
    //     }

    //     $task->status_id = $approvedStatus->id;
    //     $task->save();

    //     // Update all assignees' status to approved
    //     $task->users()->update(['status_id' => $approvedStatus->id]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Task approved successfully'
    //     ]);
    // }

    // public function rejectTask($id)
    // {
    //     $task = Task::findOrFail($id);

    //     // Update task status to rejected
    //     $rejectedStatus = Status::where('name', 'rejected')->first();
    //     if (!$rejectedStatus) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Rejected status not found in system'
    //         ], 400);
    //     }

    //     $task->status_id = $rejectedStatus->id;
    //     $task->save();

    //     // Update all assignees' status to rejected
    //     $task->users()->update(['status_id' => $rejectedStatus->id]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Task rejected successfully'
    //     ]);
    // }
    protected function getTasksByStatus($statusId, $departmentId)
    {
        return Task::with([
            'priority',
            'creator',
            'users' => function ($query) {
                $query->withPivot('status_id');
            }
        ])
            ->whereHas('users', function ($query) use ($statusId, $departmentId) {
                $query->where('status_id', $statusId)
                    ->where('department_id', $departmentId);
            })
            ->latest()
            ->get()
            ->each(function ($task) {
                $task->current_status = $task->users->first()->pivot->status_id
                    ? Status::find($task->users->first()->pivot->status_id)
                    : null;
            });
    }
    public function create()
    {
        // Get the authenticated user's department ID
        $userDepartmentId = Auth::user()->department_id;

        // Get users from the same department, excluding the auth user
        $users = User::where('department_id', $userDepartmentId)
            ->where('id', '!=', Auth::id())
            ->get();

        $priorities = Priority::all();

        // Get departments with their users (filtered to same department)
        $departments = Department::with([
            'users' => function ($query) use ($userDepartmentId) {
                $query->where('department_id', $userDepartmentId)
                    ->where('id', '!=', Auth::id());
            }
        ])
            ->where('id', $userDepartmentId)
            ->get();

        // Get recent tasks created by auth user (no department filter needed here)
        $recentTasks = Task::where('created_by', Auth::id())
            ->with(['assignees', 'priority'])
            ->latest()
            ->take(5)
            ->get();

        return view('chairperson.assigntask', compact('users', 'priorities', 'departments', 'recentTasks'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date|after_or_equal:today',
            'priority_id' => 'required|exists:priorities,id',
            'assignees' => 'required|array',
            'assignees.*' => 'required|exists:users,id',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|max:10240',
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'],
            'priority_id' => $validated['priority_id'],
            'created_by' => Auth::id(),
        ]);

        $defaultStatus = Status::where('name', 'pending')->first();

        foreach ($validated['assignees'] as $userId) {
            $task->assignees()->attach($userId, ['status_id' => $defaultStatus->id]);
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $mimeType = $file->getMimeType();
                $folder = 'others';

                if (str_starts_with($mimeType, 'image')) {
                    $folder = 'images';
                } elseif (str_starts_with($mimeType, 'application/pdf')) {
                    $folder = 'documents';
                } elseif (str_starts_with($mimeType, 'video')) {
                    $folder = 'videos';
                } elseif (str_starts_with($mimeType, 'audio')) {
                    $folder = 'audios';
                } elseif (
                    str_starts_with($mimeType, 'application/vnd.ms-excel') ||
                    str_contains($mimeType, 'spreadsheetml')
                ) {
                    $folder = 'spreadsheets';
                }

                $path = $file->store("{$folder}", 'public');
                Attachment::create([
                    'task_id' => $task->id,
                    'filename' => $file->getClientOriginalName(),
                    'path' => $path,
                    'type' => $mimeType,
                    'size' => $file->getSize(),
                    'uploaded_by' => Auth::id(),
                ]);
            }
        }

        foreach ($validated['assignees'] as $assigneeId) {
            $assignee = User::find($assigneeId);
            Mail::to($assignee->email)->send(new TaskAssignedMail($task, $assignee));
        }

        return back()->with('success', 'Task has been assigned successfully!');
    }
    public function settings()
    {
        return view('chairperson.settings');
    }




}