@extends('genview')
@section('title', 'Assign Task')

@section('content')
    <style>
        /* Scoped styles - will only affect elements within .main-content */
        .main-content {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --success-color: #4cc9f0;
            --warning-color: #f8961e;
            --danger-color: #f72585;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        /* Main Container Styles */
        .main-content .assign-task-container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 40px;
            margin-bottom: 30px;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .main-content .assign-task-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .main-content .assign-task-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
            transition: width 0.3s ease;
        }

        .main-content .assign-task-container:hover::before {
            width: 6px;
        }

        /* Form Header Styles */
        .main-content .form-header {
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            padding-bottom: 20px;
        }

        .main-content .form-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
        }

        .main-content .form-header h4 {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .main-content .form-header p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Form Element Styles */
        .main-content .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 10px;
            display: block;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .main-content .form-control,
        .main-content .form-select {
            border-radius: 10px;
            padding: 12px 18px;
            border: 1px solid #e0e0e0;
            transition: var(--transition);
            height: auto;
            font-size: 0.95rem;
            background-color: #f8fafc;
        }

        .main-content .form-control:focus,
        .main-content .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.15);
            background-color: white;
        }

        /* Priority Indicator Styles */
        .main-content .priority-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 6px;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .main-content .priority-high {
            background-color: var(--danger-color);
            box-shadow: 0 0 8px rgba(247, 37, 133, 0.4);
        }

        .main-content .priority-medium {
            background-color: var(--warning-color);
            box-shadow: 0 0 8px rgba(248, 150, 30, 0.4);
        }

        .main-content .priority-low {
            background-color: var(--success-color);
            box-shadow: 0 0 8px rgba(76, 201, 240, 0.4);
        }

        /* Button Styles */
        .main-content .assign-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 14px 32px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: var(--transition);
            border-radius: 10px;
            font-size: 1rem;
            width: 100%;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            position: relative;
            overflow: hidden;
        }

        .main-content .assign-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .main-content .assign-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
        }

        .main-content .assign-btn:hover::before {
            left: 100%;
        }

        /* User Selection Styles */
        .main-content .user-select-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 8px;
            border: 1px solid #f0f0f0;
            background-color: white;
            position: relative;
        }

        .main-content .user-select-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .main-content .user-select-item.active {
            border-color: var(--primary-color);
            background-color: #f0f7ff;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.15);
        }

        .main-content .user-select-item.active::after {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: -8px;
            right: -8px;
            width: 20px;
            height: 20px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }

        .main-content .user-select-item img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            margin-right: 14px;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .main-content .user-select-item:hover img {
            transform: scale(1.05);
        }

        /* File Upload Styles */
        .main-content .file-upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            background-color: #f8f9fa;
            position: relative;
            overflow: hidden;
        }

        .main-content .file-upload-area:hover {
            border-color: var(--primary-color);
            background-color: #f0f7ff;
            transform: translateY(-2px);
        }

        .main-content .file-upload-area.dragover {
            background-color: rgba(67, 97, 238, 0.05);
            border-color: var(--primary-color);
        }

        .main-content .file-upload-icon {
            font-size: 2.8rem;
            color: var(--primary-color);
            margin-bottom: 15px;
            transition: var(--transition);
        }

        .main-content .file-upload-area:hover .file-upload-icon {
            transform: scale(1.1);
        }

        /* Activity Section Styles */
        .main-content .activity-section {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: white;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .main-content .activity-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--success-color), var(--primary-color));
            transition: width 0.3s ease;
        }

        .main-content .activity-section:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.1);
            transform: translateY(-2px);
        }

        .main-content .activity-section:hover::before {
            width: 6px;
        }

        .main-content .activity-section h5 {
            color: var(--primary-color);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .main-content .activity-section h5 .activity-number {
            background-color: var(--primary-color);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 0.8rem;
            transition: var(--transition);
        }

        .main-content .activity-section:hover h5 .activity-number {
            transform: rotate(360deg);
        }

        .main-content .activity-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .main-content .activity-section:hover .activity-actions {
            opacity: 1;
        }

        .main-content .add-activity-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
            width: 200px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .main-content .add-activity-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .main-content .add-activity-btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 1;
            }
            20% {
                transform: scale(25, 25);
                opacity: 1;
            }
            100% {
                opacity: 0;
                transform: scale(40, 40);
            }
        }

        /* Toggle Switch Styles */
        .main-content .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .main-content .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .main-content .form-switch .form-check-label {
            font-weight: 500;
            margin-left: 10px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        /* File Preview Styles */
        .main-content .file-preview-container {
            margin-top: 15px;
        }

        .main-content .file-preview-item {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: var(--transition);
        }

        .main-content .file-preview-item:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }

        .main-content .file-preview-item i {
            margin-right: 10px;
            color: var(--primary-color);
            transition: transform 0.3s ease;
        }

        .main-content .file-preview-item:hover i {
            transform: scale(1.2);
        }

        .main-content .file-preview-item .file-name {
            flex-grow: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .main-content .file-preview-item .file-remove {
            color: var(--danger-color);
            cursor: pointer;
            margin-left: 10px;
            transition: var(--transition);
        }

        .main-content .file-preview-item .file-remove:hover {
            transform: scale(1.2);
        }

        /* Department Header Styles */
        .main-content .department-header {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
            padding: 10px 0;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .main-content .department-header .department-title {
            font-size: 0.95rem;
        }

        .main-content .department-header .department-title small {
            font-size: 0.8rem;
            display: block;
            margin-top: 2px;
        }

        /* Floating Label Animation */
        .main-content .floating-label-group {
            position: relative;
            margin-bottom: 20px;
        }

        .main-content .floating-label {
            position: absolute;
            pointer-events: none;
            left: 15px;
            top: 12px;
            transition: 0.2s ease all;
            color: #6c757d;
            font-size: 0.95rem;
            background-color: #f8fafc;
            padding: 0 5px;
        }

        .main-content .form-control:focus ~ .floating-label,
        .main-content .form-control:not(:placeholder-shown) ~ .floating-label {
            top: -10px;
            left: 10px;
            font-size: 0.75rem;
            color: var(--primary-color);
            background-color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .main-content .assign-task-container {
                padding: 25px;
            }
            
            .main-content .col-lg-4 {
                margin-top: 30px;
            }
        }

        @media (max-width: 768px) {
            .main-content .assign-task-container {
                padding: 20px;
            }
            
            .main-content .form-header h4 {
                font-size: 1.5rem;
            }

            .main-content .user-select-item img {
                width: 36px;
                height: 36px;
                margin-right: 10px;
            }
        }

        /* Animation Classes */
        .main-content .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .main-content .shake {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }

        @keyframes shake {
            10%, 90% { transform: translateX(-1px); }
            20%, 80% { transform: translateX(2px); }
            30%, 50%, 70% { transform: translateX(-4px); }
            40%, 60% { transform: translateX(4px); }
        }

        /* Pulse Animation for Important Elements */
        .main-content .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(67, 97, 238, 0); }
            100% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0); }
        }

        /* Loading Spinner */
        .main-content .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>

    <div class="main-content">
        @if(session('success'))
            <div class="notification-toast alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session(key: 'success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
           
        <!-- Top Navigation -->
        <nav class="top-navbar navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2 px-3 mb-4 sticky-top">
            <div class="container-fluid d-flex justify-content-between align-items-center p-0">
                <!-- Left side - Toggle button and Brand -->
                <div class="d-flex align-items-center">
                    <!-- Hamburger menu - only visible on mobile -->
                     <button class="sidebar-collapse-btn btn btn-link text-dark p-0 me-2 me-md-3 d-lg-none" id="sidebarToggle">
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

        <!-- Assign Task Content -->
        <div class="assign-task-container">
            <div class="form-header">
                <h4><i class="fas fa-tasks me-2"></i> Assign New Task</h4>
                <p>Delegate work efficiently to your team members with clear instructions</p>
            </div>

            <form id="taskAssignmentForm" method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                    <div class="col-lg-8">
                        <!-- Multiple Activities Toggle -->
                        <div class="mb-4 form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="multipleActivities" name="multiple_activities">
                            <label class="form-check-label" for="multipleActivities">
                                <strong>Enable Multiple Activities</strong>
                                <small class="d-block text-muted">Break this task into smaller sub-tasks with separate deadlines</small>
                            </label>
                        </div>

                        <!-- Main Task Form (shown by default) -->
                        <div id="mainTaskForm">
                            <div class="mb-4 floating-label-group">
                                <input type="text" class="form-control" id="taskTitle" name="title"
                                    placeholder=" " required>
                                <label class="floating-label">Task Title *</label>
                            </div>

                            <div class="mb-4">
                                <label for="taskDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="taskDescription" name="description" rows="6"
                                    placeholder="Provide clear instructions, objectives, and any relevant details..."></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 floating-label-group">
                                    <input type="date" class="form-control" id="dueDate" name="due_date"
                                        min="{{ date('Y-m-d') }}" required>
                                    <label class="floating-label">Due Date *</label>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="taskPriority" class="form-label">Priority *</label>
                                    <select class="form-select" id="taskPriority" name="priority_id" required>
                                        @foreach($priorities as $priority)
                                            <option value="{{ $priority->id }}">
                                                <span class="priority-indicator priority-{{ $priority->name }}"></span>
                                                {{ ucfirst($priority->name) }} Priority 
                                                @if($priority->name === 'high')
                                                    (Due in 1 day)
                                                @elseif($priority->name === 'medium')
                                                    (Due in 5 days)
                                                @elseif($priority->name === 'low')
                                                    (Due in 5+ days)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Activities Container (hidden by default) -->
                        <div id="activitiesContainer" style="display: none;">
                            <div class="activity-section">
                                <h5><span class="activity-number">1</span> Main Activity</h5>
                                <div class="activity-actions">
                                    <button type="button" class="btn btn-icon btn-light btn-sm border-0 shadow-none remove-activity-btn" 
                                        style="color: #dc3545; background: transparent; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-times-circle" style="font-size: 1.3rem;"></i>
                                    </button>
                                </div>
                                <div class="mb-3 floating-label-group">
                                    <input type="text" class="form-control" name="activities[0][title]" placeholder=" " required>
                                    <label class="floating-label">Activity Title *</label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="activities[0][description]" 
                                        rows="3" placeholder="Activity description"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3 floating-label-group">
                                        <input type="date" class="form-control" name="activities[0][due_date]" 
                                            min="{{ date('Y-m-d') }}" required>
                                        <label class="floating-label">Due Date *</label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Priority *</label>
                                        <select class="form-select" name="activities[0][priority_id]" required>
                                            @foreach($priorities as $priority)
                                                <option value="{{ $priority->id }}">
                                                    <span class="priority-indicator priority-{{ $priority->name }}"></span>
                                                    {{ ucfirst($priority->name) }} Priority
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Container for additional activities -->
                            <div id="additionalActivities"></div>
                            
                            <!-- Add Activity Button -->
                            <button type="button" class="btn btn-primary add-activity-btn" id="addActivityBtn">
                                <i class="fas fa-plus-circle"></i> Add Another Activity
                            </button>
                        </div>

                        <!-- Attachments Section -->
                        <div class="mb-4">
                            <label class="form-label">Attachments</label>
                            <div class="file-upload-area" id="fileDropZone" onclick="document.getElementById('attachments').click()">
                                <div class="file-upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <h5>Drag & drop files here</h5>
                                <p class="text-muted mb-3">Supports PDF, DOCX, JPG, PNG up to 10MB</p>
                                <button type="button" class="btn btn-outline-primary btn-sm px-4">Browse Files</button>
                                <input type="file" id="attachments" name="attachments[]" multiple style="display: none;"
                                    onchange="updateFilePreview(this)">
                            </div>
                            <div id="filePreviewContainer" class="file-preview-container mt-3"></div>
                        </div>
                    </div>

                    <!-- Assign To Section -->
                    <div class="col-lg-4 d-flex flex-column align-items-end">
                        <div class="mb-4 w-100" style="max-width: 380px;">
                            <label class="form-label d-flex justify-content-start">Assign To *</label>
                            <div class="border rounded-3 p-3 bg-white" style="max-height: 600px; overflow-y: auto;">
                                @foreach($departments as $department)
                                    <div class="department-group">
                                        <div class="department-header d-flex justify-content-between align-items-center mb-3">
                                            <span class="department-title fw-bold text-primary">
                                                <i class="fas fa-building me-2"></i>{{ $department->name }}
                                                <small class="text-muted d-block">{{ $department->description }}</small>
                                            </span>
                                            <button type="button" class="btn btn-sm btn-outline-primary select-all-btn"
                                                onclick="selectAllFromDepartment('department-{{ $department->id }}')">
                                                <i class="fas fa-check-double me-1"></i> Select All
                                            </button>
                                        </div>
                                        @foreach($department->users as $user)
                                            @if($user->id !== Auth::id())
                                                <div class="user-select-item" onclick="toggleUserSelection(this, '{{ $user->id }}')"
                                                    data-department="department-{{ $department->id }}">
                                                    <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                                        alt="{{ $user->name }}" width="44" height="44">
                                                    <div>
                                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                                        <small>{{ $user->role->name ?? 'Team Member' }}</small>
                                                    </div>
                                                    <input type="checkbox" name="assignees[]" value="{{ $user->id }}"
                                                        style="display: none;">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-grid mt-4 w-100" style="max-width: 380px;">
                            <button type="submit" class="btn btn-primary assign-btn" id="submitButton">
                                <i class="fas fa-paper-plane me-2"></i> Assign Task
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize variables
            const multipleActivitiesCheckbox = document.getElementById('multipleActivities');
            const mainTaskForm = document.getElementById('mainTaskForm');
            const activitiesContainer = document.getElementById('activitiesContainer');
            const additionalActivitiesContainer = document.getElementById('additionalActivities');
            const addActivityBtn = document.getElementById('addActivityBtn');
            const fileDropZone = document.getElementById('fileDropZone');
            const submitButton = document.getElementById('submitButton');
            let activityCount = 1;
            
            // Toggle between main task form and activities
            multipleActivitiesCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    mainTaskForm.style.display = 'none';
                    activitiesContainer.style.display = 'block';
                    
                    // Animation effect
                    activitiesContainer.classList.add('fade-in');
                    
                    // Show a toast notification when enabling multiple activities
                    showToast('Multiple activities enabled', 'You can now break this task into smaller sub-tasks', 'info');
                } else {
                    mainTaskForm.style.display = 'block';
                    activitiesContainer.style.display = 'none';
                    
                    // Remove all additional activities
                    additionalActivitiesContainer.innerHTML = '';
                    activityCount = 1;
                }
            });

            // Add new activity
            addActivityBtn.addEventListener('click', function() {
                activityCount++;
                
                const newActivity = document.createElement('div');
                newActivity.className = 'activity-section mt-3 fade-in';
                newActivity.innerHTML = `
                    <div class="activity-actions">
                        <button type="button" class="btn btn-icon btn-light btn-sm border-0 shadow-none remove-activity-btn" 
                            style="color: #dc3545; background: transparent; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-times-circle" style="font-size: 1.3rem;"></i>
                        </button>
                    </div>
                    <h5><span class="activity-number">${activityCount}</span> Additional Activity</h5>
                    <div class="mb-3 floating-label-group">
                        <input type="text" class="form-control" name="activities[${activityCount-1}][title]" 
                            placeholder=" " required>
                        <label class="floating-label">Activity Title *</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="activities[${activityCount-1}][description]" 
                            rows="3" placeholder="Activity description"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 floating-label-group">
                            <input type="date" class="form-control" name="activities[${activityCount-1}][due_date]" 
                                min="{{ date('Y-m-d') }}" required>
                            <label class="floating-label">Due Date *</label>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Priority *</label>
                            <select class="form-select" name="activities[${activityCount-1}][priority_id]" required>
                                @foreach($priorities as $priority)
                                    <option value="{{ $priority->id }}">
                                        <span class="priority-indicator priority-{{ $priority->name }}"></span>
                                        {{ ucfirst($priority->name) }} Priority
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                `;
                
                additionalActivitiesContainer.appendChild(newActivity);
                
                // Scroll to the new activity
                newActivity.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                
                // Show a success toast
                showToast('Activity added', `Activity ${activityCount} has been added`, 'success');
            });

            // Remove activity
            document.addEventListener('click', function(e) {
                if (e.target && (e.target.classList.contains('remove-activity-btn') || 
                    e.target.closest('.remove-activity-btn'))) {
                    
                    const activityToRemove = e.target.closest('.activity-section');
                    const activityNumber = activityToRemove.querySelector('.activity-number').textContent;
                    
                    // Confirm before removing
                    if (confirm(`Are you sure you want to remove Activity ${activityNumber}?`)) {
                        // Add shake animation before removing
                        activityToRemove.classList.add('shake');
                        
                        setTimeout(() => {
                            activityToRemove.remove();
                            
                            // Renumber remaining activities
                            const activities = document.querySelectorAll('.activity-section');
                            activities.forEach((activity, index) => {
                                activity.querySelector('.activity-number').textContent = index + 1;
                                
                                // Update all input names
                                const inputs = activity.querySelectorAll('input, textarea, select');
                                inputs.forEach(input => {
                                    const name = input.name.replace(/\[\d+\]/, `[${index}]`);
                                    input.name = name;
                                });
                            });
                            
                            activityCount = activities.length;
                            
                            // Show a warning toast
                            showToast('Activity removed', `Activity ${activityNumber} has been removed`, 'warning');
                        }, 500);
                    }
                }
            });

            // Drag and drop file upload
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileDropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                fileDropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileDropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                fileDropZone.classList.add('dragover');
            }

            function unhighlight() {
                fileDropZone.classList.remove('dragover');
            }

            fileDropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                document.getElementById('attachments').files = files;
                updateFilePreview(document.getElementById('attachments'));
            }

            // Form submission handler
            document.getElementById('taskAssignmentForm').addEventListener('submit', function(e) {
                // Check if at least one user is selected
                if (selectedUsers.length === 0) {
                    e.preventDefault();
                    showToast('Selection Required', 'Please select at least one team member', 'error');
                    
                    // Add shake animation to assignee section
                    const assigneeSection = document.querySelector('.department-group');
                    assigneeSection.classList.add('shake');
                    setTimeout(() => {
                        assigneeSection.classList.remove('shake');
                    }, 500);
                    
                    return;
                }
                
                // Change button to loading state
                submitButton.innerHTML = '<div class="spinner"></div> Assigning Task...';
                submitButton.disabled = true;
            });
        });

        // Track selected users
        let selectedUsers = [];

        function toggleUserSelection(element, userId) {
            element.classList.toggle('active');
            const checkbox = element.querySelector('input[type="checkbox"]');

            if (element.classList.contains('active')) {
                checkbox.checked = true;
                if (!selectedUsers.includes(userId)) {
                    selectedUsers.push(userId);
                }
                
                // Add pulse effect to highlight selection
                element.classList.add('pulse');
                setTimeout(() => {
                    element.classList.remove('pulse');
                }, 2000);
                
                // Show a success toast
                showToast('User selected', 'Team member added to task', 'success');
            } else {
                checkbox.checked = false;
                selectedUsers = selectedUsers.filter(id => id !== userId);
                
                // Show a warning toast
                showToast('User deselected', 'Team member removed from task', 'warning');
            }
        }

        function selectAllFromDepartment(departmentClass) {
            const departmentUsers = document.querySelectorAll(`[data-department="${departmentClass}"]`);
            let allSelected = true;

            // Check if all users are already selected
            departmentUsers.forEach(user => {
                if (!user.classList.contains('active')) {
                    allSelected = false;
                }
            });

            // Toggle selection based on current state
            departmentUsers.forEach(user => {
                const checkbox = user.querySelector('input[type="checkbox"]');
                if (allSelected) {
                    user.classList.remove('active');
                    checkbox.checked = false;
                    selectedUsers = selectedUsers.filter(id => id !== checkbox.value);
                } else {
                    user.classList.add('active');
                    checkbox.checked = true;
                    if (!selectedUsers.includes(checkbox.value)) {
                        selectedUsers.push(checkbox.value);
                    }
                }
            });

            // Update button text
            const button = document.querySelector(`.department-header button[data-department="${departmentClass}"]`);
            if (button) {
                button.innerHTML = allSelected ? 
                    '<i class="fas fa-check-double me-1"></i> Select All' : 
                    '<i class="fas fa-times me-1"></i> Deselect All';
            }
            
            // Show appropriate toast
            showToast(
                allSelected ? 'Department deselected' : 'Department selected',
                allSelected ? 'All team members removed' : 'All team members added',
                allSelected ? 'warning' : 'success'
            );
        }

        // File upload preview functionality
        function updateFilePreview(input) {
            const filePreviewContainer = document.getElementById('filePreviewContainer');
            filePreviewContainer.innerHTML = '';
            
            if (input.files.length > 0) {
                // Show how many files were selected
                const fileCountBadge = document.createElement('div');
                fileCountBadge.className = 'mb-2 text-muted small';
                fileCountBadge.innerHTML = `<i class="fas fa-paperclip me-1"></i> ${input.files.length} file(s) selected`;
                filePreviewContainer.appendChild(fileCountBadge);
                
                // Show each file with remove option
                for (let i = 0; i < input.files.length; i++) {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-preview-item fade-in';
                    
                    // Get file icon based on type
                    const fileIcon = getFileIcon(input.files[i].name);
                    
                    fileItem.innerHTML = `
                        <i class="fas ${fileIcon}"></i>
                        <span class="file-name">${input.files[i].name}</span>
                        <span class="file-remove" onclick="removeFilePreview(this, ${i})">
                            <i class="fas fa-times"></i>
                        </span>
                    `;
                    
                    filePreviewContainer.appendChild(fileItem);
                }
                
                // Show success toast
                showToast('Files added', `${input.files.length} file(s) ready for upload`, 'success');
            }
        }

        function getFileIcon(filename) {
            const extension = filename.split('.').pop().toLowerCase();
            const fileIcons = {
                'pdf': 'fa-file-pdf',
                'doc': 'fa-file-word',
                'docx': 'fa-file-word',
                'xls': 'fa-file-excel',
                'xlsx': 'fa-file-excel',
                'ppt': 'fa-file-powerpoint',
                'pptx': 'fa-file-powerpoint',
                'jpg': 'fa-file-image',
                'jpeg': 'fa-file-image',
                'png': 'fa-file-image',
                'gif': 'fa-file-image',
                'zip': 'fa-file-archive',
                'rar': 'fa-file-archive',
                'txt': 'fa-file-alt',
                'csv': 'fa-file-csv'
            };
            
            return fileIcons[extension] || 'fa-file';
        }

        function removeFilePreview(element, index) {
            // Create a new DataTransfer object to manage files
            const dataTransfer = new DataTransfer();
            const input = document.getElementById('attachments');
            
            // Add all files except the one to be removed
            for (let i = 0; i < input.files.length; i++) {
                if (i !== index) {
                    dataTransfer.items.add(input.files[i]);
                }
            }
            
            // Update the file input
            input.files = dataTransfer.files;
            
            // Update the preview
            updateFilePreview(input);
            
            // Show warning toast
            showToast('File removed', 'File will not be uploaded', 'warning');
        }

        // Toast notification function
        function showToast(title, message, type) {
            // Remove any existing toasts
            const existingToasts = document.querySelectorAll('.custom-toast');
            existingToasts.forEach(toast => toast.remove());
            
            const toastContainer = document.createElement('div');
            toastContainer.className = `custom-toast notification-toast alert alert-${type} alert-dismissible fade show`;
            toastContainer.setAttribute('role', 'alert');
            toastContainer.style.position = 'fixed';
            toastContainer.style.top = '20px';
            toastContainer.style.right = '20px';
            toastContainer.style.zIndex = '1100';
            toastContainer.style.minWidth = '300px';
            toastContainer.style.maxWidth = '350px';
            toastContainer.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
            toastContainer.style.border = 'none';
            toastContainer.style.borderRadius = '8px';
            toastContainer.style.overflow = 'hidden';
            
            const iconClass = {
                'success': 'fa-check-circle',
                'error': 'fa-exclamation-circle',
                'warning': 'fa-exclamation-triangle',
                'info': 'fa-info-circle'
            }[type] || 'fa-info-circle';
            
            const iconColor = {
                'success': '#28a745',
                'error': '#dc3545',
                'warning': '#ffc107',
                'info': '#17a2b8'
            }[type] || '#17a2b8';
            
            toastContainer.innerHTML = `
                <div class="d-flex align-items-center">
                    <div class="toast-icon" style="width: 40px; height: 40px; background-color: ${iconColor}20; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                        <i class="fas ${iconClass}" style="color: ${iconColor};"></i>
                    </div>
                    <div>
                        <strong style="font-size: 0.95rem;">${title}</strong>
                        <div style="font-size: 0.85rem;">${message}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left: auto;"></button>
                </div>
            `;
            
            document.body.appendChild(toastContainer);
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                toastContainer.classList.remove('show');
                setTimeout(() => {
                    toastContainer.remove();
                }, 300);
            }, 5000);
        }

        // Auto-hide success notification after 5 seconds
        const notification = document.querySelector('.notification-toast');
        if (notification) {
            setTimeout(() => {
                notification.classList.remove('show');
                notification.classList.add('hide');
            }, 5000);
        }
    </script>
@endsection