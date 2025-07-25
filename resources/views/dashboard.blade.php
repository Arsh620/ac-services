@extends('layouts.sidebar')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Welcome, {{ Auth::user()->name }}</h2>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Quick Actions</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary">
                            <i class="bi bi-calendar-plus"></i> Book New Service
                        </a>
                        <a href="{{ route('bookings.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-calendar-check"></i> View My Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Recent Bookings</h5>
                    @php
                        $recentBookings = Auth::user()->bookings()->latest()->take(3)->get();
                    @endphp
                    
                    @if($recentBookings->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($recentBookings as $booking)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $booking->service_type }}</strong>
                                        <div class="text-muted small">{{ $booking->booking_date }} at {{ $booking->booking_time }}</div>
                                    </div>
                                    <span class="badge bg-{{ $booking->status == 'Completed' ? 'success' : ($booking->status == 'Confirmed' ? 'primary' : 'warning') }} rounded-pill">
                                        {{ $booking->status }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No recent bookings found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Our Services</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-snow fs-1 text-primary mb-3"></i>
                                    <h5>AC Installation</h5>
                                    <p class="text-muted">Professional installation of all AC types.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-tools fs-1 text-primary mb-3"></i>
                                    <h5>AC Repair</h5>
                                    <p class="text-muted">Quick and reliable repair services.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-clipboard-check fs-1 text-primary mb-3"></i>
                                    <h5>AC Maintenance</h5>
                                    <p class="text-muted">Regular maintenance for optimal performance.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection