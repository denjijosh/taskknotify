@extends('chairperson.genchair')
@section('title', 'Task Management')

@section('content')
    <style>
        .task-management-container {
            background-color: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 30px;
            margin-bottom: 30px;
            border: none;
        }

        .section-header {
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .section-header h4 {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }

        .section-header h4 i {
            margin-right: 10px;
        }

        .task-tabs {
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

        .task-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 8px 8px 0 0;
            margin-right: 5px;
        }

        .task-tabs .nav-link.active {
            color: var(--primary-color);
            background-color: rgba(67, 97, 238, 0.1);
            border-bottom: 3px solid var(--primary-color);
        }

        .task-card {
            border-radius: 12px;
            border: 1px solid #eee;
            margin-bottom: 15px;
            transition: all 0.3s;
        }

        .task-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .task-card-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-card-body {
            padding: 20px;
        }

        .task-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .task-meta {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .task-meta span {
            margin-right: 15px;
            display: flex;
            align-items: center;
        }

        .task-meta i {
            margin-right: 5px;
            font-size: 0.9rem;
        }

        .task-description {
            color: #495057;
            margin-bottom: 15px;
        }

        .task-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }

        .priority-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .priority-high {
            background-color: #ffebee;
            color: #ff6b6b;
        }

        .priority-medium {
            background-color: #fff8e1;
            color: #ffb74d;
        }

        .priority-low {
            background-color: #e8f5e9;
            color: #4caf50;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .status-in-progress {
            background-color: #fff3e0;
            color: #fb8c00;
        }

        .status-completed {
            background-color: #e8f5e9;
            color: #4caf50;
        }

        .status-overdue {
            background-color: #ffebee;
            color: #f44336;
        }

        .status-pending_approval {
            background-color: #f3e5f5;
            color: #9c27b0;
        }

        .status-rejected {
            background-color: #efebe9;
            color: #795548;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-state i {
            font-size: 3rem;
            color: #adb5bd;
            margin-bottom: 20px;
        }

        .empty-state h5 {
            color: #495057;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #6c757d;
        }

        .assignee-section {
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }

        .assignee-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .assignee-tasks-count {
            margin-left: auto;
            font-weight: bold;
            color: var(--primary-color);
        }

        .status-pending-approval {
            background-color: #f3e5f5;
            color: #9c27b0;
        }

        .status-approved {
            background-color: #e8f5e9;
            color: #4caf50;
        }

        .create-task-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 12px 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border-radius: 10px;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.25);
            margin-bottom: 20px;
        }

        .create-task-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
        }

        .notification-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 300px;
        }

        /* Navbar styles */
        .top-navbar {
            transition: all 0.3s ease;
        }

        .nav-link {
            transition: color 0.2s;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
        }

        .nav-link:hover {
            color: #0d6efd !important;
            background-color: rgba(13, 110, 253, 0.1);
        }

        .nav-link.active {
            color: #0d6efd !important;
            font-weight: 500;
        }

        .sidebar-collapse-btn:hover {
            transform: scale(1.1);
        }

        /* Notification dropdown styles */
        .notification-dropdown {
            width: 380px;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .notification-item {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .notification-item:hover {
            background-color: #f8f9fa;
        }

        .notification-item.unread {
            background-color: #f8faff;
            border-left-color: #0d6efd;
        }

        .notification-item .flex-shrink-0 {
            flex: 0 0 38px;
        }

        .notification-list {
            scrollbar-width: thin;
            scrollbar-color: #dee2e6 #f8f9fa;
        }

        .notification-list::-webkit-scrollbar {
            width: 6px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: #f8f9fa;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background-color: #dee2e6;
            border-radius: 3px;
        }

        .mark-all-read:hover {
            color: #0d6efd !important;
        }

        /* Mobile specific styles */
        @media (max-width: 575.98px) {
            .top-navbar {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .navbar-brand {
                font-size: 1rem;
            }

            .border-start {
                border-left: none !important;
            }

            .notification-dropdown {
                width: 300px;
                margin-right: -50px;
            }
        }
    </style>

    <div class="main-content">
        @if(session('success'))
            <div class="notification-toast alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Top Navigation -->
        <nav class="top-navbar navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2 px-3 mb-4 sticky-top">
            <div class="container-fluid d-flex justify-content-between align-items-center p-0">
                <!-- Left side - Toggle button and Brand -->
                <div class="d-flex align-items-center">
                    <!-- Hamburger menu - only visible on mobile -->
                    <button class="sidebar-collapse-btn btn btn-link text-dark p-0 me-2 me-md-3 d-lg-none"
                        id="sidebarToggle">
                        <i class="fas fa-bars fs-4"></i>
                    </button>
                    <span class="navbar-brand fw-bold text-primary ms-1 ms-md-2" id="adminGreeting">Good </span>
                </div>

                <!-- Right side - Navigation and User Info -->
                <div class="d-flex align-items-center">
                    <!-- Notification and User Profile -->
                    <div class="d-flex align-items-center ms-2 ms-lg-0">
                        <!-- Notification -->
                        <div class="dropdown position-relative me-2 me-lg-3">
                            <button class="btn btn-link text-dark p-0 position-relative dropdown-toggle"
                                id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                aria-label="Notifications">
                                <i class="fas fa-bell fs-5"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="notificationBadge">
                                    3
                                    <span class="visually-hidden">unread notifications</span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end notification-dropdown p-0"
                                aria-labelledby="notificationDropdown">
                                <div class="d-flex justify-content-between align-items-center p-3 border-bottom bg-light">
                                    <h6 class="m-0 fw-bold">Notifications</h6>
                                    <div>
                                        <span class="badge bg-primary rounded-pill me-2" id="notificationCount">3</span>
                                        <button class="btn btn-sm btn-link text-muted p-0 mark-all-read"
                                            title="Mark all as read">
                                            <i class="fas fa-check-double"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="notification-list" style="max-height: 400px; overflow-y: auto;">
                                    <!-- Sample notification items -->
                                    <a href="#" class="dropdown-item d-flex py-3 px-3 notification-item unread">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 38px; height: 38px;">
                                                <i class="fas fa-user-check text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h6 class="mb-0 fw-semibold">New User Registered</h6>
                                                <small class="text-muted">2 min ago</small>
                                            </div>
                                            <p class="mb-0 text-muted small">John Doe has registered as a new user.</p>
                                            <div class="mt-2">
                                                <span
                                                    class="badge bg-primary bg-opacity-10 text-primary small fw-normal">Users</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex py-3 px-3 notification-item unread">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-warning bg-opacity-10 p-2 rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 38px; height: 38px;">
                                                <i class="fas fa-exclamation-triangle text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h6 class="mb-0 fw-semibold">Server Warning</h6>
                                                <small class="text-muted">1 hour ago</small>
                                            </div>
                                            <p class="mb-0 text-muted small">Server CPU usage is high (85%). Please check
                                                immediately.</p>
                                            <div class="mt-2">
                                                <span
                                                    class="badge bg-warning bg-opacity-10 text-warning small fw-normal">System</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex py-3 px-3 notification-item">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-success bg-opacity-10 p-2 rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 38px; height: 38px;">
                                                <i class="fas fa-check-circle text-success"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h6 class="mb-0 fw-semibold">Task Completed</h6>
                                                <small class="text-muted">3 hours ago</small>
                                            </div>
                                            <p class="mb-0 text-muted small">Your scheduled backup was completed
                                                successfully.</p>
                                            <div class="mt-2">
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success small fw-normal">Backup</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="text-center py-3 bg-light border-top">
                                        <a href="#" class="text-primary fw-semibold small">View All Notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Profile -->
                        <div class="d-flex align-items-center ms-2 ms-lg-3 border-start ps-2 ps-lg-3">
                            <img src="{{ Auth::user()->avatar_url ?? asset('storage/profile/avatars/profile.png') }}"
                                alt="User Profile" class="rounded-circle me-2 border border-2 border-primary" width="40"
                                height="40">
                            <div class="d-none d-md-inline">
                                <div class="fw-bold text-dark">{{ ucwords(strtolower(Auth::user()->name)) }}</div>
                                <div class="small text-muted">Employee</div>
                            </div>
                            <!-- Show only name on small screens -->
                            <div class="d-inline d-md-none">
                                <div class="fw-bold text-dark">
                                    {{ explode(' ', ucwords (strtolower(Auth::user()->name)))[0] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="task-management-container">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h4><i class="fas fa-tasks"></i> Task Management</h4>
                <a href="{{ route('chairassign.task') }}" class="btn create-task-btn">
                    <i class="fas fa-plus me-2" style="color: #fff; display: inline;"></i> <span style="color: #fff; display: inline;">Create New Task</span>
                </a>
            </div>

            <!-- Assignee Filter -->
            <div class="mb-4">
                <label for="assigneeFilter" class="form-label">Filter by Assignee:</label>
                <select class="form-select" id="assigneeFilter">
                    <option value="all">All Assignees</option>
                    @foreach($assignees as $assignee)
                        <option value="{{ $assignee->id }}">{{ $assignee->name }}</option>
                    @endforeach
                </select>
            </div>

            <ul class="nav nav-tabs task-tabs" id="taskTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tasks-tab" data-bs-toggle="tab" data-bs-target="#all-tasks"
                        type="button" role="tab">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-list-check me-2"></i>
                            <span>All Tasks</span>
                            <span class="task-count-badge bg-primary-soft ms-2">{{ $tasks->count() }}</span>
                        </div>
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="in-progress-tab" data-bs-toggle="tab" data-bs-target="#in-progress-tasks"
                        type="button" role="tab">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-spinner me-2"></i>
                            <span>In Progress</span>
                            <span
                                class="task-count-badge bg-info-soft ms-2">{{ $inProgressTasks->sum(fn($user) => $user->taskAssignments->where('status.name', 'pending')->count()) }}</span>
                        </div>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending-tasks"
                        type="button" role="tab">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock me-2"></i>
                            <span>Pending Approval</span>
                            <span
                                class="task-count-badge bg-warning-soft ms-2">{{ $pendingApprovals->sum(fn($assignee) => $assignee->taskAssignments->where('status.name', 'pending_approval')->count()) }}</span>
                        </div>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-tasks"
                        type="button" role="tab">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2"></i>
                            <span>Completed</span>
                            <span
                                class="task-count-badge bg-success-soft ms-2">{{ $completedTasks->sum(fn($assignee) => $assignee->taskAssignments->where('status.name', 'completed')->count()) }}</span>
                        </div>
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="taskTabsContent">
                <!-- All Tasks Tab -->
                <div class="tab-pane fade show active" id="all-tasks" role="tabpanel">
                    @forelse($tasks as $task)
                        <div class="task-card">
                            <div class="task-card-header">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <!-- Title and Priority Section -->
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="task-title m-0 font-weight-semi-bold text-dark">
                                            {{ $task->title }}
                                        </h5>
                                        <span
                                            class="badge priority-badge priority-{{ $task->priority->name ?? 'medium' }} px-2 py-1">
                                            {{ ucfirst($task->priority->name ?? 'Medium') }}
                                        </span>
                                    </div>

                                    <!-- Status Section -->
                                    @if($task->assignees->count() > 1)
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle d-flex align-items-center"
                                                type="button" id="assigneeStatusDropdown{{ $task->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <span class="me-1">Team Status</span>
                                                <i class="bi bi-people-fill small"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm"
                                                aria-labelledby="assigneeStatusDropdown{{ $task->id }}"
                                                style="max-height: 300px; overflow-y: auto;">
                                                @foreach($task->assignees as $assignee)
                                                    <li>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center py-2">
                                                            <span class="text-truncate"
                                                                style="max-width: 120px;">{{ $assignee->name }}</span>
                                                            <span
                                                                class="badge status-badge status-{{ str_replace(' ', '-', strtolower($assignee->pivot->status->name ?? 'pending')) }} ms-2">
                                                                {{ $assignee->pivot->status->name ?? 'Pending' }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <span
                                            class="badge status-badge status-{{ str_replace(' ', '-', strtolower($task->current_status->name ?? 'pending')) }} px-3 py-1">
                                            {{ $task->current_status->name ?? 'Pending' }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="task-card-body">
                                <div class="task-meta">
                                    <span><i class="fas fa-calendar-alt"></i> Due:
                                        {{ $task->due_date->format('M d, Y') }}</span>
                                    <span><i class="fas fa-user"></i> Assigned to:
                                        @foreach($task->assignees as $assignee)
                                            {{ $assignee->name }}@if(!$loop->last), @endif
                                        @endforeach
                                    </span>
                                </div>
                                <p class="task-description">
                                    {{ Str::limit($task->description, 200) }}
                                </p>
                                <div class="task-actions">
                                    <a href="#" class="btn btn-sm btn-outline-primary me-2" data-task-id="{{ $task->id }}">
                                        <i class="fas fa-eye me-1"></i> View Details
                                    </a>
                                    <form action="{{ route('chairperson.tasks.delete', ['task' => $task->id]) }}" method="POST"
                                        class="d-inline delete-task-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-task-btn"
                                            onclick="confirmDelete(this)">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-tasks"></i>
                            <h5>No tasks found</h5>
                            <p>There are currently no tasks assigned to you or your team.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pending Approval Tab -->
                <div class="tab-pane fade" id="pending-tasks" role="tabpanel">
                    @if($pendingApprovals->count() > 0)
                        @foreach($pendingApprovals as $assignee)
                            @if($assignee->taskAssignments->count() > 0)
                                <div class="assignee-section" data-assignee="{{ $assignee->id }}">
                                    <div class="assignee-header">
                                        <img src="{{ $assignee->avatar_url ?? asset('storage/profile/avatars/profile.png') }}"
                                            class="assignee me-3" alt="{{ $assignee->name }}" width="40" height="40">
                                        <h5 class="mb-0">{{ $assignee->name }}</h5>
                                        <span class="assignee-tasks-count">{{ $assignee->taskAssignments->count() }} tasks</span>
                                    </div>

                                    @foreach($assignee->taskAssignments as $assignment)
                                        <div class="task-card mb-3">
                                            <div class="task-card-header">
                                                <div>
                                                    <span class="task-title">{{ $assignment->task->title }}</span>
                                                    <span
                                                        class="priority-badge priority-{{ $assignment->task->priority->name ?? 'medium' }}">
                                                        {{ ucfirst($assignment->task->priority->name ?? 'Medium') }} Priority
                                                    </span>
                                                </div>
                                                <span class="status-badge status-pending-approval">
                                                    Pending Approval
                                                </span>
                                            </div>
                                            <div class="task-card-body">
                                                <div class="task-meta">
                                                    <span><i class="fas fa-calendar-alt"></i> Due:
                                                        {{ $assignment->task->due_date->format('M d, Y') }}</span>
                                                    <span><i class="fas fa-building"></i>
                                                        {{ $assignment->task->department ?? 'General' }}</span>
                                                </div>
                                                <p class="task-description">
                                                    {{ Str::limit($assignment->task->description, 200) }}
                                                </p>
                                                <div class="task-actions">
                                                    <a href="#" class="btn btn-sm btn-outline-primary me-2"
                                                        data-task-id="{{ $assignment->task->id }}">
                                                        <i class="fas fa-eye me-1"></i> View Details
                                                    </a>
                                                    <form
                                                        action="{{ route('chairperson.tasks.approve-assignee', ['task' => $assignment->task->id, 'user' => $assignee->id]) }}"
                                                        method="POST" class="d-inline me-2">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                                            <i class="fas fa-check me-1"></i> Approve
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('chairperson.tasks.reject-assignee', ['task' => $assignment->task->id, 'user' => $assignee->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-times me-1"></i> Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="fas fa-clock"></i>
                            <h5>No tasks pending approval</h5>
                            <p>There are currently no tasks awaiting your approval.</p>
                        </div>
                    @endif
                </div>

                <!-- In Progress Tab -->
                <div class="tab-pane fade" id="in-progress-tasks" role="tabpanel">
                    @if($inProgressTasks->count() > 0)
                        @foreach($inProgressTasks as $user)
                            @if($user->taskAssignments->count() > 0)
                                <div class="assignee-section" data-assignee="{{ $user->id }}">
                                    <div class="assignee-header">
                                        <img src="{{ $user->avatar_url ?? asset('storage/profile/avatars/profile.png') }}"
                                            class="assignee me-3" alt="{{ $user->name }}" width="40" height="40">
                                        <h5 class="mb-0">{{ $user->name }}</h5>
                                        <span class="assignee-tasks-count">{{ $user->taskAssignments->count() }} tasks</span>
                                    </div>

                                    @foreach($user->taskAssignments as $assignment)
                                        <div class="task-card mb-3">
                                            <div class="task-card-header">
                                                <div>
                                                    <span class="task-title">{{ $assignment->task->title }}</span>
                                                    <span
                                                        class="priority-badge priority-{{ $assignment->task->priority->name ?? 'medium' }}">
                                                        {{ ucfirst($assignment->task->priority->name ?? 'Medium') }} Priority
                                                    </span>
                                                </div>
                                                <span
                                                    class="status-badge status-{{ str_replace(' ', '-', strtolower($assignment->status->name ?? 'in-progress')) }}">
                                                    {{ $assignment->status->name ?? 'In Progress' }}
                                                </span>
                                            </div>
                                            <div class="task-card-body">
                                                <div class="task-meta">
                                                    <span><i class="fas fa-calendar-alt"></i> Due:
                                                        {{ $assignment->task->due_date->format('M d, Y') }}</span>
                                                    <span><i class="fas fa-building"></i>
                                                        {{ $assignment->task->department ?? 'General' }}</span>
                                                </div>
                                                <p class="task-description">
                                                    {{ Str::limit($assignment->task->description, 200) }}
                                                </p>
                                                <div class="task-actions">
                                                    <a href="#" class="btn btn-sm btn-outline-primary me-2"
                                                        data-task-id="{{ $assignment->task->id }}">
                                                        <i class="fas fa-eye me-1"></i> View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="fas fa-spinner"></i>
                            <h5>No tasks in progress</h5>
                            <p>There are currently no tasks being worked on by your team.</p>
                        </div>
                    @endif
                </div>

                <!-- Completed Tab -->
                <div class="tab-pane fade" id="completed-tasks" role="tabpanel">
                    @if($completedTasks->count() > 0)
                        @foreach($completedTasks as $assignee)
                            @if($assignee->taskAssignments->where('status.name', 'completed')->count() > 0)
                                <div class="assignee-section" data-assignee="{{ $assignee->id }}">
                                    <div class="assignee-header">
                                        <img src="{{ $assignee->avatar_url ?? asset('storage/profile/avatars/profile.png') }}"
                                            class="assignee me-3" alt="{{ $assignee->name }}" width="40" height="40">
                                        <h5 class="mb-0">{{ $assignee->name }}</h5>
                                        <span class="assignee-tasks-count">
                                            {{ $assignee->taskAssignments->where('status.name', 'completed')->count() }} tasks
                                        </span>
                                    </div>

                                    @foreach($assignee->taskAssignments->where('status.name', 'completed') as $assignment)
                                        <div class="task-card mb-3">
                                            <div class="task-card-header">
                                                <div>
                                                    <span class="task-title">{{ $assignment->task->title }}</span>
                                                    <span
                                                        class="priority-badge priority-{{ $assignment->task->priority->name ?? 'medium' }}">
                                                        {{ ucfirst($assignment->task->priority->name ?? 'Medium') }} Priority
                                                    </span>
                                                </div>
                                                <span class="status-badge status-completed">
                                                    Completed
                                                </span>
                                            </div>
                                            <div class="task-card-body">
                                                <div class="task-meta">
                                                    <span><i class="fas fa-calendar-alt"></i> Due:
                                                        {{ $assignment->task->due_date->format('M d, Y') }}</span>
                                                    <span><i class="fas fa-building"></i>
                                                        {{ $assignment->task->department ?? 'General' }}</span>
                                                </div>
                                                <p class="task-description">
                                                    {{ Str::limit($assignment->task->description, 200) }}
                                                </p>
                                                <div class="task-actions">
                                                    <a href="#" class="btn btn-sm btn-outline-primary me-2"
                                                        data-task-id="{{ $assignment->task->id }}">
                                                        <i class="fas fa-eye me-1"></i> View Details
                                                    </a>
                                                    <button class="btn btn-sm btn-outline-secondary">
                                                        <i class="fas fa-file-export me-1"></i> Export Report
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="fas fa-check-circle"></i>
                            <h5>No completed tasks</h5>
                            <p>There are currently no completed tasks in your team.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to update greeting based on time of day
        function updateGreeting() {
            const greetingElement = document.getElementById('adminGreeting');
            const hour = new Date().getHours();
            let greeting;

            if (hour < 12) {
                greeting = 'Good Morning';
            } else if (hour < 18) {
                greeting = 'Good Afternoon';
            } else {
                greeting = 'Good Evening';
            }

            greetingElement.textContent = `${greeting}`;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Update greeting on page load and resize
            updateGreeting();

            // Notification functionality
            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationBadge = document.getElementById('notificationBadge');
            const notificationCount = document.getElementById('notificationCount');
            const markAllReadBtn = document.querySelector('.mark-all-read');

            // Mark notifications as read when dropdown is shown
            notificationDropdown.addEventListener('shown.bs.dropdown', function () {
                // Only mark as read if there are unread notifications
                if (parseInt(notificationBadge.textContent) > 0) {
                    document.querySelectorAll('.notification-item.unread').forEach(item => {
                        item.classList.remove('unread');
                        item.style.borderLeftColor = 'transparent';
                        item.style.backgroundColor = '';
                    });

                    // Update badge count to 0
                    notificationBadge.textContent = '0';
                    notificationCount.textContent = '0';
                }
            });

            // Mark all as read button
            markAllReadBtn.addEventListener('click', function (e) {
                e.stopPropagation();

                document.querySelectorAll('.notification-item.unread').forEach(item => {
                    item.classList.remove('unread');
                    item.style.borderLeftColor = 'transparent';
                    item.style.backgroundColor = '';
                });

                // Update badge count to 0
                notificationBadge.textContent = '0';
                notificationCount.textContent = '0';
            });

            // Auto-hide notification
            const notification = document.querySelector('.notification-toast');
            if (notification) {
                setTimeout(() => {
                    notification.classList.remove('show');
                    notification.classList.add('hide');
                }, 5000);
            }

            // Tab persistence
            if (localStorage.getItem('lastActiveTab')) {
                const lastActiveTab = localStorage.getItem('lastActiveTab');
                const tabTrigger = document.querySelector(`#${lastActiveTab}-tab`);
                if (tabTrigger) {
                    new bootstrap.Tab(tabTrigger).show();
                }
            }

            // Save active tab when changed
            const tabTriggers = document.querySelectorAll('[data-bs-toggle="tab"]');
            tabTriggers.forEach(tabTrigger => {
                tabTrigger.addEventListener('click', function () {
                    localStorage.setItem('lastActiveTab', this.id);
                });
            });

            // Assignee filter functionality
            const assigneeFilter = document.getElementById('assigneeFilter');
            if (assigneeFilter) {
                assigneeFilter.addEventListener('change', function () {
                    const assigneeId = this.value;
                    const assigneeSections = document.querySelectorAll('.assignee-section');

                    assigneeSections.forEach(section => {
                        if (assigneeId === 'all' || section.dataset.assignee === assigneeId) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    });
                });
            }

            // Delete confirmation
            function confirmDelete(button) {
                if (confirm('Are you sure you want to delete this task?')) {
                    button.closest('form').submit();
                }
            }
        });

        // Optional: Update greeting every minute in case page stays open for long
        setInterval(updateGreeting, 60000);
    </script>
@endsection