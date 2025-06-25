@extends('chairperson.genchair')
@section('title', 'Team Performance')

@section('content')
    <div class="main-content">
        <!-- Top Navigation with Fixed Greeting -->
        <nav class="top-navbar navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2 px-3 mb-4 sticky-top">
            <div class="container-fluid d-flex justify-content-between align-items-center p-0">
                <!-- Left side - Toggle button and Brand -->
                <div class="d-flex align-items-center">
                    <!-- Hamburger menu -->
                    <button class="sidebar-collapse-btn btn btn-link text-dark p-0 me-2 me-md-3 d-lg-none" id="sidebarToggle">
                        <i class="fas fa-bars fs-4"></i>
                    </button>
                    <span class="navbar-brand fw-bold text-primary ms-1 ms-md-2" id="adminGreeting">
                        @php
                            date_default_timezone_set('Asia/Manila');
                            $hour = date('H');
                            if ($hour < 12) {
                                echo 'Good Morning';
                            } elseif ($hour < 18) {
                                echo 'Good Afternoon';
                            } else {
                                echo 'Good Evening';
                            }
                        @endphp
                    </span>
                </div>

                <!-- Right side - Navigation and User Info -->
                <div class="d-flex align-items-center">
                    <!-- Notification and User Profile -->
                    <div class="d-flex align-items-center ms-2 ms-lg-0">
                        <!-- Notification -->
                        <div class="dropdown position-relative me-2 me-lg-3">
                            <button class="btn btn-link text-dark p-0 position-relative dropdown-toggle"
                                id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationBadge">
                                    3
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end notification-dropdown p-0" aria-labelledby="notificationDropdown">
                                <div class="d-flex justify-content-between align-items-center p-3 border-bottom bg-light">
                                    <h6 class="m-0 fw-bold">Notifications</h6>
                                    <div>
                                        <span class="badge bg-primary rounded-pill me-2" id="notificationCount">3</span>
                                        <button class="btn btn-sm btn-link text-muted p-0 mark-all-read" title="Mark all as read">
                                            <i class="fas fa-check-double"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="notification-list" style="max-height: 400px; overflow-y: auto;">
                                    <!-- Notification items -->
                                    <a href="#" class="dropdown-item d-flex py-3 px-3 notification-item unread">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle">
                                                <i class="fas fa-user-check text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h6 class="mb-0 fw-semibold">New User Registered</h6>
                                                <small class="text-muted">2 min ago</small>
                                            </div>
                                            <p class="mb-0 text-muted small">John Doe has registered as a new user.</p>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex py-3 px-3 notification-item">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-info bg-opacity-10 p-2 rounded-circle">
                                                <i class="fas fa-tasks text-info"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h6 class="mb-0 fw-semibold">Task Completed</h6>
                                                <small class="text-muted">1 hour ago</small>
                                            </div>
                                            <p class="mb-0 text-muted small">"Quarterly Report" was marked as completed.</p>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex py-3 px-3 notification-item">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-warning bg-opacity-10 p-2 rounded-circle">
                                                <i class="fas fa-exclamation-triangle text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <h6 class="mb-0 fw-semibold">Task Overdue</h6>
                                                <small class="text-muted">3 hours ago</small>
                                            </div>
                                            <p class="mb-0 text-muted small">"Client Proposal" is now overdue.</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- User Profile -->
                        <div class="d-flex align-items-center ms-2 ms-lg-3 border-start ps-2 ps-lg-3">
                            <img src="{{ asset('storage/profile/avatars/profile.png') }}"
                                alt="User Profile" class="rounded-circle me-2 border border-2 border-primary" width="40" height="40">
                            <div class="d-none d-md-inline">
                                <div class="fw-bold text-dark">John Smith</div>
                                <div class="small text-muted">Chairperson</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="dashboard-container">
            <!-- Performance Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total Members</h6>
                                    <h3 class="mb-0" id="totalMembers">12</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-users text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Avg Completion</h6>
                                    <h3 class="mb-0" id="avgCompletion">78%</h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Top Performers</h6>
                                    <h3 class="mb-0" id="topPerformersCount">5</h3>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-star text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Tasks Completed</h6>
                                    <h3 class="mb-0" id="totalCompleted">142</h3>
                                </div>
                                <div class="bg-info bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-tasks text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex">
                    <div class="input-group input-group-sm me-2" style="width: 200px;">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search team members...">
                    </div>
                    <div class="dropdown me-2">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-filter me-1"></i> Performance
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item filter-option active" href="#" data-filter="all">All Members</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="top">Top Performers (80%+)</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="average">Average (50-79%)</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="low">Low Performers (<50%)</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-sort me-1"></i> Sort By
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item sort-option active" href="#" data-sort="name-asc">Name (A-Z)</a></li>
                            <li><a class="dropdown-item sort-option" href="#" data-sort="name-desc">Name (Z-A)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item sort-option" href="#" data-sort="score-desc">Performance (High-Low)</a></li>
                            <li><a class="dropdown-item sort-option" href="#" data-sort="score-asc">Performance (Low-High)</a></li>
                        </ul>
                    </div>
                </div>
                <div class="text-muted small">
                    Showing <span id="showingCount">12</span> of 12 members
                </div>
            </div>

            <!-- Main Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Team Member</th>
                            <th>Department</th>
                            <th class="text-center">Completed</th>
                            <th class="text-center">Overdue</th>
                            <th class="text-center">Total</th>
                            <th class="pe-4">Completion Rate</th>
                            <th class="text-center">Performance</th>
                        </tr>
                    </thead>
                    <tbody id="teamMembersTable">
                        <!-- Team members will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Showing <span id="paginationFrom">1</span>-<span id="paginationTo">12</span> of <span id="paginationTotal">12</span> members
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm" id="paginationControls">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <style>
        .top-navbar {
            transition: all 0.3s ease;
        }
        .dashboard-container {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            padding: 1.5rem;
        }
        .member-row:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }
        .progress {
            height: 8px;
            border-radius: 4px;
        }
        .progress-bar {
            border-radius: 4px;
        }
        .performance-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }
        .high-performance {
            background-color: #d1fae5;
            color: #065f46;
        }
        .medium-performance {
            background-color: #fef3c7;
            color: #92400e;
        }
        .low-performance {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .notification-dropdown {
            width: 350px;
        }
        .notification-item {
            border-bottom: 1px solid #f0f0f0;
        }
        .notification-item.unread {
            background-color: #f8f9fa;
        }
        .notification-item:hover {
            background-color: #f8f9fa;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Sample team member data
            const teamMembers = [
                {
                    id: 1,
                    name: "Sarah Johnson",
                    email: "sarah.johnson@example.com",
                    avatar: "profile1.png",
                    department: "Marketing",
                    completed_tasks: 18,
                    overdue_tasks: 2,
                    total_tasks: 20,
                    last_active: "2023-05-15"
                },
                {
                    id: 2,
                    name: "Michael Chen",
                    email: "michael.chen@example.com",
                    avatar: "profile2.png",
                    department: "Development",
                    completed_tasks: 15,
                    overdue_tasks: 1,
                    total_tasks: 16,
                    last_active: "2023-05-14"
                },
                {
                    id: 3,
                    name: "Emily Rodriguez",
                    email: "emily.rodriguez@example.com",
                    avatar: "profile3.png",
                    department: "Design",
                    completed_tasks: 12,
                    overdue_tasks: 3,
                    total_tasks: 15,
                    last_active: "2023-05-13"
                },
                {
                    id: 4,
                    name: "David Kim",
                    email: "david.kim@example.com",
                    avatar: "profile4.png",
                    department: "Sales",
                    completed_tasks: 22,
                    overdue_tasks: 0,
                    total_tasks: 22,
                    last_active: "2023-05-15"
                },
                {
                    id: 5,
                    name: "Jessica Williams",
                    email: "jessica.williams@example.com",
                    avatar: "profile5.png",
                    department: "Marketing",
                    completed_tasks: 14,
                    overdue_tasks: 4,
                    total_tasks: 18,
                    last_active: "2023-05-12"
                },
                {
                    id: 6,
                    name: "Robert Taylor",
                    email: "robert.taylor@example.com",
                    avatar: "profile6.png",
                    department: "Development",
                    completed_tasks: 10,
                    overdue_tasks: 5,
                    total_tasks: 15,
                    last_active: "2023-05-11"
                },
                {
                    id: 7,
                    name: "Jennifer Lee",
                    email: "jennifer.lee@example.com",
                    avatar: "profile7.png",
                    department: "HR",
                    completed_tasks: 19,
                    overdue_tasks: 1,
                    total_tasks: 20,
                    last_active: "2023-05-15"
                },
                {
                    id: 8,
                    name: "Daniel Brown",
                    email: "daniel.brown@example.com",
                    avatar: "profile8.png",
                    department: "Finance",
                    completed_tasks: 16,
                    overdue_tasks: 2,
                    total_tasks: 18,
                    last_active: "2023-05-14"
                },
                {
                    id: 9,
                    name: "Amanda Wilson",
                    email: "amanda.wilson@example.com",
                    avatar: "profile9.png",
                    department: "Design",
                    completed_tasks: 11,
                    overdue_tasks: 3,
                    total_tasks: 14,
                    last_active: "2023-05-13"
                },
                {
                    id: 10,
                    name: "Christopher Martinez",
                    email: "christopher.martinez@example.com",
                    avatar: "profile10.png",
                    department: "Development",
                    completed_tasks: 17,
                    overdue_tasks: 1,
                    total_tasks: 18,
                    last_active: "2023-05-15"
                },
                {
                    id: 11,
                    name: "Elizabeth Anderson",
                    email: "elizabeth.anderson@example.com",
                    avatar: "profile11.png",
                    department: "Marketing",
                    completed_tasks: 13,
                    overdue_tasks: 2,
                    total_tasks: 15,
                    last_active: "2023-05-12"
                },
                {
                    id: 12,
                    name: "Matthew Thomas",
                    email: "matthew.thomas@example.com",
                    avatar: "profile12.png",
                    department: "Sales",
                    completed_tasks: 20,
                    overdue_tasks: 0,
                    total_tasks: 20,
                    last_active: "2023-05-15"
                }
            ];

            // Render team members table
            function renderTeamMembers(members) {
                const $tableBody = $('#teamMembersTable');
                $tableBody.empty();
                
                members.forEach(member => {
                    const percentage = member.total_tasks > 0 ? Math.round((member.completed_tasks / member.total_tasks) * 100) : 0;
                    const progressClass = percentage >= 80 ? 'bg-success' : (percentage >= 50 ? 'bg-warning' : 'bg-danger');
                    const performanceLevel = percentage >= 80 ? 'High' : (percentage >= 50 ? 'Medium' : 'Low');
                    const performanceClass = percentage >= 80 ? 'high-performance' : (percentage >= 50 ? 'medium-performance' : 'low-performance');
                    const performanceScore = (percentage * 0.7) + (Math.min(member.total_tasks, 20) * 1.5);
                    
                    const $row = $(`
                        <tr class="member-row" 
                            data-id="${member.id}"
                            data-name="${member.name.toLowerCase()}"
                            data-email="${member.email.toLowerCase()}"
                            data-department="${member.department.toLowerCase()}"
                            data-percentage="${percentage}"
                            data-performance="${performanceLevel.toLowerCase()}"
                            data-score="${performanceScore}"
                            data-tasks="${member.total_tasks}"
                            data-completed="${member.completed_tasks}"
                            data-overdue="${member.overdue_tasks}">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/profile/avatars/') }}/${member.avatar}" 
                                        alt="${member.name}" class="rounded-circle me-3" width="40" height="40">
                                    <div>
                                        <div class="fw-semibold">${member.name}</div>
                                        <div class="small text-muted">${member.email}</div>
                                    </div>
                                </div>
                            </td>
                            <td>${member.department}</td>
                            <td class="text-center">${member.completed_tasks}</td>
                            <td class="text-center">${member.overdue_tasks}</td>
                            <td class="text-center">${member.total_tasks}</td>
                            <td class="pe-4">
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                        <div class="progress-bar ${progressClass}" role="progressbar" 
                                            style="width: ${percentage}%" 
                                            aria-valuenow="${percentage}" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100"></div>
                                    </div>
                                    <span class="fw-semibold">${percentage}%</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="performance-badge ${performanceClass}">${performanceLevel}</span>
                            </td>
                        </tr>
                    `);
                    
                    $tableBody.append($row);
                });
                
                updateTeamStats();
                updateShowingCount();
            }

            // Calculate and update team statistics
            function updateTeamStats() {
                let stats = {
                    totalTasks: 0,
                    completedTasks: 0,
                    overdueTasks: 0,
                    totalPercentage: 0,
                    memberCount: 0,
                    topPerformers: 0
                };
                
                $('.member-row').each(function() {
                    const tasks = parseInt($(this).data('tasks'));
                    if (!isNaN(tasks) && tasks > 0) {
                        stats.totalTasks += tasks;
                        stats.completedTasks += parseInt($(this).data('completed'));
                        stats.overdueTasks += parseInt($(this).data('overdue'));
                        const percentage = parseFloat($(this).data('percentage'));
                        stats.totalPercentage += percentage;
                        stats.memberCount++;
                        
                        if (percentage >= 80) {
                            stats.topPerformers++;
                        }
                    }
                });
                
                const avgCompletion = stats.memberCount > 0 ? Math.round(stats.totalPercentage / stats.memberCount) : 0;
                $('#avgCompletion').text(avgCompletion + '%');
                $('#topPerformersCount').text(stats.topPerformers);
                $('#totalCompleted').text(stats.completedTasks);
                $('#totalMembers').text(stats.memberCount);
            }
            
            // Update showing count
            function updateShowingCount() {
                const visibleCount = $('.member-row:visible').length;
                $('#showingCount').text(visibleCount);
                $('#paginationTotal').text(visibleCount);
                $('#paginationFrom').text(1);
                $('#paginationTo').text(visibleCount);
            }
            
            // Search functionality
            $('#searchInput').on('keyup', function() {
                const searchText = $(this).val().toLowerCase();
                $('.member-row').each(function() {
                    const showRow = $(this).data('name').includes(searchText) || 
                                  $(this).data('email').includes(searchText) || 
                                  $(this).data('department').includes(searchText);
                    $(this).toggle(showRow);
                });
                updateShowingCount();
            });
            
            // Filter functionality
            $('.filter-option').click(function(e) {
                e.preventDefault();
                $('.filter-option').removeClass('active');
                $(this).addClass('active');
                
                const filter = $(this).data('filter');
                $('.member-row').each(function() {
                    const percentage = parseFloat($(this).data('percentage'));
                    let showRow = true;
                    
                    if (filter === 'top') showRow = percentage >= 80;
                    else if (filter === 'average') showRow = percentage >= 50 && percentage < 80;
                    else if (filter === 'low') showRow = percentage < 50;
                    
                    $(this).toggle(showRow);
                });
                updateShowingCount();
                updateTeamStats();
            });
            
            // Sort functionality
            $('.sort-option').click(function(e) {
                e.preventDefault();
                $('.sort-option').removeClass('active');
                $(this).addClass('active');
                
                const sortType = $(this).data('sort');
                let sortedMembers = [...teamMembers];
                
                switch(sortType) {
                    case 'name-asc':
                        sortedMembers.sort((a, b) => a.name.localeCompare(b.name));
                        break;
                    case 'name-desc':
                        sortedMembers.sort((a, b) => b.name.localeCompare(a.name));
                        break;
                    case 'score-desc':
                        sortedMembers.sort((a, b) => {
                            const scoreA = (a.completed_tasks / a.total_tasks * 70) + (Math.min(a.total_tasks, 20) * 1.5);
                            const scoreB = (b.completed_tasks / b.total_tasks * 70) + (Math.min(b.total_tasks, 20) * 1.5);
                            return scoreB - scoreA;
                        });
                        break;
                    case 'score-asc':
                        sortedMembers.sort((a, b) => {
                            const scoreA = (a.completed_tasks / a.total_tasks * 70) + (Math.min(a.total_tasks, 20) * 1.5);
                            const scoreB = (b.completed_tasks / b.total_tasks * 70) + (Math.min(b.total_tasks, 20) * 1.5);
                            return scoreA - scoreB;
                        });
                        break;
                }
                
                renderTeamMembers(sortedMembers);
            });
            
            // Mark all notifications as read
            $('.mark-all-read').click(function() {
                $('#notificationBadge').text('0');
                $('#notificationCount').text('0');
                $('.notification-item').removeClass('unread');
            });
            
            // Initialize the page
            renderTeamMembers(teamMembers);
        });
    </script>
@endsection