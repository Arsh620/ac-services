<nav class="navbar navbar-expand-lg navbar-dark shadow-lg py-3 fixed-top" style="background: linear-gradient(135deg, #1e3a8a 0%, #4b6cb7 100%); backdrop-filter: blur(10px);">
    <div class="container-fluid">
        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center fw-bold text-white" href="{{ route('home') }}">
            <div class="logo-container me-2">
                <img src="{{ asset('images/logo.svg') }}" alt="AC Service Logo" height="40" class="logo-img">
            </div>
            <span class="fs-5 brand-text">AC Service Booking</span>
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar Links --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold {{ request()->routeIs('home') ? 'active' : '' }}" 
                       href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i>Home
                    </a>
                </li>
                
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold {{ request()->routeIs('bookings.create') ? 'active' : '' }}" 
                           href="{{ route('bookings.create') }}">
                            <i class="bi bi-calendar-plus me-1"></i>Book Service
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold {{ request()->routeIs('bookings.index') ? 'active' : '' }}" 
                           href="{{ route('bookings.index') }}">
                            <i class="bi bi-list-check me-1"></i>My Bookings
                        </a>
                    </li>
                    
                    @if(Auth::user()->is_admin == 1)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="adminDropdown" 
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-gear me-1"></i>Admin
                            </a>
                            <ul class="dropdown-menu admin-dropdown shadow-lg border-0">
                                <li>
                                    <a class="dropdown-item" href="{{ route('setup.index') }}">
                                        <i class="bi bi-sliders me-2"></i>System Setup
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-people me-2"></i>Manage Users
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-graph-up me-2"></i>Reports
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>

            {{-- Right Side Navigation --}}
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold {{ request()->routeIs('login') ? 'active' : '' }}" 
                           href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm ms-2 fw-semibold {{ request()->routeIs('register') ? 'active' : '' }}" 
                           href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i>Register
                        </a>
                    </li>
                @else
                    {{-- Notifications --}}
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link text-white position-relative" href="#" id="notificationDropdown" 
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                                <span class="visually-hidden">unread notifications</span>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown shadow-lg border-0" style="width: 300px;">
                            <li class="dropdown-header fw-bold">
                                <i class="bi bi-bell me-2"></i>Notifications
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-check-circle text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <small class="fw-semibold">Service Completed</small>
                                            <div class="small text-muted">Your AC service has been completed</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-calendar text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <small class="fw-semibold">Upcoming Service</small>
                                            <div class="small text-muted">Service scheduled for tomorrow</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li class="text-center">
                                <a class="dropdown-item small" href="#">View all notifications</a>
                            </li>
                        </ul>
                    </li>

                    {{-- User Profile Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" 
                           id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar me-2">
                                <i class="bi bi-person-circle fs-5"></i>
                            </div>
                            <span class="fw-semibold">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end user-dropdown shadow-lg border-0">
                            <li class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle fs-4 me-2"></i>
                                    <div>
                                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
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
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-question-circle me-2"></i>Help & Support
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

{{-- Enhanced CSS Styles --}}
<style>
    /* Navbar Enhancements */
    .navbar {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .navbar-brand {
        transition: all 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
    }

    .logo-container {
        transition: all 0.3s ease;
    }

    .brand-text {
        letter-spacing: 0.5px;
    }

    /* Navigation Links */
    .nav-link {
        position: relative;
        padding: 8px 16px !important;
        margin: 0 4px;
        border-radius: 8px;
        transition: all 0.3s ease;
        text-transform: none;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
        transform: translateY(-1px);
    }

    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Dropdown Menus */
    .dropdown-menu {
        background: white;
        border: none;
        border-radius: 12px;
        padding: 8px 0;
        margin-top: 8px;
        min-width: 200px;
    }

    .admin-dropdown,
    .user-dropdown,
    .notification-dropdown {
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        padding: 8px 16px;
        transition: all 0.2s ease;
        border-radius: 6px;
        margin: 2px 8px;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        transform: translateX(4px);
    }

    .dropdown-item.text-danger:hover {
        background-color: #fee;
        color: #dc3545 !important;
    }

    /* User Avatar */
    .user-avatar {
        transition: all 0.3s ease;
    }

    .dropdown-toggle:hover .user-avatar {
        transform: scale(1.1);
    }

    /* Notification Badge */
    .badge {
        font-size: 0.6rem;
    }

    /* Mobile Responsiveness */
    @media (max-width: 991px) {
        .navbar-nav {
            padding: 1rem 0;
        }
        
        .nav-link {
            margin: 2px 0;
        }
        
        .dropdown-menu {
            position: static !important;
            transform: none !important;
            box-shadow: none;
            border: 1px solid #dee2e6;
            margin-top: 0;
        }
    }

    /* Navbar Scroll Effect */
    .navbar.scrolled {
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.95) 0%, rgba(75, 108, 183, 0.95) 100%) !important;
        backdrop-filter: blur(20px);
    }

    /* Button Enhancements */
    .btn-outline-light {
        border-width: 2px;
        transition: all 0.3s ease;
    }

    .btn-outline-light:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
    }

    /* Dropdown Header */
    .dropdown-header {
        padding: 12px 16px;
        background-color: #f8f9fa;
        border-radius: 8px 8px 0 0;
        margin: -8px -0 8px -0;
    }
</style>

{{-- JavaScript for Navbar Scroll Effect --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Close mobile menu when clicking on a link
        const navLinks = document.querySelectorAll('.nav-link');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            });
        });
    });
</script>