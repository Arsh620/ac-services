<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - AC Service Booking</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --admin-primary: #1e293b;
            --admin-secondary: #334155;
            --admin-accent: #3b82f6;
            --admin-light: #f8fafc;
            --admin-border: #e2e8f0;
            --admin-text: #0f172a;
            --admin-text-muted: #64748b;
            --sidebar-width: 220px; /* Decreased from 280px */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--admin-light);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--admin-text);
        }

        /* Header Styles - Changed to White Background */
        .admin-header {
            background: white; /* Changed from gradient to white */
            color: var(--admin-text); /* Changed from white to dark text */
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08); /* Softer shadow */
            border-bottom: 1px solid var(--admin-border);
        }

        .admin-header .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 100%;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            font-size: 1.4rem; /* Slightly smaller */
            font-weight: 700;
            color: var(--admin-text); /* Changed from white to dark */
            text-decoration: none;
        }

        .admin-brand:hover {
            color: var(--admin-accent);
        }

        .admin-brand i {
            margin-right: 0.75rem;
            padding: 0.5rem;
            background: var(--admin-accent); /* Changed to solid accent color */
            color: white;
            border-radius: 8px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .notification-btn {
            position: relative;
            background: var(--admin-light); /* Changed from transparent to light background */
            border: 1px solid var(--admin-border);
            color: var(--admin-text); /* Changed from white to dark */
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .notification-btn:hover {
            background: var(--admin-accent);
            color: white;
            border-color: var(--admin-accent);
            transform: translateY(-1px);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Sidebar Styles - Decreased Width */
        .admin-sidebar {
            position: fixed;
            top: 70px; /* Adjusted for smaller header */
            left: 0;
            width: var(--sidebar-width); /* Now 220px instead of 280px */
            height: calc(100vh - 70px);
            background: white;
            border-right: 1px solid var(--admin-border);
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1020;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05); /* Softer shadow */
        }

        .sidebar-header {
            padding: 1.25rem; /* Slightly reduced padding */
            border-bottom: 1px solid var(--admin-border);
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .sidebar-title {
            font-size: 1rem; /* Slightly smaller */
            font-weight: 600;
            color: var(--admin-text);
            margin: 0;
        }

        .sidebar-subtitle {
            font-size: 0.8rem; /* Slightly smaller */
            color: var(--admin-text-muted);
            margin: 0;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-section {
            margin-bottom: 1.5rem; /* Reduced spacing */
        }

        .nav-section-title {
            font-size: 0.7rem; /* Slightly smaller */
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--admin-text-muted);
            padding: 0 1.25rem 0.5rem; /* Adjusted padding */
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.25rem; /* Reduced padding */
            color: var(--admin-text-muted);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            border: none;
            background: none;
            font-size: 0.9rem; /* Slightly smaller font */
        }

        .nav-link i {
            width: 18px; /* Slightly smaller icons */
            margin-right: 0.75rem; /* Reduced margin */
            font-size: 1rem;
        }

        .nav-link:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, transparent 100%);
            color: var(--admin-accent);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.15) 0%, transparent 100%);
            color: var(--admin-accent);
            font-weight: 600;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--admin-accent);
            border-radius: 0 4px 4px 0;
        }

        /* Main Content - Adjusted for smaller sidebar */
        .admin-content {
            margin-left: var(--sidebar-width); /* Now 220px */
            margin-top: 70px; /* Adjusted for smaller header */
            padding: 2rem;
            min-height: calc(100vh - 70px);
            transition: all 0.3s ease;
        }

        /* User Dropdown - Updated for white header */
        .user-dropdown .dropdown-toggle {
            background: var(--admin-light); /* Changed from transparent */
            border: 1px solid var(--admin-border);
            color: var(--admin-text); /* Changed from white to dark */
            padding: 0.75rem 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .user-dropdown .dropdown-toggle:hover {
            background: var(--admin-accent);
            color: white;
            border-color: var(--admin-accent);
            transform: translateY(-1px);
        }

        .user-dropdown .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }

        .user-dropdown .dropdown-item {
            padding: 0.75rem 1.25rem;
            transition: all 0.2s ease;
        }

        .user-dropdown .dropdown-item:hover {
            background: var(--admin-light);
            transform: translateX(4px);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.show {
                transform: translateX(0);
            }
            
            .admin-content {
                margin-left: 0;
            }
            
            .mobile-toggle {
                display: block !important;
            }
        }

        .mobile-toggle {
            display: none;
            background: var(--admin-light); /* Changed for white header */
            border: 1px solid var(--admin-border);
            color: var(--admin-text); /* Changed from white to dark */
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .mobile-toggle:hover {
            background: var(--admin-accent);
            color: white;
            border-color: var(--admin-accent);
        }

        /* Sidebar Footer - Adjusted for smaller sidebar */
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.25rem; /* Reduced padding */
            border-top: 1px solid var(--admin-border);
            background: var(--admin-light);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem; /* Reduced gap */
        }

        .user-avatar {
            width: 36px; /* Slightly smaller */
            height: 36px;
            background: var(--admin-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.85rem; /* Smaller font */
        }

        .user-details h6 {
            margin: 0;
            font-size: 0.85rem; /* Smaller font */
            font-weight: 600;
            color: var(--admin-text);
        }

        .user-details small {
            color: var(--admin-text-muted);
            font-size: 0.75rem; /* Smaller font */
        }

        /* Header user avatar for consistency */
        .header-actions .user-avatar {
            width: 32px;
            height: 32px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="admin-header">
        <div class="header-content">
            <div class="d-flex align-items-center">
                <button class="mobile-toggle me-3" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                    <i class="bi bi-wind"></i>
                    <span class="d-none d-md-inline">AC Service Admin</span>
                    <span class="d-inline d-md-none">ACS</span>
                </a>
            </div>
            
            <div class="header-actions">
                <button class="notification-btn" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                
                <div class="dropdown user-dropdown">
                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('home') }}">
                            <i class="bi bi-house me-2"></i>Visit Site
                        </a></li>
                        <li><a class="dropdown-item" href="#">
                            <i class="bi bi-person me-2"></i>Profile Settings
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <h5 class="sidebar-title">Admin Dashboard</h5>
            <p class="sidebar-subtitle">Manage your AC service business</p>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Overview</div>
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-graph-up"></i>
                    Analytics
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Management</div>
                <a class="nav-link {{ request()->routeIs('admin.bookings') ? 'active' : '' }}" 
                   href="{{ route('admin.bookings') }}">
                    <i class="bi bi-calendar-check"></i>
                    Bookings
                </a>
                <a class="nav-link {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}" 
                   href="{{ route('admin.employees.index') }}">
                    <i class="bi bi-person-badge"></i>
                    Employees
                </a>
                <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" 
                   href="{{ route('admin.users') }}">
                    <i class="bi bi-people"></i>
                    Customers
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">System</div>
                <a class="nav-link {{ request()->routeIs('setup.index') ? 'active' : '' }}" 
                   href="{{ route('setup.index') }}">
                    <i class="bi bi-gear"></i>
                    Settings
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark-text"></i>
                    Reports
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="user-details">
                    <h6>{{ Auth::user()->name }}</h6>
                    <small>Administrator</small>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            sidebar.classList.toggle('show');
        }

        // Auto-hide success alerts
        setTimeout(() => {
            const alert = document.getElementById('successAlert');
            if (alert) {
                bootstrap.Alert.getOrCreateInstance(alert).close();
            }
        }, 5000);

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('adminSidebar');
            const toggle = document.querySelector('.mobile-toggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !toggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>