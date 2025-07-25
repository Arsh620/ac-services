@extends('layouts.auth')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4" style="background-color: #fff; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body px-4 py-4">
                        <div class="text-center mb-3">
                            <i class="bi bi-person-circle text-primary" style="font-size: 2.5rem;"></i>
                            <h4 class="mt-2 mb-1">Welcome Back</h4>
                            <small class="text-muted">Sign in to your account</small>
                        </div>

                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf

                            <div class="mb-2">
                                <label for="email" class="form-label mb-1">Email</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="password" class="form-label mb-1">Password</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" required placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-2 form-check small">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <div class="d-grid mb-2">
                                <button type="submit" class="btn btn-primary btn-sm rounded-pill">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>Sign In
                                </button>
                            </div>

                            <div class="text-center">
                                <small>Don't have an account? <a href="{{ route('register') }}"
                                        class="text-decoration-none fw-semibold">Sign up</a></small>
                            </div>
                        </form>
                    </div>
                </div>
                <style>
                    .card:hover {
                        transform: scale(1.01);
                        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                    }
                </style>
            </div>
        </div>
    </div>
</div>
@endsection
