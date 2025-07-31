@extends('layouts.auth')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Professional Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Professional Navigation -->
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="bg-primary rounded-circle p-2 me-3">
                    <i class="bi bi-building text-white"></i>
                </div>
                <span class="fw-bold text-dark">CompanyName</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-medium" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-medium" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-medium" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-medium" href="#">Contact</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <a href="{{ route('register') }}" class="btn btn-outline-primary me-2 rounded-pill px-4">
                        Sign Up
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </nav> -->

    <!-- Main Content -->
    <div class="min-vh-100 bg-light d-flex align-items-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Left Side - Branding/Info -->
                <div class="col-lg-6 d-none d-lg-flex align-items-center">
                    <div class="pe-5">
                        <div class="mb-4">
                            <h1 class="display-5 fw-bold text-dark mb-3">
                                Welcome to Our Professional Platform
                            </h1>
                            <p class="lead text-muted mb-4">
                                Access your dashboard, manage your projects, and collaborate with your team in our secure professional environment.
                            </p>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-shield-check text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold mb-1">Secure Access</h6>
                                        <small class="text-muted">Enterprise-grade security</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-people text-success"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold mb-1">Team Collaboration</h6>
                                        <small class="text-muted">Work together seamlessly</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-graph-up text-info"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold mb-1">Analytics</h6>
                                        <small class="text-muted">Detailed insights & reports</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-clock text-warning"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold mb-1">24/7 Support</h6>
                                        <small class="text-muted">Always here to help</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="col-lg-5 col-md-8">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 60px; height: 60px;">
                                    <i class="bi bi-person-circle text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                                <h3 class="fw-bold text-dark mb-2">Sign In</h3>
                                <p class="text-muted mb-0">Enter your credentials to access your account</p>
                            </div>

                            <form method="POST" action="{{ route('login.submit') }}">
                                @csrf
                                
                                <!-- Email Field -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold text-dark">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-envelope text-muted"></i>
                                        </span>
                                        <input id="email" type="email" 
                                               class="form-control border-start-0 bg-light @error('email') is-invalid @enderror" 
                                               name="email" value="{{ old('email') }}" required 
                                               placeholder="your.email@company.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password Field -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold text-dark">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-lock text-muted"></i>
                                        </span>
                                        <input id="password" type="password" 
                                               class="form-control border-start-0 border-end-0 bg-light @error('password') is-invalid @enderror" 
                                               name="password" required 
                                               placeholder="Enter your password">
                                        <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePassword()">
                                            <i class="bi bi-eye" id="toggleIcon"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Remember Me & Forgot Password -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                               {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-muted" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="#" class="text-primary text-decoration-none small fw-medium">
                                        Forgot password?
                                    </a>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In to Dashboard
                                    </button>
                                </div>

                                <!-- Divider -->
                                <div class="text-center mb-4">
                                    <div class="d-flex align-items-center">
                                        <hr class="flex-grow-1">
                                        <span class="px-3 text-muted small">or</span>
                                        <hr class="flex-grow-1">
                                    </div>
                                </div>

                                <!-- Social Login Options -->
                                <div class="row g-2 mb-4">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-dark w-100">
                                            <i class="bi bi-google me-2"></i>Google
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-microsoft me-2"></i>Microsoft
                                        </button>
                                    </div>
                                </div>

                                <!-- Sign Up Link -->
                                <div class="text-center">
                                    <p class="text-muted mb-0">
                                        Don't have an account? 
                                        <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">
                                            Create one here
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="text-center mt-4">
                        <small class="text-muted">
                            By signing in, you agree to our 
                            <a href="#" class="text-primary text-decoration-none">Terms of Service</a> and 
                            <a href="#" class="text-primary text-decoration-none">Privacy Policy</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 CompanyName. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex justify-content-md-end justify-content-center">
                        <a href="#" class="text-light me-3"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-size: 1.25rem;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        .card {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .form-control {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            padding: 12px 16px;
        }

        .nav-link:hover {
            color: #0d6efd !important;
        }

        .btn-outline-primary:hover {
            transform: translateY(-1px);
        }

        .btn-outline-dark:hover {
            transform: translateY(-1px);
        }

        @media (max-width: 991px) {
            .card-body {
                padding: 2rem !important;
            }
        }

        /* Animation for page load */
        .card {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.className = 'bi bi-eye-slash';
            } else {
                passwordField.type = 'password';
                toggleIcon.className = 'bi bi-eye';
            }
        }

        // Bootstrap JS
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap components if needed
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection