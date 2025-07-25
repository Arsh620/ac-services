@extends('layouts.admin-sidebar')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 dashboard-title">Admin Dashboard</h2>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card dashboard-card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Total Bookings</h6>
                            <h2 class="mb-0 dashboard-number">{{ $totalBookings }}</h2>
                        </div>
                        <i class="bi bi-calendar3 dashboard-icon"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.bookings') }}" class="text-white text-decoration-none">View Details</a>
                    <i class="bi bi-arrow-right text-white"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Pending Bookings</h6>
                            <h2 class="mb-0 dashboard-number">{{ $pendingBookings }}</h2>
                        </div>
                        <i class="bi bi-hourglass-split dashboard-icon"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.bookings') }}" class="text-white text-decoration-none">View Details</a>
                    <i class="bi bi-arrow-right text-white"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Completed Bookings</h6>
                            <h2 class="mb-0 dashboard-number">{{ $completedBookings }}</h2>
                        </div>
                        <i class="bi bi-check-circle dashboard-icon"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.bookings') }}" class="text-white text-decoration-none">View Details</a>
                    <i class="bi bi-arrow-right text-white"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Total Users</h6>
                            <h2 class="mb-0 dashboard-number">{{ $totalUsers ?? 0 }}</h2>
                        </div>
                        <i class="bi bi-people dashboard-icon"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.users') }}" class="text-white text-decoration-none">View Details</a>
                    <i class="bi bi-arrow-right text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <style>
        .dashboard-title {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            font-weight: bold;
            color: #333;
            position: relative;
            padding-bottom: 10px;
        }

        .dashboard-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #007bff, transparent);
            border-radius: 2px;
        }

        .dashboard-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15), 0 6px 6px rgba(0, 0, 0, 0.1);
            transform: perspective(1000px) rotateX(5deg);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: perspective(1000px) rotateX(0);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2), 0 10px 10px rgba(0, 0, 0, 0.15);
        }

        .dashboard-icon {
            font-size: 3rem;
            opacity: 0.8;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transform: translateZ(20px);
        }

        .dashboard-number {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .card-footer {
            background: rgba(0, 0, 0, 0.1);
            border-top: none;
        }
    </style>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card recent-bookings-card">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0"><i class="bi bi-clock-history me-2"></i>Recent Bookings</h5>
                        <span class="badge bg-light text-dark">Latest 5</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @php
                    $recentBookings = App\Models\Booking::with('user')->latest()->take(5)->get();
                    @endphp

                    @if($recentBookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 modern-table">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 fw-semibold">#ID</th>
                                    <th class="border-0 fw-semibold"><i class="bi bi-person me-1"></i>Customer</th>
                                    <th class="border-0 fw-semibold"><i class="bi bi-tools me-1"></i>Service</th>
                                    <th class="border-0 fw-semibold"><i class="bi bi-calendar me-1"></i>Schedule</th>
                                    <th class="border-0 fw-semibold"><i class="bi bi-flag me-1"></i>Status</th>
                                    <th class="border-0 fw-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings as $booking)
                                <tr class="booking-row">
                                    <td class="align-middle">
                                        <span class="badge bg-secondary">#{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2">{{ substr($booking->user->name, 0, 1) }}</div>
                                            <span class="fw-medium">{{ $booking->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="service-badge">{{ $booking->service_type }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="schedule-info">
                                            <div class="fw-medium">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') }}</small>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="status-badge status-{{ strtolower($booking->status) }}">
                                            <i class="bi bi-{{ $booking->status == 'Completed' ? 'check-circle' : ($booking->status == 'Confirmed' ? 'clock' : 'hourglass-split') }} me-1"></i>
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.bookings') }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3 mb-0">No recent bookings found.</p>
                    </div>
                    @endif
                </div>
                <div class="card-footer bg-light border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Showing latest bookings</small>
                        <a href="{{ route('admin.bookings') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-arrow-right me-1"></i>View All Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .recent-bookings-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .modern-table {
            font-size: 0.9rem;
        }

        .booking-row {
            transition: all 0.2s ease;
        }

        .booking-row:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
        }

        .avatar-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .service-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .schedule-info {
            line-height: 1.2;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background: #cce5ff;
            color: #0056b3;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }
    </style>
</div>
@endsection