@extends('chairperson.genchair')
@section('tittle', 'Dashboard')
@section('content')

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

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Stats Row -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="dashboard-card">
                    <div class="stat-number">{{ $activeTasks }}</div>
                    <div class="stat-label">Active Tasks</div>
                    <div class="progress mt-2" style="height: 8px;">
                        <!-- <div class="progress-bar" style="width: {{ $activeTasks > 0 ? ($completedPercentage) : 0 }}%"></div> -->
                    </div>
                    <small class="text-muted">{{ $completedPercentage }}% completed</small>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="dashboard-card">
                    <div class="stat-number">{{ $overdueTasks }}</div>
                    <div class="stat-label">Overdue Tasks</div>
                    <div class="progress mt-2" style="height: 8px;">
                        <!-- <div class="progress-bar bg-danger" style="width: {{ $overdueTasks > 0 ? 100 : 0 }}%"></div> -->
                    </div>
                    <small class="text-muted">Need attention</small>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="dashboard-card">
                    <div class="stat-number">{{ $completedTasks }}</div>
                    <div class="stat-label">Completed</div>
                    <div class="progress mt-2" style="height: 8px;">
                        <!-- <div class="progress-bar bg-success" style="width: {{ $completedPercentage }}%"></div> -->
                    </div>
                    <small class="text-muted">This month</small>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="dashboard-card">
                    <div class="stat-number">{{ $hoursLogged }}</div>
                    <div class="stat-label">Hours Logged</div>
                    <div class="progress mt-2" style="height: 8px;">
                        <div class="progress-bar bg-info" style="width: 60%"></div>
                    </div>
                    <small class="text-muted">This week</small>
                </div>
            </div>
        </div>

        <!-- Task Calendar -->
        <div class="dashboard-card">
            <div class="card-header">
                <h5 class="mb-0">My Task Calendar</h5>
                <div class="btn-group">
                    <button class="btn btn-sm btn-outline-secondary" id="prevWeek">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" id="today">
                        Today
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" id="nextWeek">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div id="taskCalendar"></div>
        </div>
    </div>

    <!-- Add Task Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="taskForm" action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">Task Title</label>
                            <input type="text" class="form-control" id="taskTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="taskDescription" name="description" rows="3"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="start_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="dueDate" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="dueDate" name="due_date" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="taskPriority" class="form-label">Priority</label>
                            <select class="form-select" id="taskPriority" name="priority_id" required>
                                @foreach($priorities as $priority)
                                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="taskAssignees" class="form-label">Assignees</label>
                            <select class="form-select" id="taskAssignees" name="assignees[]" multiple>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="attachments" class="form-label">Attachments</label>
                            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Detail Modal -->
    <div class="modal fade task-modal" id="taskDetailModal" tabindex="-1" aria-labelledby="taskDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskDetailModalLabel">Task Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 id="detailTaskTitle"></h4>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="priority-badge" id="detailPriority"></span>
                                <span class="badge bg-secondary" id="detailStatus"></span>
                            </div>
                            <p id="detailDescription" class="mb-4"></p>

                            <div class="task-meta mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong><i class="fas fa-user me-2"></i>Assigned by:</strong>
                                            <span id="detailCreator"></span>
                                        </div>
                                        <div class="mb-3">
                                            <strong><i class="fas fa-calendar-plus me-2"></i>Start Date:</strong>
                                            <span id="detailStartDate"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong><i class="fas fa-calendar-check me-2"></i>Due Date:</strong>
                                            <span id="detailDueDate"></span>
                                        </div>
                                        <div class="mb-3">
                                            <strong><i class="fas fa-users me-2"></i>Assignees:</strong>
                                            <span id="detailAssignees"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Progress Section -->
                            <div class="progress-section mb-4">
                                <div class="progress mb-2">
                                    <div class="progress-bar" id="detailProgress" role="progressbar" style="width: 0%">
                                    </div>
                                </div>
                                <small class="text-muted" id="progressText">Task progress</small>
                            </div>

                            <!-- Completion Section -->
                            <div class="completion-section mb-4" id="completionSection" style="display: none;">
                                <hr>
                                <h5><i class="fas fa-check-circle me-2"></i>Submit Completion</h5>
                                <div class="mb-3">
                                    <label for="completionComments" class="form-label">Completion Notes</label>
                                    <textarea class="form-control" id="completionComments" rows="3"
                                        placeholder="Describe what you've completed and any important details"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="completionAttachments" class="form-label">Supporting Documents</label>
                                    <input type="file" class="form-control" id="completionAttachments"
                                        name="completion_attachments[]" multiple>
                                    <small class="text-muted">Upload any files that prove task completion</small>
                                </div>
                            </div>

                            <!-- Comments Section - Fixed Implementation -->
                            <div class="comments-section mb-4">
                                <hr>
                                <h5><i class="fas fa-comments me-2"></i>Task Comments</h5>
                                <div id="commentsList" class="mb-3">
                                    <!-- Comments will be loaded here -->
                                </div>
                                <div class="add-comment">
                                    <form id="commentForm">
                                        @csrf
                                        <input type="hidden" id="commentTaskId" name="task_id">
                                        <textarea class="form-control mb-2" id="newComment" name="comment"
                                            placeholder="Add a comment..." required></textarea>
                                        <button type="submit" class="btn btn-sm btn-primary">Add Comment</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Attachments Section -->
                            <div class="attachments-section">
                                <h5><i class="fas fa-paperclip me-2"></i>Attachments</h5>
                                <div id="attachmentsList" class="list-group">
                                    <!-- Attachments will be loaded here -->
                                </div>

                                <!-- Add Attachment Button -->
                                <div class="add-attachment mt-3" id="addAttachmentSection">
                                    <form id="attachmentForm">
                                        @csrf
                                        <input type="hidden" id="attachmentTaskId" name="task_id">
                                        <input type="file" class="form-control mb-2" id="newAttachment" name="attachments[]"
                                            multiple>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Upload File</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <div id="completionControls">
                        <!-- Completion checkbox will be placed here dynamically -->
                    </div>
                    <button type="button" class="btn btn-primary" id="updateTask">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

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
        document.addEventListener('DOMContentLoaded', function () {
            // Update greeting function
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

            // Initialize greeting
            updateGreeting();

            // Notification functionality
            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationBadge = document.getElementById('notificationBadge');
            const notificationCount = document.getElementById('notificationCount');
            const markAllReadBtn = document.querySelector('.mark-all-read');

            // Mark notifications as read when dropdown is shown
            notificationDropdown.addEventListener('shown.bs.dropdown', function () {
                if (parseInt(notificationBadge.textContent) > 0) {
                    document.querySelectorAll('.notification-item.unread').forEach(item => {
                        item.classList.remove('unread');
                        item.style.borderLeftColor = 'transparent';
                        item.style.backgroundColor = '';
                    });

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

                notificationBadge.textContent = '0';
                notificationCount.textContent = '0';
            });

            // Get tasks from server via AJAX
            fetch('{{ route("api.tasks") }}')
                .then(response => response.json())
                .then(data => {
                    initializeCalendar(data);
                })
                .catch(error => {
                    console.error('Error loading tasks:', error);
                    alert('Error loading tasks. Please refresh the page.');
                });

            function initializeCalendar(taskData) {
                const calendarEl = document.getElementById('taskCalendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: taskData.map(task => ({
                        id: task.id,
                        title: task.title,
                        start: task.start_date || task.created_at,
                        end: task.due_date,
                        className: `fc-event-${task.priority.name.toLowerCase()}-priority`,
                        extendedProps: {
                            description: task.description,
                            priority: task.priority,
                            status: task.user_status || 'pending',
                            creator: task.creator,
                            assignees: task.users || [],
                            attachments: task.attachments || [],
                            comments: task.comments || [],
                            task_id: task.id,
                            is_participant: task.is_participant
                        }
                    })),
                    eventClick: function (info) {
                        const task = info.event;
                        const props = task.extendedProps;

                        document.getElementById('commentTaskId').value = props.task_id;
                        document.getElementById('attachmentTaskId').value = props.task_id;

                        document.getElementById('detailTaskTitle').textContent = task.title;
                        document.getElementById('detailDescription').textContent = props.description || 'No description provided';
                        document.getElementById('detailCreator').textContent = props.creator ? props.creator.name : 'Unknown';

                        const priorityBadge = document.getElementById('detailPriority');
                        const priorityName = props.priority.name || 'Medium';
                        priorityBadge.textContent = priorityName;
                        priorityBadge.className = 'priority-badge ';
                        if (priorityName.toLowerCase() === 'high') {
                            priorityBadge.className += 'priority-high';
                        } else if (priorityName.toLowerCase() === 'medium') {
                            priorityBadge.className += 'priority-medium';
                        } else {
                            priorityBadge.className += 'priority-low';
                        }

                        const statusElement = document.getElementById('detailStatus');
                        statusElement.textContent = props.status;

                        const startDate = task.start ? new Date(task.start) : new Date();
                        const dueDate = task.end ? new Date(task.end) : new Date(task.start);

                        document.getElementById('detailStartDate').textContent = startDate.toLocaleDateString();
                        document.getElementById('detailDueDate').textContent = dueDate.toLocaleDateString();

                        const assigneesElement = document.getElementById('detailAssignees');
                        assigneesElement.innerHTML = '';

                        if (props.assignees && props.assignees.length > 0) {
                            const assigneeNames = props.assignees.map(user => user.name).join(', ');
                            assigneesElement.textContent = assigneeNames;
                        } else {
                            assigneesElement.textContent = 'No assignees';
                        }

                        const progressBar = document.getElementById('detailProgress');
                        const progressText = document.getElementById('progressText');
                        if (props.status && props.status.toLowerCase() === 'completed') {
                            progressBar.style.width = '100%';
                            progressBar.textContent = 'Completed';
                            progressBar.className = 'progress-bar bg-success';
                            progressText.textContent = 'Task completed';
                        } else if (props.status && props.status.toLowerCase() === 'in_progress') {
                            progressBar.style.width = '60%';
                            progressBar.textContent = 'In Progress';
                            progressBar.className = 'progress-bar bg-warning';
                            progressText.textContent = 'Task in progress - completion submitted';
                        } else {
                            progressBar.style.width = '30%';
                            progressBar.textContent = 'Pending';
                            progressBar.className = 'progress-bar bg-info';
                            progressText.textContent = 'Task pending';
                        }

                        const attachmentsList = document.getElementById('attachmentsList');
                        attachmentsList.innerHTML = '';

                        if (props.attachments && props.attachments.length > 0) {
                            props.attachments.forEach(attachment => {
                                const fileLink = document.createElement('a');
                                fileLink.href = `/storage/${attachment.path}`;
                                fileLink.target = '_blank';
                                fileLink.className = 'list-group-item list-group-item-action';

                                const fileIcon = getFileIcon(attachment.type);
                                const uploadDate = new Date(attachment.created_at).toLocaleDateString();

                                fileLink.innerHTML = `
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            <i class="${fileIcon} me-2"></i>
                                            ${attachment.filename}
                                        </div>
                                        <small>${uploadDate}</small>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <small class="text-muted">${formatFileSize(attachment.size)}</small>
                                        <small>Uploaded by: ${attachment.uploaded_by}</small>
                                    </div>
                                `;

                                attachmentsList.appendChild(fileLink);
                            });
                        } else {
                            const noAttachments = document.createElement('div');
                            noAttachments.className = 'list-group-item';
                            noAttachments.textContent = 'No attachments yet';
                            attachmentsList.appendChild(noAttachments);
                        }

                        const commentsList = document.getElementById('commentsList');
                        commentsList.innerHTML = '';

                        if (props.comments && props.comments.length > 0) {
                            props.comments.forEach(comment => {
                                const commentElement = document.createElement('div');
                                commentElement.className = 'card mb-2';
                                commentElement.innerHTML = `
                                    <div class="card-body p-2">
                                        <div class="d-flex justify-content-between">
                                            <strong>${comment.user.name}</strong>
                                            <small class="text-muted">${new Date(comment.created_at).toLocaleString()}</small>
                                        </div>
                                        <p class="mb-0 mt-1">${comment.comment}</p>
                                    </div>
                                `;
                                commentsList.appendChild(commentElement);
                            });
                        } else {
                            const noComments = document.createElement('div');
                            noComments.className = 'alert alert-info';
                            noComments.textContent = 'No comments yet';
                            commentsList.appendChild(noComments);
                        }

                        const modal = new bootstrap.Modal(document.getElementById('taskDetailModal'));
                        modal.show();
                    }
                });

                calendar.render();

                document.getElementById('prevWeek').addEventListener('click', function () {
                    calendar.prev();
                });

                document.getElementById('today').addEventListener('click', function () {
                    calendar.today();
                });

                document.getElementById('nextWeek').addEventListener('click', function () {
                    calendar.next();
                });
            }

            document.getElementById('commentForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const taskId = document.getElementById('commentTaskId').value;

                fetch(`/tasks/${taskId}/comments`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            document.getElementById('newComment').value = '';
                            const calendarEl = document.getElementById('taskCalendar');
                            const calendar = FullCalendar.getCalendar(calendarEl);
                            calendar.refetchEvents();
                            alert('Comment added successfully');
                        }
                    })
                    .catch(error => {
                        console.error('Error adding comment:', error);
                        alert('Error adding comment. Please try again.');
                    });
            });

            document.getElementById('attachmentForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const taskId = document.getElementById('attachmentTaskId').value;

                fetch(`/tasks/${taskId}/attachments`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            document.getElementById('newAttachment').value = '';
                            const calendarEl = document.getElementById('taskCalendar');
                            const calendar = FullCalendar.getCalendar(calendarEl);
                            calendar.refetchEvents();
                            alert('Files uploaded successfully');
                        }
                    })
                    .catch(error => {
                        console.error('Error uploading files:', error);
                        alert('Error uploading files. Please try again.');
                    });
            });

            // Toggle sidebar on mobile
            document.getElementById('sidebarToggle').addEventListener('click', function () {
                document.getElementById('sidebar').classList.toggle('active');
                document.getElementById('mainContent').classList.toggle('active');
            });

            // Helper functions
            function getFileIcon(mimeType) {
                if (!mimeType) return 'fas fa-file';

                if (mimeType.startsWith('image/')) {
                    return 'fas fa-file-image';
                } else if (mimeType === 'application/pdf') {
                    return 'fas fa-file-pdf';
                } else if (mimeType.startsWith('video/')) {
                    return 'fas fa-file-video';
                } else if (mimeType.startsWith('audio/')) {
                    return 'fas fa-file-audio';
                } else if (mimeType.startsWith('application/vnd.ms-excel') || mimeType.includes('spreadsheetml')) {
                    return 'fas fa-file-excel';
                } else if (mimeType.startsWith('application/msword') || mimeType.includes('wordprocessingml')) {
                    return 'fas fa-file-word';
                } else if (mimeType.startsWith('application/zip') || mimeType.includes('compressed')) {
                    return 'fas fa-file-archive';
                } else {
                    return 'fas fa-file';
                }
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';

                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));

                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Update greeting every minute
            setInterval(updateGreeting, 60000);
        });
    </script>
@endsection