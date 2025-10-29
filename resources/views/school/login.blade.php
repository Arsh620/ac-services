<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>School Login - ePramaan Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --govt-blue: #003366;
            --govt-gold: #ffd700;
            --govt-red: #cc0000;
            --govt-green: #006633;
        }

        body {
            background: linear-gradient(135deg, var(--govt-blue) 0%, #1e4a66 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }

        .login-header {
            background: linear-gradient(45deg, var(--govt-blue), #1e4a66);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .govt-emblem {
            width: 80px;
            height: 80px;
            background: var(--govt-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--govt-blue);
            font-size: 2rem;
            margin: 0 auto 20px;
            border: 3px solid white;
        }

        .login-body {
            padding: 50px;
        }

        .epramaan-btn {
            background: linear-gradient(45deg, var(--govt-green), #228B22);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,102,51,0.3);
        }

        .epramaan-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,102,51,0.4);
            background: linear-gradient(45deg, #228B22, var(--govt-green));
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #dee2e6;
        }

        .divider span {
            background: white;
            padding: 0 20px;
            color: #6c757d;
            font-weight: 500;
        }

        .regular-login-btn {
            background: var(--govt-blue);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
        }

        .regular-login-btn:hover {
            background: #1e4a66;
            transform: translateY(-1px);
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--govt-blue);
            box-shadow: 0 0 0 0.2rem rgba(0,51,102,0.25);
        }

        .info-section {
            background: #f8f9fa;
            padding: 30px;
            border-left: 4px solid var(--govt-gold);
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: var(--govt-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .loading-spinner {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 15px 20px;
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 20px;
            background: rgba(255,255,255,0.1);
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        @media (max-width: 768px) {
            .login-body {
                padding: 30px 20px;
            }
            
            .login-header {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <a href="{{ route('school.landing') }}" class="back-link">
        <i class="bi bi-arrow-left me-2"></i>Back to School
    </a>

    <div class="login-container">
        <div class="login-card">
            <div class="row g-0">
                <div class="col-lg-7">
                    <div class="login-header">
                        <div class="govt-emblem">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <h2 class="mb-3">School Portal Login</h2>
                        <p class="mb-0">Secure Authentication via ePramaan</p>
                        <small class="opacity-75">Government of India Digital Identity Platform</small>
                    </div>

                    <div class="login-body">
                        <div id="alertContainer">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                        </div>

                        <!-- ePramaan Login Section -->
                        <div class="text-center mb-4">
                            <h4 class="text-primary mb-3">
                                <i class="bi bi-shield-check me-2"></i>
                                Secure Government Login
                            </h4>
                            <p class="text-muted">Use your government credentials to access the school portal securely</p>
                        </div>

                        <button id="epraamanLoginBtn" class="epramaan-btn mb-3">
                            <i class="bi bi-shield-fill-check me-2"></i>
                            Login with ePramaan
                        </button>

                        <div class="loading-spinner" id="loadingSpinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted">Redirecting to ePramaan...</p>
                        </div>

                        <div class="divider">
                            <span>OR</span>
                        </div>

                        <!-- Regular Login Form -->
                        <form id="regularLoginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="regular-login-btn">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Login with Email
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="#" class="text-decoration-none">Forgot Password?</a> |
                            <a href="#" class="text-decoration-none">Need Help?</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="info-section h-100 d-flex flex-column justify-content-center">
                        <h5 class="mb-4 text-primary">
                            <i class="bi bi-info-circle me-2"></i>
                            Why ePramaan?
                        </h5>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <strong>Secure Authentication</strong>
                                <br><small class="text-muted">Government-grade security standards</small>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-key"></i>
                            </div>
                            <div>
                                <strong>Single Sign-On</strong>
                                <br><small class="text-muted">One login for all government services</small>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <div>
                                <strong>Verified Identity</strong>
                                <br><small class="text-muted">Authenticated government credentials</small>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div>
                                <strong>Quick Access</strong>
                                <br><small class="text-muted">Fast and reliable login process</small>
                            </div>
                        </div>

                        <div class="mt-4 p-3 bg-light rounded">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                <strong>Note:</strong> ePramaan is the official digital identity platform of the Government of India, ensuring secure and authenticated access to government services.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ePramaan Login Handler
        document.getElementById('epraamanLoginBtn').addEventListener('click', function() {
            const btn = this;
            const spinner = document.getElementById('loadingSpinner');
            
            // Show loading state
            btn.style.display = 'none';
            spinner.style.display = 'block';
            
            // Redirect to ePramaan web login
            window.location.href = '/epramaan/login';
        });

        // Regular Login Form Handler
        document.getElementById('regularLoginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            try {
                // Show loading state
                submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>Logging in...';
                submitBtn.disabled = true;
                
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        email: formData.get('email'),
                        password: formData.get('password'),
                        remember: formData.get('remember') ? true : false
                    })
                });
                
                const data = await response.json();
                
                if (response.ok && data.token) {
                    // Store token and redirect
                    localStorage.setItem('auth_token', data.token);
                    showAlert('success', 'Login successful! Redirecting...');
                    
                    setTimeout(() => {
                        window.location.href = '/school/dashboard';
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Login failed');
                }
            } catch (error) {
                console.error('Login error:', error);
                showAlert('error', error.message || 'Login failed. Please check your credentials.');
            } finally {
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });

        // Utility function to show alerts
        function showAlert(type, message) {
            const alertContainer = document.getElementById('alertContainer');
            const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
            const iconClass = type === 'error' ? 'bi-exclamation-triangle' : 'bi-check-circle';
            
            alertContainer.innerHTML = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    <i class="${iconClass} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
        }

        // Check for callback parameters (if redirected back from ePramaan)
        window.addEventListener('load', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const code = urlParams.get('code');
            const error = urlParams.get('error');
            
            if (error) {
                showAlert('error', 'ePramaan authentication failed: ' + error);
            } else if (code) {
                // Handle ePramaan callback
                handleEpraamanCallback(code);
            }
        });

        // Handle ePramaan callback
        async function handleEpraamanCallback(code) {
            try {
                showAlert('success', 'ePramaan authentication successful! Processing...');
                
                const response = await fetch(`/api/epramaan/callback?code=${code}`);
                const data = await response.json();
                
                if (response.ok && data.token) {
                    localStorage.setItem('auth_token', data.token);
                    showAlert('success', 'Login successful! Redirecting to dashboard...');
                    
                    setTimeout(() => {
                        window.location.href = '/school/dashboard';
                    }, 2000);
                } else {
                    throw new Error(data.error || 'Authentication failed');
                }
            } catch (error) {
                console.error('Callback error:', error);
                showAlert('error', 'Authentication processing failed: ' + error.message);
            }
        }
    </script>
</body>
</html>