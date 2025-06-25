@extends('chairperson.genchair')
@section('title', 'Task Details')

@section('content')
    <style>
        .task-details-container {
            background-color: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 30px;
            margin-bottom: 30px;
            border: none;
        }

        .task-header {
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }

        .task-title {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .task-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .task-meta-item {
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }

        .task-meta-item i {
            margin-right: 8px;
            color: #6c757d;
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35em 0.65em;
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

        .status-pending {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .status-pending-approval {
            background-color: #e8f5e9;
            color: #ff9800;
        }

        .status-in-progress {
            background-color: #fff3e0;
            color: #fb8c00;
        }

        .status-completed {
            background-color: #e8f5e9;
            color: #4caf50;
        }

        .status-rejected {
            background-color: #ffebee;
            color: #f44336;
        }

        .status-overdue {
            background-color: #ffebee;
            color: #f44336;
        }

        .description-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .comment-section {
            max-height: 400px;
            overflow-y: auto;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
        }

        .comment-item {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .comment-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .comment-user {
            font-weight: 600;
            color: #212529;
        }

        .comment-time {
            font-size: 0.75rem;
            color: #6c757d;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
        }

        .attachment-thumbnail {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
            margin-bottom: 15px;
            border: 1px solid #dee2e6;
            transition: transform 0.2s;
        }

        .attachment-thumbnail:hover {
            transform: scale(1.05);
        }

        .attachment-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 2rem;
        }

        .back-btn {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .btn-submit {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
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
                    <span class="navbar-brand fw-bold text-primary ms-1 ms-md-2" id="adminGreeting">Good Morning</span>
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
                                    {{ explode(' ', ucwords(strtolower(Auth::user()->name)))[0] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <style>
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

            // Update greeting on page load and resize
            document.addEventListener('DOMContentLoaded', function () {
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

                // Sample function to add a new notification
                function addNotification(title, message, type = 'info', category = 'General') {
                    const icons = {
                        'info': 'fa-info-circle',
                        'warning': 'fa-exclamation-triangle',
                        'success': 'fa-check-circle',
                        'danger': 'fa-exclamation-circle',
                        'user': 'fa-user'
                    };

                    const colors = {
                        'info': 'primary',
                        'warning': 'warning',
                        'success': 'success',
                        'danger': 'danger',
                        'user': 'info'
                    };

                    const notificationList = document.querySelector('.notification-list');
                    const newNotification = document.createElement('a');
                    newNotification.href = '#';
                    newNotification.className = 'dropdown-item d-flex py-3 px-3 notification-item unread';
                    newNotification.innerHTML = `
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-${colors[type]} bg-opacity-10 p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            <i class="fas ${icons[type]} text-${colors[type]}"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h6 class="mb-0 fw-semibold">${title}</h6>
                            <small class="text-muted">just now</small>
                        </div>
                        <p class="mb-0 text-muted small">${message}</p>
                        <div class="mt-2">
                            <span class="badge bg-${colors[type]} bg-opacity-10 text-${colors[type]} small fw-normal">${category}</span>
                        </div>
                    </div>
                `;

                    // Insert at the top of the list (before the "View All" link)
                    const viewAllLink = notificationList.querySelector('.bg-light.border-top');
                    notificationList.insertBefore(newNotification, viewAllLink);

                    // Update badge count
                    const currentCount = parseInt(notificationBadge.textContent) || 0;
                    notificationBadge.textContent = currentCount + 1;
                    notificationCount.textContent = currentCount + 1;

                    // Add animation for new notification
                    newNotification.style.opacity = '0';
                    newNotification.style.transform = 'translateY(-10px)';
                    newNotification.style.transition = 'all 0.3s ease';

                    setTimeout(() => {
                        newNotification.style.opacity = '1';
                        newNotification.style.transform = 'translateY(0)';
                    }, 10);
                }

                // Example: Add a new notification after 5 seconds
                // setTimeout(() => {
                //     addNotification('System Update', 'A new system update is available for installation.', 'info', 'System');
                // }, 5000);
            });

            // Optional: Update greeting every minute in case page stays open for long
            setInterval(updateGreeting, 60000);
        </script>

        <div class="task-details-container">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary back-btn">
                <i class="fas fa-arrow-left me-2"></i> Back to Tasks
            </a>

            <div class="task-header">
                <h1 class="task-title">{{ $task->title }}</h1>
                <div class="task-meta">
                    <span class="task-meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <strong>Due:</strong> {{ $task->due_date->format('M d, Y') }}
                    </span>
                    <span class="task-meta-item">
                        <i class="fas fa-user"></i>
                        <strong>Assigned by:</strong> {{ $task->creator->name }}
                    </span>
                    <span class="task-meta-item">
                        <i class="fas fa-clock"></i>
                        <strong>Assigned on:</strong> {{ $task->created_at->format('M d, Y') }}
                    </span>
                    @if($task->priority)
                        <span class="task-meta-item">
                            <i class="fas fa-exclamation-circle"></i>
                            <strong>Priority:</strong>
                            <span class="badge priority-{{ strtolower($task->priority->name) }}">
                                {{ $task->priority->name }}
                            </span>
                        </span>
                    @endif
                    <span class="task-meta-item">
                        <i class="fas fa-tasks"></i>
                        <strong>Status:</strong>
                        <span class="badge status-{{ str_replace(' ', '-', strtolower($status->name)) }}">
                            {{ $status->name }}
                        </span>
                    </span>
                </div>
            </div>

            <div class="description-box">
                <h6 class="section-title">Description</h6>
                <p>{{ $task->description }}</p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="section-title">Attachments</h6>
                    <div class="attachment-container">
                        @forelse($task->attachments as $attachment)
                            @if($attachment->mime_type && str_starts_with($attachment->mime_type, 'image/'))
                                <div>
                                    <a href="{{ Storage::url($attachment->url) }}" target="_blank" class="d-block">
                                        <img src="{{ Storage::url($attachment->url) }}" class="attachment-thumbnail" 
                                             alt="{{ $attachment->original_name }}" title="{{ $attachment->original_name }}">
                                    </a>
                                    <small class="d-block text-muted text-truncate" style="max-width: 120px">
                                        {{ $attachment->original_name }}
                                    </small>
                                </div>
                            @else
                                <div>
                                    <a href="{{ Storage::url($attachment->url) }}" target="_blank" class="d-block text-center">
                                        <div class="attachment-thumbnail d-flex align-items-center justify-content-center bg-white">
                                            <i class="fas fa-file-alt fa-2x text-secondary"></i>
                                        </div>
                                        <small class="d-block text-muted text-truncate" style="max-width: 120px">
                                            {{ $attachment->original_name }}
                                        </small>
                                    </a>
                                </div>
                            @endif
                        @empty
                            <p class="text-muted">No attachments available</p>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="section-title">Comments</h6>
                    <div class="comment-section">
                        @forelse($task->comments as $comment)
                            <div class="comment-item">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{ $comment->user->avatar_url ?? asset('storage/profile/avatars/profile.png') }}" 
                                         class="user-avatar" alt="{{ $comment->user->name }}">
                                    <div>
                                        <span class="comment-user">{{ $comment->user->name }}</span>
                                        <span class="comment-time">{{ $comment->created_at->format('M d, Y h:i A') }}</span>
                                    </div>
                                </div>
                                <p class="ms-5 mb-0">{{ $comment->content }}</p>
                            </div>
                        @empty
                            <p class="text-muted">No comments yet</p>
                        @endforelse
                    </div>
                </div>
            </div>

            @if($status->name !== 'completed')
                <div class="mt-5">
                    <h6 class="section-title">Submit Task</h6>
                    <form id="taskSubmissionForm" action="{{ route('tasks.submit', $task->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="comment" class="form-label">Add Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"
                                      placeholder="Add your comments here..."></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="attachments" class="form-label">Add Attachments</label>
                            <input class="form-control" type="file" id="attachments" name="attachments[]" multiple>
                            <div class="form-text">Upload relevant files (max 5MB each)</div>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-paper-plane me-2"></i> Submit Task
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Auto-hide notification
            const notification = document.querySelector('.notification-toast');
            if (notification) {
                setTimeout(() => {
                    notification.classList.remove('show');
                    notification.classList.add('hide');
                }, 5000);
            }
        });
    </script>
@endsection