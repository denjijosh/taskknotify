@extends('employee.genemp')
@section('tittle', 'Dashboard')
@section('content')
    <!-- Main Content -->
    <div class="main-content" id="mainContent">

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
        <!-- Stats Row -->
        <div class="row mb-4 g-3">
            <div class="col-md-6">
                <div class="card stat-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted text-uppercase small fw-semibold">In Progress</span>
                                <h2 class="mb-1 mt-1 fw-bold">{{ $inProgressTasks }}</h2>
                                <span class="text-muted small">Task{{ $inProgressTasks != 1 ? 's' : '' }}</span>
                            </div>
                            <div class="icon-wrapper bg-primary bg-opacity-10">
                                <i class="fas fa-spinner text-primary"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small text-muted">Progress</span>
                                <span class="small text-muted">75%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                    role="progressbar" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card stat-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted text-uppercase small fw-semibold">Completed</span>
                                <h2 class="mb-1 mt-1 fw-bold">{{ $completedTasks }}</h2>
                                <span class="text-muted small">Task{{ $completedTasks != 1 ? 's' : '' }}</span>
                            </div>
                            <div class="icon-wrapper bg-success bg-opacity-10">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small text-muted">Completion Rate</span>
                                <span class="small text-muted">{{ $completionRate }}%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $completionRate }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Overview Section -->
        <div class="row mb-4 g-3">
            <div class="col-lg-8">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0 fw-bold">Task Overview</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                id="taskOverviewDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-calendar-alt me-1"></i> This Week
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="taskOverviewDropdown">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-day me-2"></i>Today</a></li>
                                <li><a class="dropdown-item active" href="#"><i class="fas fa-calendar-week me-2"></i>This
                                        Week</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-calendar me-2"></i>This Month</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Custom Range</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="priority-task">

                            @foreach($priorityTasks as $priorityName => $tasks)
                                @if(count($tasks) > 0)
                                    @foreach($tasks as $task)
                                        <div class="priority-item {{ strtolower($priorityName) }}-priority mb-3 p-3 rounded-3">
                                            <div class="d-flex align-items-center">
                                                <div class="priority-indicator me-3 
                                                                                    @if($priorityName == 'High') bg-danger
                                                                                    @elseif($priorityName == 'Medium') bg-warning
                                                                                    @else bg-secondary @endif">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 fw-semibold">{{ $task->title }}</h6>
                                                    <small class="text-muted">Due: {{ $task->due_date->format('M j, Y g:i A') }}</small>
                                                </div>
                                                <span
                                                    class="badge 
                                                                                    @if($priorityName == 'High') bg-danger bg-opacity-10 text-danger
                                                                                    @elseif($priorityName == 'Medium') bg-warning bg-opacity-10 text-warning
                                                                                    @else bg-secondary bg-opacity-10 text-secondary @endif">
                                                    {{ $priorityName }}
                                                </span>
                                            </div>
                                            <div class="task-progress mt-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span class="text-muted">Progress</span>
                                                    <span class="fw-medium">{{ $task->progress }}%</span>
                                                </div>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar 
                                                                                        @if($priorityName == 'High') bg-danger
                                                                                        @elseif($priorityName == 'Medium') bg-warning
                                                                                        @else bg-secondary @endif 
                                                                                        progress-bar-striped progress-bar-animated"
                                                        role="progressbar" style="width: {{ $task->progress }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">
                                        No {{ $priorityName }} priority tasks found.
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0 fw-bold">Upcoming Deadlines</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                id="upcomingDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i> Next 30 Days
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="upcomingDropdown">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-day me-2"></i>Today</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-week me-2"></i>This Week</a>
                                </li>
                                <li><a class="dropdown-item active" href="#"><i class="fas fa-calendar me-2"></i>Next 30
                                        Days</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Custom Range</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="upcoming-list">
                            @if(count($upcomingDeadlines) > 0)
                                @foreach($upcomingDeadlines as $task)
                                    <div class="upcoming-item p-3 border-bottom">
                                        <div class="d-flex">
                                            <div class="date-badge bg-light text-dark me-3 flex-shrink-0">
                                                <div class="month text-uppercase small fw-bold">{{ $task->due_date->format('M') }}
                                                </div>
                                                <div class="day fw-bold">{{ $task->due_date->format('d') }}</div>
                                            </div>
                                            <div>
                                                <h6 class="mb-1 fw-semibold">{{ $task->title }}</h6>

                                                <p class="text-muted small mb-2">{{ $task->description ?? 'No description' }}</p>
                                                @if($task->attachments->count() > 0)
                                                    <div class="documents">
                                                        @foreach($task->attachments as $attachment)
                                                            <span class="badge bg-light text-dark me-1 mb-1">
                                                                <i class="fas 
                                                                                                            @if(str_contains($attachment->mime_type, 'pdf')) fa-file-pdf text-danger
                                                                                                            @elseif(str_contains($attachment->mime_type, 'word')) fa-file-word text-primary
                                                                                                            @elseif(str_contains($attachment->mime_type, 'powerpoint')) fa-file-powerpoint text-orange
                                                                                                            @elseif(str_contains($attachment->mime_type, 'video')) fa-file-video text-purple
                                                                                                            @elseif(str_contains($attachment->mime_type, 'image')) fa-file-image text-teal
                                                                                                            @else fa-file text-secondary @endif
                                                                                                            me-1">
                                                                </i>{{ $attachment->filename }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-3 text-center text-muted">
                                    No upcoming deadlines in the next 30 days.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Tasks Section -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0 fw-bold">Monthly Tasks Overview - {{ now()->format('F Y') }}</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                id="monthlyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-calendar me-1"></i> {{ now()->format('F Y') }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="monthlyDropdown">
                                <li><a class="dropdown-item" href="#"><i
                                            class="fas fa-calendar me-2"></i>{{ now()->subMonth()->format('F Y') }}</a></li>
                                <li><a class="dropdown-item active" href="#"><i
                                            class="fas fa-calendar me-2"></i>{{ now()->format('F Y') }}</a></li>
                                <li><a class="dropdown-item" href="#"><i
                                            class="fas fa-calendar me-2"></i>{{ now()->addMonth()->format('F Y') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($monthlyTasks) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-muted text-uppercase small fw-semibold">Task Name</th>
                                            <th class="text-muted text-uppercase small fw-semibold">Due Date</th>
                                            <th class="text-muted text-uppercase small fw-semibold">Priority</th>
                                            <th class="text-muted text-uppercase small fw-semibold">Progress</th>
                                            <th class="text-muted text-uppercase small fw-semibold">Status</th>
                                            <th class="text-muted text-uppercase small fw-semibold">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($monthlyTasks as $task)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="task-icon bg-light text-muted me-3">
                                                                <i class="fas fa-tasks"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 fw-semibold">{{ $task->title }}</h6>
                                                                <small
                                                                    class="text-muted">{{ Str::limit($task->description, 30) }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fw-medium">{{ $task->due_date->format('M j, Y') }}</td>
                                                    <td>
                                                        @php
                                                            $priority = $priorities->firstWhere('id', $task->priority_id);
                                                            $priorityName = $priority ? $priority->name : 'Unknown';
                                                        @endphp
                                            <span
                                                            class="badge 
                                                                                    @if($priorityName == 'High') bg-danger bg-opacity-10 text-danger
                                                                                    @elseif($priorityName == 'Medium') bg-warning bg-opacity-10 text-warning
                                                                                    @else bg-secondary bg-opacity-10 text-secondary @endif">
                                                            {{ $priorityName }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="progress" style="height: 6px;">
                                                            <div class="progress-bar 
                                                                                        @if($priorityName == 'High') bg-danger
                                                                                        @elseif($priorityName == 'Medium') bg-warning
                                                                                        @else bg-secondary @endif 
                                                                                        progress-bar-striped progress-bar-animated"
                                                                role="progressbar" style="width: {{ $task->progress }}%">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-light text-dark">
                                                            <i class="fas fa-circle 
                                                                                        @if($task->status_id == 4) text-success
                                                                                        @elseif($task->status_id == 2) text-primary
                                                                                        @else text-warning @endif
                                                                                        me-1= small">
                                                            </i>

                                                            @if($task->status_id == 4) Completed

                                                            @elseif($task->status_id == 2) In Progress
                                                            @else Pending @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-light rounded-circle" type="button"
                                                                id="taskActions{{ $task->id }}" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v text-muted"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end shadow"
                                                                aria-labelledby="taskActions{{ $task->id }}">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="fas fa-eye me-2"></i>View</a></li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="fas fa-edit me-2"></i>Edit</a></li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="fas fa-trash-alt me-2"></i>Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                No tasks found for {{ now()->format('F Y') }}.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('mainContent').classList.toggle('active');
        });
    </script>

    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #0d6efd;
            --secondary: #6c757d;
            --success: #198754;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #0dcaf0;
            --light: #f8f9fa;
            --dark: #212529;
            --purple: #6f42c1;
            --orange: #fd7e14;
            --teal: #20c997;
            --pink: #d63384;
        }

        body {
            background-color: #f5f7fb;
            color: #212529;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* Improved Typography */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 600;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.625rem rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
            background-color: #fff;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
        }

        /* Stat Cards */
        .stat-card {
            border-left: 4px solid transparent;
        }

        .stat-card:hover {
            border-left-color: var(--primary);
        }

        .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        /* Progress Bars */
        .progress {
            border-radius: 0.375rem;
            background-color: #e9ecef;
        }

        .progress-bar {
            border-radius: 0.375rem;
        }

        /* Priority Items */
        .priority-item {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .priority-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
        }

        .priority-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .high-priority {
            border-left-color: var(--danger);
        }

        .medium-priority {
            border-left-color: var(--warning);
        }

        .low-priority {
            border-left-color: var(--secondary);
        }

        /* Badges */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            letter-spacing: 0.5px;
            border-radius: 0.25rem;
        }

        /* Date Badge */
        .date-badge {
            width: 50px;
            height: 50px;
            border-radius: 0.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: var(--light);
        }

        .date-badge .month {
            font-size: 0.65rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .date-badge .day {
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1;
        }

        /* Table Styles */
        .table {
            color: #212529;
        }

        .table thead th {
            border-bottom-width: 1px;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            font-weight: 600;
            background-color: var(--light);
            text-transform: uppercase;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .task-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            background-color: var(--light);
        }

        /* User Profile */
        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            padding: 0.5rem 0;
            min-width: 12rem;
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background-color: var(--light);
            color: var(--dark);
        }

        .dropdown-item.active {
            background-color: var(--primary);
            color: white;
        }

        .dropdown-item i {
            width: 1.25em;
            text-align: center;
            margin-right: 0.75rem;
        }

        /* Button Styles */
        .btn-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .btn-icon:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Document Icons */
        .fa-file-pdf {
            color: var(--danger);
        }

        .fa-file-word {
            color: var(--primary);
        }

        .fa-file-powerpoint {
            color: var(--orange);
        }

        .fa-file-video {
            color: var(--purple);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card-header {
                padding: 0.75rem 1rem;
            }

            .dropdown-menu {
                position: static;
                float: none;
                width: 100%;
            }
        }
    </style>
@endsection