@extends('genview')
@section('title', 'Departments')

@section('content')
    <style>
        /* Binder-style container */
        .binder-container {
            background: #f5f7fa;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            margin-bottom: 40px;
        }

        /* Binder spine effect */
        .binder-container::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 30px;
            background: linear-gradient(90deg, #2c3e50 0%, #34495e 100%);
            border-right: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        /* Binder rings */
        .binder-rings {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .binder-ring {
            width: 12px;
            height: 30px;
            background: linear-gradient(90deg, #95a5a6 0%, #bdc3c7 100%);
            border-radius: 6px;
            box-shadow: inset 2px 0 3px rgba(0, 0, 0, 0.2);
        }

        /* Department tabs */
        .department-tabs {
            display: flex;
            background: #ecf0f1;
            border-bottom: 1px solid #d6dbdf;
            padding-left: 40px;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .department-tabs::-webkit-scrollbar {
            display: none;
        }

        .department-tab {
            padding: 15px 25px;
            cursor: pointer;
            position: relative;
            font-weight: 600;
            color: #7f8c8d;
            transition: all 0.3s ease;
            white-space: nowrap;
            border-right: 1px solid #d6dbdf;
        }

        .department-tab:first-child {
            border-left: 1px solid #d6dbdf;
        }

        .department-tab:hover {
            background: #dfe6e9;
            color: #2c3e50;
        }

        .department-tab.active {
            background: #fff;
            color: #2c3e50;
            border-top: 3px solid #3498db;
        }

        .department-tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 1px;
            background: #fff;
        }

        /* Department content */
        .department-content {
            padding: 25px 30px 30px 50px;
            background: #fff;
            min-height: 400px;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Department header */
        .department-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ecf0f1;
        }

        .department-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .department-title i {
            margin-right: 12px;
            color: #3498db;
            font-size: 1.8rem;
        }

        .department-meta {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .member-count {
            background-color: #e3f2fd;
            color: #1976d2;
            border-radius: 20px;
            padding: 6px 15px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .member-count i {
            font-size: 0.9rem;
        }

        .manager-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            color: #34495e;
            background: #f8f9fa;
            padding: 6px 15px;
            border-radius: 20px;
            border: 1px solid #e9ecef;
        }

        .manager-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }

        /* Search box */
        .search-container {
            position: relative;
            width: 300px;
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .search-input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            background-color: #fff;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }

        /* Member table styles */
        .member-list-view {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .member-list-view thead th {
            text-align: left;
            padding: 12px 20px;
            font-weight: 600;
            color: #7f8c8d;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #ecf0f1;
            background-color: #f8f9fa;
            position: sticky;
            top: 0;
        }

        .member-list-view tbody tr {
            transition: all 0.2s ease;
        }

        .member-list-view tbody tr:hover {
            background-color: #f8fafc;
            transform: translateX(2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .member-list-view td {
            padding: 15px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #ecf0f1;
        }

        .member-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .member-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .member-list-view tbody tr:hover .member-avatar {
            transform: scale(1.05);
            border-color: #3498db;
        }

        .member-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 2px;
        }

        .member-role {
            font-weight: 500;
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .member-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 12px;
            background-color: #f0f2f5;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .status-active {
            background-color: #2ecc71;
            box-shadow: 0 0 6px rgba(46, 204, 113, 0.5);
        }

        .status-inactive {
            background-color: #e74c3c;
            box-shadow: 0 0 6px rgba(231, 76, 60, 0.3);
        }

        .status-away {
            background-color: #f39c12;
            box-shadow: 0 0 6px rgba(243, 156, 18, 0.4);
        }

        .member-email {
            color: #7f8c8d;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .member-list-view tbody tr:hover .member-email {
            color: #3498db;
        }

        .member-phone {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .member-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: #7f8c8d;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .action-btn i {
            font-size: 1rem;
        }

        .action-btn.view {
            color: #3498db;
            background: #e3f2fd;
            border-color: #bbdefb;
        }

        .action-btn.view:hover {
            background: #bbdefb;
        }

        .action-btn.message {
            color: #9b59b6;
            background: #f3e5f5;
            border-color: #e1bee7;
        }

        .action-btn.message:hover {
            background: #e1bee7;
        }

        .action-btn.edit {
            color: #27ae60;
            background: #e8f5e9;
            border-color: #c8e6c9;
        }

        .action-btn.edit:hover {
            background: #c8e6c9;
        }

        .action-btn.delete {
            color: #e74c3c;
            background: #ffebee;
            border-color: #ffcdd2;
        }

        .action-btn.delete:hover {
            background: #ffcdd2;
        }

        /* No members placeholder */
        .no-members {
            text-align: center;
            padding: 60px 20px;
            color: #bdc3c7;
            font-size: 1rem;
        }

        .no-members i {
            font-size: 3rem;
            margin-bottom: 20px;
            display: block;
            color: #ecf0f1;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .department-meta {
                flex-direction: column;
                gap: 10px;
                align-items: flex-end;
            }
        }

        @media (max-width: 768px) {
            .binder-container::before {
                width: 20px;
            }
            
            .binder-rings {
                left: 10px;
            }
            
            .department-tabs {
                padding-left: 30px;
            }
            
            .department-content {
                padding: 20px 20px 20px 40px;
            }
            
            .department-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .department-meta {
                flex-direction: row;
                align-items: center;
                width: 100%;
                justify-content: space-between;
            }
            
            .search-container {
                width: 100%;
            }
            
            .member-list-view thead {
                display: none;
            }
            
            .member-list-view tbody tr {
                display: block;
                padding: 15px 10px;
                border-bottom: 1px solid #ecf0f1;
            }
            
            .member-list-view td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 10px;
                border: none;
            }
            
            .member-list-view td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #7f8c8d;
                font-size: 0.8rem;
                margin-right: 15px;
            }
            
            .member-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            
            .member-actions {
                opacity: 1;
                justify-content: flex-end;
                width: 100%;
            }
        }

        /* Animation for tab switching */
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .department-pane {
            animation: slideIn 0.3s ease-out;
        }
    </style>

    <div class="main-content">
        <!-- Top Navigation -->
        <nav class="top-navbar navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2 px-3 mb-4 sticky-top">
            <div class="container-fluid d-flex justify-content-between align-items-center p-0">
                <div class="d-flex align-items-center">
                    <button class="sidebar-collapse-btn btn btn-link text-dark p-0 me-2 me-md-3 d-lg-none" id="sidebarToggle">
                        <i class="fas fa-bars fs-4"></i>
                    </button>
                    <span class="navbar-brand fw-bold text-primary ms-1 ms-md-2" id="adminGreeting">Good Morning</span>
                </div>

                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center ms-2 ms-lg-0">
                        <div class="dropdown position-relative me-2 me-lg-3">
                            <button class="btn btn-link text-dark p-0 position-relative dropdown-toggle" id="notificationDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationBadge">3</span>
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
                                    <a href="#" class="dropdown-item d-flex py-3 px-3 notification-item unread">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
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
                                    <div class="text-center py-3 bg-light border-top">
                                        <a href="#" class="text-primary fw-semibold small">View All Notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center ms-2 ms-lg-3 border-start ps-2 ps-lg-3">
                            <img src="https://via.placeholder.com/40" alt="User Profile" class="rounded-circle me-2 border border-2 border-primary" width="40" height="40">
                            <div class="d-none d-md-inline">
                                <div class="fw-bold text-dark">Admin User</div>
                                <div class="small text-muted">Administrator</div>
                            </div>
                            <div class="d-inline d-md-none">
                                <div class="fw-bold text-dark">Admin</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Departments Content -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Department Management</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                <i class="fas fa-plus me-2"></i>Add Department
            </button>
        </div>

        <!-- Binder-style Departments Container -->
        <div class="binder-container">
            <!-- Binder rings -->
            <div class="binder-rings">
                <div class="binder-ring"></div>
                <div class="binder-ring"></div>
                <div class="binder-ring"></div>
            </div>
            
            <!-- Department Tabs -->
            <div class="department-tabs">
                <div class="department-tab active" onclick="showDepartment('it')">
                    <i class="fas fa-laptop-code me-2"></i>Information Technology
                </div>
                <div class="department-tab" onclick="showDepartment('hr')">
                    <i class="fas fa-users me-2"></i>Human Resources
                </div>
                <div class="department-tab" onclick="showDepartment('marketing')">
                    <i class="fas fa-bullhorn me-2"></i>Marketing
                </div>
                <div class="department-tab" onclick="showDepartment('finance')">
                    <i class="fas fa-coins me-2"></i>Finance
                </div>
                <div class="department-tab" onclick="showDepartment('operations')">
                    <i class="fas fa-cogs me-2"></i>Operations
                </div>
            </div>
            
            <!-- Department Content Panes -->
            <div class="department-content">
                <!-- IT Department (default visible) -->
                <div id="it-department" class="department-pane">
                    <div class="department-header">
                        <h2 class="department-title">
                            <i class="fas fa-laptop-code"></i>Information Technology Department
                        </h2>
                        <div class="department-meta">
                            <span class="member-count">
                                <i class="fas fa-users"></i> 5 Members
                            </span>
                            <div class="manager-info">
                                <img src="https://via.placeholder.com/32" alt="Manager" class="manager-avatar">
                                <span>Sarah Johnson</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search IT team..." id="itSearch" oninput="searchMembers('itSearch', 'it-members')">
                    </div>
                    
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="member-list-view">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="it-members">
                                <!-- Member 1 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42" alt="Sarah Johnson" class="member-avatar">
                                            <div>
                                                <div class="member-name">Sarah Johnson</div>
                                                <div class="member-role">IT Chairperson</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-active"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">IT Chairperson</td>
                                    <td data-label="Email" class="member-email">sarah.j@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 123-4567</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Sarah Johnson')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Sarah Johnson')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Sarah Johnson')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Member 2 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/007bff" alt="Michael Chen" class="member-avatar">
                                            <div>
                                                <div class="member-name">Michael Chen</div>
                                                <div class="member-role">Senior Developer</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-active"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">Senior Developer</td>
                                    <td data-label="Email" class="member-email">michael.c@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 234-5678</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Michael Chen')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Michael Chen')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Michael Chen')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Member 3 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/28a745" alt="David Wilson" class="member-avatar">
                                            <div>
                                                <div class="member-name">David Wilson</div>
                                                <div class="member-role">System Administrator</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-away"></span>
                                            Away
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">System Administrator</td>
                                    <td data-label="Email" class="member-email">david.w@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 345-6789</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'David Wilson')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'David Wilson')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'David Wilson')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Member 4 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/6f42c1" alt="Emily Rodriguez" class="member-avatar">
                                            <div>
                                                <div class="member-name">Emily Rodriguez</div>
                                                <div class="member-role">UI/UX Designer</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-active"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">UI/UX Designer</td>
                                    <td data-label="Email" class="member-email">emily.r@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 456-7890</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Emily Rodriguez')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Emily Rodriguez')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Emily Rodriguez')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Member 5 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/fd7e14" alt="Robert Kim" class="member-avatar">
                                            <div>
                                                <div class="member-name">Robert Kim</div>
                                                <div class="member-role">Junior Developer</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-inactive"></span>
                                            Inactive
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">Junior Developer</td>
                                    <td data-label="Email" class="member-email">robert.k@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 567-8901</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Robert Kim')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Robert Kim')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Robert Kim')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- HR Department (hidden by default) -->
                <div id="hr-department" class="department-pane" style="display: none;">
                    <div class="department-header">
                        <h2 class="department-title">
                            <i class="fas fa-users"></i>Human Resources Department
                        </h2>
                        <div class="department-meta">
                            <span class="member-count">
                                <i class="fas fa-users"></i> 3 Members
                            </span>
                            <div class="manager-info">
                                <img src="https://via.placeholder.com/32/6c757d" alt="Manager" class="manager-avatar">
                                <span>No manager assigned</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search HR team..." id="hrSearch" oninput="searchMembers('hrSearch', 'hr-members')">
                    </div>
                    
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="member-list-view">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="hr-members">
                                <!-- Member 1 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/6c757d" alt="Jennifer Lee" class="member-avatar">
                                            <div>
                                                <div class="member-name">Jennifer Lee</div>
                                                <div class="member-role">HR Specialist</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-active"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">HR Specialist</td>
                                    <td data-label="Email" class="member-email">jennifer.l@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 678-9012</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Jennifer Lee')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Jennifer Lee')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Jennifer Lee')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Member 2 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/17a2b8" alt="Thomas Brown" class="member-avatar">
                                            <div>
                                                <div class="member-name">Thomas Brown</div>
                                                <div class="member-role">Recruiter</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-active"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">Recruiter</td>
                                    <td data-label="Email" class="member-email">thomas.b@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 789-0123</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Thomas Brown')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Thomas Brown')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Thomas Brown')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Member 3 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/dc3545" alt="Lisa Wong" class="member-avatar">
                                            <div>
                                                <div class="member-name">Lisa Wong</div>
                                                <div class="member-role">Training Coordinator</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-away"></span>
                                            Away
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">Training Coordinator</td>
                                    <td data-label="Email" class="member-email">lisa.w@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 890-1234</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Lisa Wong')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Lisa Wong')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Lisa Wong')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Marketing Department (hidden by default) -->
                <div id="marketing-department" class="department-pane" style="display: none;">
                    <div class="department-header">
                        <h2 class="department-title">
                            <i class="fas fa-bullhorn"></i>Marketing Department
                        </h2>
                        <div class="department-meta">
                            <span class="member-count">
                                <i class="fas fa-users"></i> 4 Members
                            </span>
                            <div class="manager-info">
                                <img src="https://via.placeholder.com/32/17a2b8" alt="Manager" class="manager-avatar">
                                <span>Daniel Miller</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search Marketing team..." id="marketingSearch" oninput="searchMembers('marketingSearch', 'marketing-members')">
                    </div>
                    
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="member-list-view">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="marketing-members">
                                <!-- Member 1 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/17a2b8" alt="Daniel Miller" class="member-avatar">
                                            <div>
                                                <div class="member-name">Daniel Miller</div>
                                                <div class="member-role">Marketing Director</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-active"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">Marketing Director</td>
                                    <td data-label="Email" class="member-email">daniel.m@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 901-2345</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Daniel Miller')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Daniel Miller')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Daniel Miller')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Member 2 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/ffc107" alt="Amanda Garcia" class="member-avatar">
                                            <div>
                                                <div class="member-name">Amanda Garcia</div>
                                                <div class="member-role">Content Strategist</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-active"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">Content Strategist</td>
                                    <td data-label="Email" class="member-email">amanda.g@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 012-3456</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Amanda Garcia')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Amanda Garcia')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Amanda Garcia')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Member 3 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/28a745" alt="Kevin Patel" class="member-avatar">
                                            <div>
                                                <div class="member-name">Kevin Patel</div>
                                                <div class="member-role">Digital Marketer</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-inactive"></span>
                                            Inactive
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">Digital Marketer</td>
                                    <td data-label="Email" class="member-email">kevin.p@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 123-4560</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Kevin Patel')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Kevin Patel')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Kevin Patel')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Member 4 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/6f42c1" alt="Sophia Martinez" class="member-avatar">
                                            <div>
                                                <div class="member-name">Sophia Martinez</div>
                                                <div class="member-role">Social Media Manager</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-away"></span>
                                            Away
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">Social Media Manager</td>
                                    <td data-label="Email" class="member-email">sophia.m@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 234-5601</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Sophia Martinez')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Sophia Martinez')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Sophia Martinez')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Finance Department (hidden by default) -->
                <div id="finance-department" class="department-pane" style="display: none;">
                    <div class="department-header">
                        <h2 class="department-title">
                            <i class="fas fa-coins"></i>Finance Department
                        </h2>
                        <div class="department-meta">
                            <span class="member-count">
                                <i class="fas fa-users"></i> 2 Members
                            </span>
                            <div class="manager-info">
                                <img src="https://via.placeholder.com/32/28a745" alt="Manager" class="manager-avatar">
                                <span>James Wilson</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search Finance team..." id="financeSearch" oninput="searchMembers('financeSearch', 'finance-members')">
                    </div>
                    
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="member-list-view">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="finance-members">
                                <!-- Member 1 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/28a745" alt="James Wilson" class="member-avatar">
                                            <div>
                                                <div class="member-name">James Wilson</div>
                                                <div class="member-role">Finance Director</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-active"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">Finance Director</td>
                                    <td data-label="Email" class="member-email">james.w@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 345-6781</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'James Wilson')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'James Wilson')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'James Wilson')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Member 2 -->
                                <tr>
                                    <td data-label="Name">
                                        <div class="member-info">
                                            <img src="https://via.placeholder.com/42/20c997" alt="Olivia Thompson" class="member-avatar">
                                            <div>
                                                <div class="member-name">Olivia Thompson</div>
                                                <div class="member-role">Accountant</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="member-status">
                                            <span class="status-indicator status-away"></span>
                                            Away
                                        </span>
                                    </td>
                                    <td data-label="Role" class="member-role">Accountant</td>
                                    <td data-label="Email" class="member-email">olivia.t@example.com</td>
                                    <td data-label="Phone" class="member-phone">(555) 456-7812</td>
                                    <td data-label="Actions">
                                        <div class="member-actions">
                                            <button class="action-btn view" title="View Profile" onclick="viewMember(event, 'Olivia Thompson')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn message" title="Send Message" onclick="messageMember(event, 'Olivia Thompson')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn edit" title="Edit" onclick="editMember(event, 'Olivia Thompson')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Operations Department (hidden by default) -->
                <div id="operations-department" class="department-pane" style="display: none;">
                    <div class="department-header">
                        <h2 class="department-title">
                            <i class="fas fa-cogs"></i>Operations Department
                        </h2>
                        <div class="department-meta">
                            <span class="member-count">
                                <i class="fas fa-users"></i> 0 Members
                            </span>
                            <div class="manager-info">
                                <i class="fas fa-user-slash"></i>
                                <span>No manager assigned</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="no-members">
                        <i class="fas fa-user-friends"></i>
                        <p>No members have been added to this department yet.</p>
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>Add First Member
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Department Modal -->
        <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold" id="addDepartmentModalLabel">Create New Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #fff; filter: invert(1);"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addDepartmentForm">
                            <!-- Department Info Section -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="departmentName" class="form-label fw-medium">Department Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="departmentName" placeholder="e.g., Human Resources" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="departmentCode" class="form-label fw-medium">Department Code</label>
                                        <input type="text" class="form-control" id="departmentCode" placeholder="e.g., HR">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="departmentDescription" class="form-label fw-medium">Description</label>
                                <textarea class="form-control" id="departmentDescription" rows="2" placeholder="Brief description of the department"></textarea>
                            </div>

                            <!-- Credentials Section -->
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 fw-medium">Credentials</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="adminUsername" class="form-label fw-medium">Username <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    <input type="text" class="form-control" id="adminUsername" placeholder="Create username" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="adminPassword" class="form-label fw-medium">Password <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                    <input type="password" class="form-control" id="adminPassword" placeholder="Create password" required>
                                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="form-text">Minimum 8 characters with numbers and symbols</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Manager Selection Section -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 fw-medium">Department Management</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="managerSearch" class="form-label fw-medium">Assign Manager <span class="text-danger">*</span></label>
                                        <div class="dropdown">
                                            <input type="text" class="form-control dropdown-toggle" id="managerSearch" 
                                                placeholder="Search for manager..." 
                                                data-bs-toggle="dropdown" 
                                                aria-expanded="false"
                                                autocomplete="off"
                                                required>
                                            <ul class="dropdown-menu w-100" id="managerDropdown">
                                                <li><a class="dropdown-item" href="#" onclick="selectManager('1', 'Sarah Johnson (Chaiperson)')">Sarah Johnson (Chaiperson)</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="selectManager('2', 'Michael Chen (Employee)')">Michael Chen (Employeer)</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="selectManager('3', 'Jennifer Lee (Employee)')">Jennifer Lee (Employee)</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="selectManager('4', 'Daniel Miller (Employee)')">Daniel Miller (Employee)</a></li>
                                            </ul>
                                            <input type="hidden" id="selectedManagerId">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="managerRole" class="form-label fw-medium">Manager Role</label>
                                        <input type="text" class="form-control" id="managerRole" placeholder="e.g., Department Head" value="Department Manager" readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary px-4" onclick="addDepartment()">
                            <i class="fas fa-plus-circle me-2"></i>Create Department
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to show selected department
        function showDepartment(departmentId) {
            // Hide all department panes
            document.querySelectorAll('.department-pane').forEach(pane => {
                pane.style.display = 'none';
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.department-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected department pane
            document.getElementById(`${departmentId}-department`).style.display = 'block';
            
            // Add active class to clicked tab
            event.currentTarget.classList.add('active');
        }
        
        // Function to search members within a department
        function searchMembers(inputId, tableBodyId) {
            const searchTerm = document.getElementById(inputId).value.toLowerCase();
            const rows = document.querySelectorAll(`#${tableBodyId} tr`);
            
            rows.forEach(row => {
                const name = row.querySelector('.member-name').textContent.toLowerCase();
                const role = row.querySelector('.member-role').textContent.toLowerCase();
                const email = row.querySelector('.member-email').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || role.includes(searchTerm) || email.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        
        // Function to view member profile
        function viewMember(event, memberName) {
            event.stopPropagation();
            alert(`Viewing profile of ${memberName}`);
            // In a real app, this would open a modal or navigate to the profile page
        }
        
        // Function to message member
        function messageMember(event, memberName) {
            event.stopPropagation();
            alert(`Opening message window for ${memberName}`);
            // In a real app, this would open a chat/message interface
        }
        
        // Function to edit member
        function editMember(event, memberName) {
            event.stopPropagation();
            alert(`Editing ${memberName}`);
            // In a real app, this would open an edit modal with the member's data
        }
        
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const passwordInput = this.previousElementSibling;
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Search/filter managers
        document.getElementById('managerSearch').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const items = document.querySelectorAll('#managerDropdown .dropdown-item');
            
            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(searchValue)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        function selectManager(id, name) {
            document.getElementById('managerSearch').value = name;
            document.getElementById('selectedManagerId').value = id;
            // Close the dropdown
            const dropdown = new bootstrap.Dropdown(document.querySelector('.dropdown-toggle'));
            dropdown.hide();
        }

        function addDepartment() {
            // Get form values
            const name = document.getElementById('departmentName').value;
            const code = document.getElementById('departmentCode').value;
            const description = document.getElementById('departmentDescription').value;
            const username = document.getElementById('adminUsername').value;
            const password = document.getElementById('adminPassword').value;
            const managerId = document.getElementById('selectedManagerId').value;
            const managerName = document.getElementById('managerSearch').value;
            
            // Validate required fields
            if (!name || !username || !password || !managerId) {
                alert('Please fill in all required fields');
                return;
            }
            
            // Password validation
            if (password.length < 8) {
                alert('Password must be at least 8 characters long');
                return;
            }
            
            // Create department object
            const department = {
                name,
                code,
                description,
                credentials: { username, password },
                manager: { id: managerId, name: managerName }
            };
            
            console.log('Creating department:', department);
            // Here you would typically make an API call to create the department
            
            alert(`Department "${name}" created successfully with manager ${managerName}`);
            
            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addDepartmentModal'));
            modal.hide();
            
            // Reset the form
            document.getElementById('addDepartmentForm').reset();
            document.getElementById('selectedManagerId').value = '';
            
            // In a real app, you would add the new department to the tabs and content
        }

        // Update greeting based on time of day
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

            greetingElement.textContent = greeting;
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            updateGreeting();
            
            // Notification functionality
            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationBadge = document.getElementById('notificationBadge');
            const notificationCount = document.getElementById('notificationCount');
            const markAllReadBtn = document.querySelector('.mark-all-read');

            // Mark notifications as read when dropdown is shown
            notificationDropdown?.addEventListener('shown.bs.dropdown', function() {
                if (parseInt(notificationBadge.textContent) > 0) {
                    document.querySelectorAll('.notification-item.unread').forEach(item => {
                        item.classList.remove('unread');
                    });
                    notificationBadge.textContent = '0';
                    notificationCount.textContent = '0';
                }
            });

            // Mark all as read button
            markAllReadBtn?.addEventListener('click', function(e) {
                e.stopPropagation();
                document.querySelectorAll('.notification-item.unread').forEach(item => {
                    item.classList.remove('unread');
                });
                notificationBadge.textContent = '0';
                notificationCount.textContent = '0';
            });
        });
    </script>
@endsection