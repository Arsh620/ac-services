@extends('layouts.auth')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: #ffffff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow border-0 rounded-4 card-hover-effect bg-white" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body px-4 py-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-person-plus-fill text-success" style="font-size: 2rem;"></i>
                            <h4 class="mt-2 mb-0 fw-semibold">Create Account</h4>
                            <small class="text-muted">Join us today</small>
                        </div>

                        <form method="POST" action="{{ route('register.submit') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label mb-1">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" required placeholder="Full name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label mb-1">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="mobile" class="form-label mb-1">Mobile Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                    <input id="mobile" type="tel" class="form-control @error('mobile') is-invalid @enderror"
                                           name="mobile" value="{{ old('mobile') }}" placeholder="Mobile number">
                                    @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label mb-1">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" required placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password-confirm" class="form-label mb-1">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required placeholder="Confirm password">
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-success rounded-pill">
                                    <i class="bi bi-person-plus me-1"></i> Create Account
                                </button>
                            </div>

                            <div class="text-center">
                                <small class="text-muted">Already have an account?
                                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Sign in</a>
                                </small>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- 3D Hover Effect --}}
                <style>
                    .card-hover-effect:hover {
                        transform: translateY(-3px) scale(1.015);
                        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.2);
                    }
                </style>
            </div>
        </div>
    </div>
</div>
@endsection
