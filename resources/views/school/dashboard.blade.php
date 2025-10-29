<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard - Hudaibiya International School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --govt-blue: #003366;
            --govt-gold: #ffd700;
            --govt-green: #006633;
        }

        .sidebar {
            background: var(--govt-blue);
            min-height: 100vh;
            color: white;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 10px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }

        .header {
            background: white;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 0;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid var(--govt-blue);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--govt-blue);
        }

        .quick-action-btn {
            background: var(--govt-green);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 15px;
        }

        .quick-action-btn:hover {
            background: #228B22;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="p-3">
                    <div class="text-center mb-4">
                        <div style="width: 60px; height: 60px; background: var(--govt-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--govt-blue); font-size: 1.5rem; margin: 0 auto 10px;">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <h6 class="mb-0">School Portal</h6>
                        <small class="text-muted">Hudaibiya International</small>
                    </div>

                    <nav class="nav flex-column">
                        <a class="nav-link active" href="#dashboard">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="#students">
                            <i class="bi bi-people me-2"></i>Students
                        </a>
                        <a class="nav-link" href="#teachers">
                            <i class="bi bi-person-badge me-2"></i>Teachers
                        </a>
                        <a class="nav-link" href="#classes">
                            <i class="bi bi-journal-text me-2"></i>Classes
                        </a>
                        <a class="nav-link" href="#attendance">
                            <i class="bi bi-calendar-check me-2"></i>Attendance
                        </a>
                        <a class="nav-link" href="#results">
                            <i class="bi bi-trophy me-2"></i>Results
                        </a>
                        <a class="nav-link" href="#reports">
                            <i class="bi bi-graph-up me-2"></i>Reports
                        </a>
                        <a class="nav-link" href="#settings">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Header -->
                <div class="header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="mb-0">School Dashboard</h4>
                                <small class="text-muted">Welcome back! Here's what's happening at your school today.</small>
                            </div>
                            <div class="col-auto">
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-person-circle me-2"></i>Admin User
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#profile"><i class="bi bi-person me-2"></i>Profile</a></li>
                                        <li><a class="dropdown-item" href="#settings"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{ route('school.landing') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Content -->
                <div class="container-fluid py-4">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="stat-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="stat-number">1,247</div>
                                        <div class="text-muted">Total Students</div>
                                    </div>
                                    <div class="text-primary" style="font-size: 2.5rem;">
                                        <i class="bi bi-people"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="stat-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="stat-number">89</div>
                                        <div class="text-muted">Teachers</div>
                                    </div>
                                    <div class="text-success" style="font-size: 2.5rem;">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="stat-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="stat-number">24</div>
                                        <div class="text-muted">Classes</div>
                                    </div>
                                    <div class="text-warning" style="font-size: 2.5rem;">
                                        <i class="bi bi-journal-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="stat-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="stat-number">94%</div>
                                        <div class="text-muted">Attendance</div>
                                    </div>
                                    <div class="text-info" style="font-size: 2.5rem;">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Quick Actions -->
                        <div class="col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="bi bi-lightning me-2"></i>Quick Actions</h6>
                                </div>
                                <div class="card-body">
                                    <button class="quick-action-btn">
                                        <i class="bi bi-person-plus me-2"></i>Add New Student
                                    </button>
                                    <button class="quick-action-btn">
                                        <i class="bi bi-calendar-event me-2"></i>Mark Attendance
                                    </button>
                                    <button class="quick-action-btn">
                                        <i class="bi bi-file-earmark-text me-2"></i>Generate Report
                                    </button>
                                    <button class="quick-action-btn">
                                        <i class="bi bi-megaphone me-2"></i>Send Announcement
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activities -->
                        <div class="col-lg-8 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0"><i class="bi bi-clock-history me-2"></i>Recent Activities</h6>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex align-items-center">
                                            <div class="me-3">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="bi bi-person-plus"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold">New Student Admission</div>
                                                <small class="text-muted">Rahul Kumar admitted to Class 10-A</small>
                                            </div>
                                            <small class="text-muted">2 hours ago</small>
                                        </div>
                                        <div class="list-group-item d-flex align-items-center">
                                            <div class="me-3">
                                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="bi bi-calendar-check"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold">Attendance Updated</div>
                                                <small class="text-muted">Class 9-B attendance marked by Mrs. Sharma</small>
                                            </div>
                                            <small class="text-muted">4 hours ago</small>
                                        </div>
                                        <div class="list-group-item d-flex align-items-center">
                                            <div class="me-3">
                                                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="bi bi-trophy"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold">Exam Results Published</div>
                                                <small class="text-muted">Class 12 final exam results are now available</small>
                                            </div>
                                            <small class="text-muted">1 day ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Upcoming Events</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="border rounded p-3 h-100">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="bg-primary text-white rounded p-2 me-3">
                                                        <i class="bi bi-trophy"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Annual Sports Day</h6>
                                                        <small class="text-muted">March 15, 2025</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0 small">Inter-house sports competition and prize distribution ceremony.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="border rounded p-3 h-100">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="bg-success text-white rounded p-2 me-3">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Parent-Teacher Meeting</h6>
                                                        <small class="text-muted">March 20, 2025</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0 small">Quarterly progress discussion with parents.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="border rounded p-3 h-100">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="bg-warning text-white rounded p-2 me-3">
                                                        <i class="bi bi-book"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Science Exhibition</h6>
                                                        <small class="text-muted">March 25, 2025</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0 small">Student science projects and innovation showcase.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple navigation handling
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all links
                document.querySelectorAll('.sidebar .nav-link').forEach(l => l.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Here you would typically load different content based on the clicked section
                console.log('Navigating to:', this.getAttribute('href'));
            });
        });
    </script>
</body>
</html>