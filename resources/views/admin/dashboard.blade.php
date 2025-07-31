@extends('layouts.admin-sidebar')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Dashboard Overview</h1>
            <p class="page-subtitle mb-0">Welcome back, {{ Auth::user()->name }}! Here's what's happening with your business today.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary">
                <i class="bi bi-download me-1"></i>Export Report
            </button>
            <button class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>New Booking
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stats-info">
                            <h3 class="stats-number">{{ $totalBookings }}</h3>
                            <p class="stats-label">Total Bookings</p>
                            <div class="stats-trend positive">
                                <i class="bi bi-arrow-up"></i>
                                <span>12% from last month</span>
                            </div>
                        </div>
                        <div class="stats-icon bg-primary">
                            <i class="bi bi-calendar3"></i>
                        </div>
                    </div>
                </div>
                <div class="stats-footer">
                    <a href="{{ route('admin.bookings') }}" class="stats-link">
                        View all bookings <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stats-info">
                            <h3 class="stats-number">{{ $pendingBookings }}</h3>
                            <p class="stats-label">Pending Bookings</p>
                            <div class="stats-trend neutral">
                                <i class="bi bi-dash"></i>
                                <span>No change</span>
                            </div>
                        </div>
                        <div class="stats-icon bg-warning">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                    </div>
                </div>
                <div class="stats-footer">
                    <a href="{{ route('admin.bookings') }}" class="stats-link">
                        Manage pending <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stats-info">
                            <h3 class="stats-number">{{ $completedBookings }}</h3>
                            <p class="stats-label">Completed Services</p>
                            <div class="stats-trend positive">
                                <i class="bi bi-arrow-up"></i>
                                <span>8% from last month</span>
                            </div>
                        </div>
                        <div class="stats-icon bg-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="stats-footer">
                    <a href="{{ route('admin.bookings') }}" class="stats-link">
                        View completed <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stats-info">
                            <h3 class="stats-number">{{ $totalUsers ?? 0 }}</h3>
                            <p class="stats-label">Total Customers</p>
                            <div class="stats-trend positive">
                                <i class="bi bi-arrow-up"></i>
                                <span>15% from last month</span>
                            </div>
                        </div>
                        <div class="stats-icon bg-info">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
                <div class="stats-footer">
                    <a href="{{ route('admin.users') }}" class="stats-link">
                        Manage customers <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activity -->
    <div class="row g-4">
        <!-- Recent Bookings -->
        <div class="col-xl-8">
            <div class="content-card">
                <div class="content-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="content-card-title">Recent Bookings</h5>
                            <p class="content-card-subtitle">Latest service requests from customers</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                Last 7 days
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Last 7 days</a></li>
                                <li><a class="dropdown-item" href="#">Last 30 days</a></li>
                                <li><a class="dropdown-item" href="#">Last 3 months</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-card-body p-0">
                    @php
                    $recentBookings = App\Models\Booking::with('user')->latest()->take(5)->get();
                    @endphp
                    
                    @if($recentBookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="border-0 ps-4">Customer</th>
                                    <th class="border-0">Service</th>
                                    <th class="border-0">Schedule</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Amount</th>
                                    <th class="border-0 pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings as $booking)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="customer-avatar me-3">
                                                {{ substr($booking->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $booking->user->name }}</div>
                                                <small class="text-muted">#{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="service-info">
                                            <div class="service-type">{{ $booking->service_type }}</div>
                                            <small class="text-muted">{{ $booking->service_description ?? 'Standard service' }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($booking->status) }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-success">${{ number_format($booking->service_price ?? 0, 2) }}</div>
                                        <small class="text-muted">{{ ucfirst($booking->payment_status ?? 'pending') }}</small>
                                    </td>
                                    <td class="pe-4">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="bi bi-calendar-x"></i>
                        <h6>No recent bookings</h6>
                        <p>New bookings will appear here when customers make appointments.</p>
                    </div>
                    @endif
                </div>
                <div class="content-card-footer">
                    <a href="{{ route('admin.bookings') }}" class="btn btn-outline-primary">
                        View All Bookings <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Stats -->
        <div class="col-xl-4">
            <div class="content-card mb-4">
                <div class="content-card-header">
                    <h5 class="content-card-title">Quick Actions</h5>
                </div>
                <div class="content-card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-2"></i>Create New Booking
                        </a>
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-person-plus me-2"></i>Add Employee
                        </a>
                        <a href="{{ route('setup.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-gear me-2"></i>System Settings
                        </a>
                    </div>
                </div>
            </div>

            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">Today's Schedule</h5>
                </div>
                <div class="content-card-body">
                    <div class="schedule-item">
                        <div class="schedule-time">9:00 AM</div>
                        <div class="schedule-details">
                            <div class="fw-semibold">AC Maintenance</div>
                            <small class="text-muted">John Doe - Downtown</small>
                        </div>
                    </div>
                    <div class="schedule-item">
                        <div class="schedule-time">2:00 PM</div>
                        <div class="schedule-details">
                            <div class="fw-semibold">AC Installation</div>
                            <small class="text-muted">Jane Smith - Uptown</small>
                        </div>
                    </div>
                    <div class="schedule-item">
                        <div class="schedule-time">4:30 PM</div>
                        <div class="schedule-details">
                            <div class="fw-semibold">AC Repair</div>
                            <small class="text-muted">Mike Johnson - Midtown</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Page Header */
    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--admin-text);
        margin: 0;
    }

    .page-subtitle {
        color: var(--admin-text-muted);
        font-size: 1rem;
    }

    /* Stats Cards */
    .stats-card {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }

    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
    }

    .stats-card-body {
        padding: 1.5rem;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--admin-text);
        margin: 0;
        line-height: 1;
    }

    .stats-label {
        color: var(--admin-text-muted);
        font-size: 0.9rem;
        margin: 0.5rem 0;
        font-weight: 500;
    }

    .stats-trend {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .stats-trend.positive {
        color: #10b981;
    }

    .stats-trend.negative {
        color: #ef4444;
    }

    .stats-trend.neutral {
        color: var(--admin-text-muted);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .stats-footer {
        padding: 1rem 1.5rem;
        background: var(--admin-light);
        border-top: 1px solid var(--admin-border);
    }

    .stats-link {
        color: var(--admin-accent);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .stats-link:hover {
        color: var(--admin-accent);
        transform: translateX(4px);
    }

    /* Content Cards */
    .content-card {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        overflow: hidden;
        height: fit-content;
    }

    .content-card-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--admin-border);
        background: var(--admin-light);
    }

    .content-card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--admin-text);
        margin: 0;
    }

    .content-card-subtitle {
        color: var(--admin-text-muted);
        font-size: 0.9rem;
        margin: 0.25rem 0 0;
    }

    .content-card-body {
        padding: 1.5rem;
    }

    .content-card-footer {
        padding: 1rem 1.5rem;
        background: var(--admin-light);
        border-top: 1px solid var(--admin-border);
    }

    /* Table Styles */
    .table th {
        font-weight: 600;
        color: var(--admin-text);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
    }

    .table td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }

    .customer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--admin-accent);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .service-type {
        font-weight: 600;
        color: var(--admin-text);
    }

    .status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-confirmed {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-completed {
        background: #d1fae5;
        color: #065f46;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--admin-text-muted);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state h6 {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    /* Schedule Items */
    .schedule-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--admin-border);
    }

    .schedule-item:last-child {
        border-bottom: none;
    }

    .schedule-time {
        font-weight: 600;
        color: var(--admin-accent);
        min-width: 80px;
        font-size: 0.9rem;
    }

    .schedule-details {
        flex: 1;
    }
</style>
@endsection