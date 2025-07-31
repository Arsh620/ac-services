@extends('layouts.sidebar')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="welcome-section mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="welcome-title">
                    Welcome back, {{ Auth::user()->name }}! 
                    <span class="wave">👋</span>
                </h1>
                <p class="welcome-subtitle">
                    Manage your AC services and bookings efficiently. Stay cool with our professional service.
                </p>
            </div>
            <div class="col-md-4 text-end">
                <div class="weather-widget">
                    <div class="weather-icon">
                        <i class="bi bi-sun"></i>
                    </div>
                    <div class="weather-info">
                        <div class="temperature">28°C</div>
                        <div class="weather-desc">Perfect AC weather</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        @php
            $userBookings = Auth::user()->bookings();
            $totalBookings = $userBookings->count();
            $pendingBookings = $userBookings->where('status', 'Pending')->count();
            $completedBookings = $userBookings->where('status', 'Completed')->count();
            $totalSpent = $userBookings->where('payment_status', 'paid')->sum('service_price') ?? 0;
        @endphp
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card stat-primary">
                <div class="stat-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $totalBookings }}</div>
                    <div class="stat-label">Total Bookings</div>
                    <div class="stat-trend">
                        <i class="bi bi-arrow-up"></i>
                        <span>All time</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card stat-warning">
                <div class="stat-icon">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $pendingBookings }}</div>
                    <div class="stat-label">Pending Services</div>
                    <div class="stat-trend">
                        <i class="bi bi-exclamation-circle"></i>
                        <span>Awaiting confirmation</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card stat-success">
                <div class="stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $completedBookings }}</div>
                    <div class="stat-label">Completed Services</div>
                    <div class="stat-trend">
                        <i class="bi bi-check"></i>
                        <span>Successfully done</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card stat-info">
                <div class="stat-icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">${{ number_format($totalSpent, 2) }}</div>
                    <div class="stat-label">Total Spent</div>
                    <div class="stat-trend">
                        <i class="bi bi-graph-up"></i>
                        <span>Lifetime value</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="action-card action-primary">
                <div class="action-content">
                    <div class="action-icon">
                        <i class="bi bi-calendar-plus"></i>
                    </div>
                    <div class="action-text">
                        <h3>Book New Service</h3>
                        <p>Schedule your AC maintenance, repair, or installation service today</p>
                        <div class="action-features">
                            <span class="feature-tag">
                                <i class="bi bi-clock"></i> Same day service
                            </span>
                            <span class="feature-tag">
                                <i class="bi bi-shield-check"></i> Licensed technicians
                            </span>
                        </div>
                    </div>
                </div>
                <div class="action-button">
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>Book Now
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="action-card action-success">
                <div class="action-content">
                    <div class="action-icon">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <div class="action-text">
                        <h3>My Bookings</h3>
                        <p>View, track, and manage all your service bookings in one place</p>
                        <div class="action-features">
                            <span class="feature-tag">
                                <i class="bi bi-eye"></i> Real-time tracking
                            </span>
                            <span class="feature-tag">
                                <i class="bi bi-chat-dots"></i> Direct communication
                            </span>
                        </div>
                    </div>
                </div>
                <div class="action-button">
                    <a href="{{ route('bookings.index') }}" class="btn btn-success btn-lg">
                        <i class="bi bi-arrow-right-circle me-2"></i>View All
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="content-card">
        <div class="content-header">
            <div class="content-title">
                <h2>Recent Bookings</h2>
                <p>Your latest service appointments and their status</p>
            </div>
            <div class="content-actions">
                <a href="{{ route('bookings.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-right me-1"></i>View All
                </a>
            </div>
        </div>
        
        <div class="content-body">
            @php
                $recentBookings = Auth::user()->bookings()->latest()->take(5)->get();
            @endphp
            
            @if($recentBookings->count() > 0)
                <div class="bookings-list">
                    @foreach($recentBookings as $booking)
                        <div class="booking-item">
                            <div class="booking-icon">
                                <i class="bi bi-{{ $booking->status == 'Completed' ? 'check-circle-fill text-success' : ($booking->status == 'Confirmed' ? 'clock-fill text-primary' : 'exclamation-circle-fill text-warning') }}"></i>
                            </div>
                            <div class="booking-details">
                                <div class="booking-service">{{ $booking->service_type }}</div>
                                <div class="booking-meta">
                                    <span class="booking-date">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                                    </span>
                                    <span class="booking-time">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $booking->booking_time }}
                                    </span>
                                </div>
                            </div>
                            <div class="booking-status">
                                <span class="status-badge status-{{ strtolower($booking->status) }}">
                                    {{ $booking->status }}
                                </span>
                                <div class="booking-price">
                                    ${{ number_format($booking->service_price ?? 0, 2) }}
                                </div>
                            </div>
                            <div class="booking-actions">
                                <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($booking->payment_status == 'pending')
                                    <a href="{{ route('payments.show', $booking) }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-credit-card"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <div class="empty-content">
                        <h3>No bookings yet</h3>
                        <p>Start by booking your first AC service. Our professional technicians are ready to help!</p>
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-plus-circle me-2"></i>Book Your First Service
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Welcome Section */
    .welcome-section {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
    }

    .welcome-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .welcome-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .wave {
        display: inline-block;
        animation: wave 2s infinite;
    }

    @keyframes wave {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(20deg); }
        75% { transform: rotate(-10deg); }
    }

    .weather-widget {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .weather-icon {
        font-size: 2rem;
        color: #fbbf24;
    }

    .temperature {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .weather-desc {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    /* Stat Cards */
    .stat-card {
        background: var(--white);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .stat-primary .stat-icon { background: var(--primary-color); }
    .stat-success .stat-icon { background: var(--success-color); }
    .stat-warning .stat-icon { background: var(--warning-color); }
    .stat-info .stat-icon { background: #06b6d4; }

    .stat-content {
        flex: 1;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--text-secondary);
        margin-bottom: 0.25rem;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    /* Action Cards */
    .action-card {
        background: var(--white);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .action-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .action-content {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .action-icon {
        width: 80px;
        height: 80px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        flex-shrink: 0;
    }

    .action-primary .action-icon { background: var(--primary-color); }
    .action-success .action-icon { background: var(--success-color); }

    .action-text h3 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
    }

    .action-text p {
        color: var(--text-secondary);
        margin-bottom: 1rem;
    }

    .action-features {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .feature-tag {
        background: var(--light-bg);
        color: var(--text-secondary);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Content Card */
    .content-card {
        background: var(--white);
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .content-header {
        padding: 2rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .content-title h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: var(--text-primary);
    }

    .content-title p {
        color: var(--text-secondary);
        margin-bottom: 0;
    }

    .content-body {
        padding: 2rem;
    }

    /* Bookings List */
    .bookings-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .booking-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        background: var(--light-bg);
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .booking-item:hover {
        background: #e2e8f0;
    }

    .booking-icon {
        font-size: 1.5rem;
    }

    .booking-details {
        flex: 1;
    }

    .booking-service {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .booking-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.9rem;
        color: var(--text-secondary);
    }

    .booking-status {
        text-align: center;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending { background: #fef3c7; color: #92400e; }
    .status-confirmed { background: #dbeafe; color: #1e40af; }
    .status-completed { background: #d1fae5; color: #065f46; }

    .booking-price {
        font-weight: 700;
        color: var(--success-color);
        margin-top: 0.25rem;
    }

    .booking-actions {
        display: flex;
        gap: 0.5rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--text-secondary);
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-content h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .empty-content p {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .welcome-title {
            font-size: 1.5rem;
        }
        
        .action-content {
            flex-direction: column;
            text-align: center;
        }
        
        .booking-item {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
        
        .booking-meta {
            justify-content: center;
        }
        
        .content-header {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
@endsection
