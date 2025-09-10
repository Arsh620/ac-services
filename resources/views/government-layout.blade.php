<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Government Portal - AC Service Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --gov-primary: #1e3a8a;      /* Deep blue */
            --gov-secondary: #dc2626;     /* Red */
            --gov-accent: #059669;        /* Green */
            --gov-orange: #ea580c;        /* Orange */
            --gov-light-blue: #dbeafe;    /* Light blue */
            --gov-gray: #6b7280;          /* Gray */
            --gov-dark-gray: #374151;     /* Dark gray */
            --gov-white: #ffffff;
            --gov-light-gray: #f9fafb;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--gov-light-gray);
            color: var(--gov-dark-gray);
        }

        /* Government Header */
        .gov-header {
            background: linear-gradient(135deg, var(--gov-primary) 0%, #1e40af 100%);
            color: white;
            padding: 0.5rem 0;
            border-bottom: 3px solid var(--gov-orange);
        }

        .gov-header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .gov-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .gov-logo img {
            width: 60px;
            height: 60px;
        }

        .gov-logo-text h1 {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0;
            color: white;
        }

        .gov-logo-text p {
            font-size: 0.9rem;
            margin: 0;
            opacity: 0.9;
        }

        .gov-emblem {
            width: 80px;
            height: 80px;
            background: var(--gov-white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gov-primary);
            font-size: 2rem;
        }

        /* Navigation */
        .gov-nav {
            background: var(--gov-white);
            border-bottom: 2px solid var(--gov-light-blue);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .gov-nav .navbar-nav .nav-link {
            color: var(--gov-primary);
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .gov-nav .navbar-nav .nav-link:hover,
        .gov-nav .navbar-nav .nav-link.active {
            color: var(--gov-secondary);
            border-bottom-color: var(--gov-orange);
            background-color: var(--gov-light-blue);
        }

        /* Main Content */
        .gov-main {
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }

        .gov-card {
            background: var(--gov-white);
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .gov-card-header {
            background: linear-gradient(135deg, var(--gov-primary) 0%, #1e40af 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-bottom: 3px solid var(--gov-orange);
            font-weight: bold;
            font-size: 1.1rem;
        }

        .gov-card-body {
            padding: 2rem;
        }

        /* Buttons */
        .btn-gov-primary {
            background: var(--gov-primary);
            border-color: var(--gov-primary);
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-gov-primary:hover {
            background: #1e40af;
            border-color: #1e40af;
            color: white;
            transform: translateY(-1px);
        }

        .btn-gov-secondary {
            background: var(--gov-secondary);
            border-color: var(--gov-secondary);
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 6px;
        }

        .btn-gov-secondary:hover {
            background: #b91c1c;
            border-color: #b91c1c;
            color: white;
        }

        .btn-gov-success {
            background: var(--gov-accent);
            border-color: var(--gov-accent);
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 6px;
        }

        .btn-gov-success:hover {
            background: #047857;
            border-color: #047857;
            color: white;
        }

        /* Forms */
        .form-control {
            border: 2px solid #d1d5db;
            border-radius: 6px;
            padding: 0.75rem;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--gov-primary);
            box-shadow: 0 0 0 0.2rem rgba(30, 58, 138, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--gov-dark-gray);
            margin-bottom: 0.5rem;
        }

        /* Alert Boxes */
        .alert-gov-info {
            background-color: var(--gov-light-blue);
            border: 1px solid var(--gov-primary);
            color: var(--gov-primary);
            border-left: 4px solid var(--gov-primary);
        }

        .alert-gov-success {
            background-color: #d1fae5;
            border: 1px solid var(--gov-accent);
            color: var(--gov-accent);
            border-left: 4px solid var(--gov-accent);
        }

        .alert-gov-warning {
            background-color: #fef3c7;
            border: 1px solid var(--gov-orange);
            color: #92400e;
            border-left: 4px solid var(--gov-orange);
        }

        /* Footer */
        .gov-footer {
            background: var(--gov-dark-gray);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .gov-footer h5 {
            color: var(--gov-orange);
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .gov-footer a {
            color: #d1d5db;
            text-decoration: none;
        }

        .gov-footer a:hover {
            color: white;
        }

        /* Breadcrumb */
        .gov-breadcrumb {
            background: var(--gov-white);
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .breadcrumb {
            background: none;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--gov-primary);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--gov-gray);
        }

        /* Statistics Cards */
        .stat-card {
            background: var(--gov-white);
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-top: 4px solid var(--gov-primary);
        }

        .stat-card.success {
            border-top-color: var(--gov-accent);
        }

        .stat-card.warning {
            border-top-color: var(--gov-orange);
        }

        .stat-card.danger {
            border-top-color: var(--gov-secondary);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--gov-primary);
        }

        .stat-label {
            color: var(--gov-gray);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .gov-header .container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .gov-logo {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Government Header -->
    <header class="gov-header">
        <div class="container">
            <div class="gov-logo">
                <div class="gov-emblem">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="gov-logo-text">
                    <h1>Government of India</h1>
                    <p>Ministry of Urban Development</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-light">भारत सरकार</span>
                <div class="gov-emblem">
                    <i class="bi bi-geo-alt"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg gov-nav">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#govNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="govNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-house me-2"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-calendar-check me-2"></i>Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-people me-2"></i>Citizens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-file-text me-2"></i>Documents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-telephone me-2"></i>Contact</a>
                    </li>
                </ul>
                <div class="d-flex gap-2">
                    <button class="btn btn-gov-primary btn-sm">Login</button>
                    <button class="btn btn-gov-secondary btn-sm">Register</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="gov-breadcrumb">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Services</a></li>
                    <li class="breadcrumb-item active">AC Service Management</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="gov-main">
        <div class="container">
            <!-- Statistics -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="stat-card">
                        <div class="stat-number">1,247</div>
                        <div class="stat-label">Total Services</div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-card success">
                        <div class="stat-number">892</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-card warning">
                        <div class="stat-number">234</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-card danger">
                        <div class="stat-number">121</div>
                        <div class="stat-label">In Progress</div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="gov-card">
                <div class="gov-card-header">
                    <i class="bi bi-wind me-2"></i>AC Service Management Portal
                </div>
                <div class="gov-card-body">
                    <div class="alert alert-gov-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Welcome to the Government AC Service Management System. Please select a service below to proceed.
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="gov-card">
                                <div class="gov-card-body">
                                    <h5><i class="bi bi-calendar-plus text-primary me-2"></i>Book New Service</h5>
                                    <p>Schedule a new AC service appointment for your government facility.</p>
                                    <button class="btn btn-gov-primary">Book Service</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="gov-card">
                                <div class="gov-card-body">
                                    <h5><i class="bi bi-list-check text-success me-2"></i>View Bookings</h5>
                                    <p>Check the status of your existing service requests and appointments.</p>
                                    <button class="btn btn-gov-success">View Status</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="gov-card">
                                <div class="gov-card-body">
                                    <h5><i class="bi bi-gear text-warning me-2"></i>Admin Panel</h5>
                                    <p>Administrative access for managing services and user accounts.</p>
                                    <button class="btn btn-gov-secondary">Admin Access</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="gov-card">
                                <div class="gov-card-body">
                                    <h5><i class="bi bi-file-earmark-text text-info me-2"></i>Reports</h5>
                                    <p>Generate and download service reports and analytics.</p>
                                    <button class="btn btn-gov-primary">Generate Reports</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="gov-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Government</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Ministry Portal</a></li>
                        <li><a href="#">Policies</a></li>
                        <li><a href="#">RTI</a></li>
                        <li><a href="#">Grievances</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Resources</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Downloads</a></li>
                        <li><a href="#">Forms</a></li>
                        <li><a href="#">Guidelines</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact Info</h5>
                    <p><i class="bi bi-telephone me-2"></i>1800-XXX-XXXX</p>
                    <p><i class="bi bi-envelope me-2"></i>support@gov.in</p>
                    <p><i class="bi bi-geo-alt me-2"></i>New Delhi, India</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2024 Government of India. All rights reserved. | Last updated: August 2024</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>