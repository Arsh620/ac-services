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
            --admin-primary: #2c3e50;
            --admin-secondary: #34495e;
            --admin-accent: #3498db;
            --admin-light: #ecf0f1;
            --admin-text: #ffffff;
        }

        body {
            background-color: #ffffff;
            min-height: 100vh;
            margin: 0;
        }

        .admin-header {
            background-color: var(--admin-primary);
            color: var(--admin-text);
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .admin-sidebar {
            background-color: #ffffff;
            color: #333333;
            min-height: 100vh;
            width: 240px;
            position: fixed;
            top: 56px;
            left: 0;
            padding-top: 1rem;
            transition: all 0.3s;
            border-right: 1px solid #dee2e6;
        }

        .admin-content {
            margin-left: 240px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        .admin-sidebar .admin-brand {
            font-size: 1.4rem;
            font-weight: 600;
            padding: 0 1rem 1rem;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
            color: #333333;
        }

        .admin-sidebar .nav-link {
            color: #666666;
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            transition: 0.2s;
        }

        .admin-sidebar .nav-link i {
            margin-right: 0.75rem;
        }

        .admin-sidebar .nav-link.active,
        .admin-sidebar .nav-link:hover {
            background-color: #f8f9fa;
            border-left: 4px solid var(--admin-accent);
            color: #333333;
        }

        .admin-user {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            text-align: center;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                position: relative;
                width: 100%;
                height: auto;
                top: 0;
            }

            .admin-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="admin-header">
        <div class="fw-semibold">
            <span class="d-none d-md-inline">AC Service Booking</span>
            <span class="d-inline d-md-none">ACSB</span>
        </div>
        <div class="dropdown">
            <button class="btn btn-sm btn-link text-white dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('home') }}"><i class="bi bi-house me-1"></i> Visit Site</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-brand"><i class="bi bi-speedometer2 me-1"></i> Admin Panel</div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.bookings') ? 'active' : '' }}" href="{{ route('admin.bookings') }}">
                <i class="bi bi-calendar-check"></i> Bookings
            </a>
            <a class="nav-link {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}" href="{{ route('admin.employees.index') }}">
                <i class="bi bi-person-badge"></i> Employees
            </a>
            <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                <i class="bi bi-people"></i> Users
            </a>
            <a class="nav-link {{ request()->routeIs('setup.index') ? 'active' : '' }}" href="{{ route('setup.index') }}">
                <i class="bi bi-gear"></i> System Setup
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="admin-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('successAlert');
                if (alert) bootstrap.Alert.getOrCreateInstance(alert).close();
            }, 3000);
        </script>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>