<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - AC Service Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e293b;
            --accent-color: #3b82f6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-bg: #f8fafc;
            --white: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Header Styles */
        .main-header {
            background: var(--white);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 70px;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            height: 100%;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary-color);
            text-decoration: none;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            color: var(--text-secondary);
            font-size: 1.25rem;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .notification-btn:hover {
            background: var(--light-bg);
            color: var(--primary-color);
        }

        .notification-badge {
            position: absolute;
            top: 0.25rem;
            right: 0.25rem;
            width: 8px;
            height: 8px;
            background: var(--danger-color);
            border-radius: 50%;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: var(--light-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .user-dropdown:hover {
            background: var(--white);
            box-shadow: var(--shadow-sm);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--success-color), #34d399);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* Sidebar Styles */
        .main-sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            width: 280px;
            height: calc(100vh - 70px);
            background: var(--white);
            border-right: 1px solid var(--border-color);
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .sidebar-content {
            padding: 1.5rem 0;
        }

        .sidebar-section {
            margin-bottom: 2rem;
        }

        .sidebar-title {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-secondary);
            padding: 0 1.5rem;
            margin-bottom: 0.75rem;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            position: relative;
        }

        .nav-link:hover {
            background: var(--light-bg);
            color: var(--primary-color);
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(37, 99, 235, 0.1), transparent);
            color: var(--primary-color);
            border-right: 3px solid var(--primary-color);
        }

        .nav-icon {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--primary-color);
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            margin-top: 70px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
            transition: margin-left 0.3s ease;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .main-sidebar {
                transform: translateX(-100%);
            }

            .main-sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .header-content {
                padding: 0 1rem;
            }

            .user-info {
                display: none;
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 998;
                display: none;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        /* Custom Scrollbar */
        .main-sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .main-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .main-sidebar::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 2px;
        }

        .main-sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--text-secondary);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="header-content">
            <div class="d-flex align-items-center">
                <button class="btn d-md-none me-3" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <a href="{{ route('dashboard') }}" class="header-brand">
                    <div class="brand-icon">
                        <i class="bi bi-snow2"></i>
                    </div>
                    <span class="d-none d-md-inline">AC Service Pro</span>
                </a>
            </div>
            
            <div class="header-actions">
                <button class="notification-btn" title="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge"></span>
                </button>
                
                <div class="dropdown">
                    <div class="user-dropdown" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">Customer</div>
                        </div>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person me-2"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-gear me-2"></i>Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="main-sidebar" id="sidebar">
        <div class="sidebar-content">
            <div class="sidebar-section">
                <div class="sidebar-title">Main Menu</div>
                <ul class="sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                           href="{{ route('dashboard') }}">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('bookings.create') ? 'active' : '' }}" 
                           href="{{ route('bookings.create') }}">
                            <i class="nav-icon bi bi-calendar-plus"></i>
                            <span>Book Service</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('bookings.index') ? 'active' : '' }}" 
                           href="{{ route('bookings.index') }}">
                            <i class="nav-icon bi bi-calendar-check"></i>
                            <span>My Bookings</span>
                            @php
                                $pendingCount = Auth::user()->bookings()->where('status', 'Pending')->count();
                            @endphp
                            @if($pendingCount > 0)
                                <span class="nav-badge">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-title">Services</div>
                <ul class="sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="nav-icon bi bi-tools"></i>
                            <span>Service History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="nav-icon bi bi-star"></i>
                            <span>Reviews</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-title">Account</div>
                <ul class="sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="nav-icon bi bi-person"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="nav-icon bi bi-credit-card"></i>
                            <span>Payment Methods</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="nav-icon bi bi-headset"></i>
                            <span>Support</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        // Close sidebar when clicking overlay
        document.getElementById('sidebarOverlay')?.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });

        // Close sidebar on window resize if mobile
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });
    </script>
</body>
</html>
