<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AC Service Booking</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-top: 56px;
        }
        main {
            flex: 1;
        }
        footer {
            margin-top: auto;
        }
        .navbar {
            z-index: 1030;
        }
    </style>
</head>
<body>
    @include('layouts.nav')
    
    <main>
        @yield('content')
    </main>
    
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>AC Service Booking</h5>
                    <p>Your trusted partner for all AC services.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        @auth
                            <li><a href="{{ route('bookings.create') }}" class="text-white">Book Service</a></li>
                            <li><a href="{{ route('bookings.index') }}" class="text-white">My Bookings</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-white">Login</a></li>
                            <li><a href="{{ route('register') }}" class="text-white">Register</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-telephone"></i> (123) 456-7890</li>
                        <li><i class="bi bi-envelope"></i> info@acservice.com</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; {{ date('Y') }} AC Service Booking. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>