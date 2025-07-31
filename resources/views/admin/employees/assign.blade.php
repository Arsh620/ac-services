@extends('layouts.admin-sidebar')

@section('title', 'Assign Bookings')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <div class="d-flex align-items-center mb-2">
                    <div class="employee-avatar me-3">
                        {{ substr($employee->name, 0, 1) }}
                    </div>
                    <div>
                        <h1 class="page-title mb-1">Assign Bookings</h1>
                        <p class="page-subtitle mb-0">Managing assignments for <strong>{{ $employee->name }}</strong></p>
                    </div>
                </div>
                <div class="employee-info">
                    <span class="info-badge">
                        <i class="bi bi-person-badge me-1"></i>
                        {{ $employee->position ?? 'Technician' }}
                    </span>
                    <span class="info-badge">
                        <i class="bi bi-telephone me-1"></i>
                        {{ $employee->phone ?? 'N/A' }}
                    </span>
                    <span class="info-badge">
                        <i class="bi bi-envelope me-1"></i>
                        {{ $employee->email ?? 'N/A' }}
                    </span>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Back to Employees
                </a>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bulkAssignModal">
                    <i class="bi bi-lightning me-1"></i>Bulk Assign
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-warning">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $pendingBookings->count() }}</h3>
                    <p>Pending Assignments</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-primary">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $assignedBookings->count() }}</h3>
                    <p>Currently Assigned</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $assignedBookings->where('status', 'Completed')->count() }}</h3>
                    <p>Completed Today</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-info">
                    <i class="bi bi-calendar-week"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $assignedBookings->where('booking_date', '>=', now()->startOfWeek())->count() }}</h3>
                    <p>This Week</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Pending Bookings -->
        <div class="col-lg-6">
            <div class="content-card">
                <div class="content-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="content-card-title">
                                <i class="bi bi-clock-history me-2"></i>Pending Bookings
                            </h5>
                            <p class="content-card-subtitle">Available for assignment</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-funnel me-1"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">All Services</a></li>
                                <li><a class="dropdown-item" href="#">AC Repair</a></li>
                                <li><a class="dropdown-item" href="#">AC Installation</a></li>
                                <li><a class="dropdown-item" href="#">AC Maintenance</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-card-body">
                    @if($pendingBookings->count() > 0)
                        <div class="booking-list">
                            @foreach($pendingBookings as $booking)
                                <div class="booking-item pending" data-booking-id="{{ $booking->id }}">
                                    <div class="booking-header">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="booking-info">
                                                <h6 class="booking-title">{{ $booking->service_type }}</h6>
                                                <div class="booking-meta">
                                                    <span class="meta-item">
                                                        <i class="bi bi-person me-1"></i>
                                                        {{ $booking->user->name }}
                                                    </span>
                                                    <span class="meta-item">
                                                        <i class="bi bi-geo-alt me-1"></i>
                                                        {{ $booking->address ?? 'Address not provided' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="booking-priority">
                                                <span class="priority-badge priority-{{ strtolower($booking->priority ?? 'normal') }}">
                                                    {{ ucfirst($booking->priority ?? 'Normal') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="booking-details">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="detail-item">
                                                    <i class="bi bi-calendar3 text-primary"></i>
                                                    <span>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-item">
                                                    <i class="bi bi-clock text-primary"></i>
                                                    <span>{{ \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-item">
                                                    <i class="bi bi-currency-dollar text-success"></i>
                                                    <span>${{ number_format($booking->service_price ?? 0, 2) }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-item">
                                                    <i class="bi bi-stopwatch text-info"></i>
                                                    <span>{{ $booking->estimated_duration ?? '2' }} hours</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($booking->notes)
                                        <div class="booking-notes">
                                            <i class="bi bi-sticky me-2"></i>
                                            <span>{{ $booking->notes }}</span>
                                        </div>
                                    @endif

                                    <div class="booking-actions">
                                        <form action="{{ route('admin.bookings.assign', [$booking->id, $employee->id]) }}" method="POST" class="assign-form">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="bi bi-person-plus me-1"></i>
                                                Assign to {{ $employee->name }}
                                            </button>
                                        </form>
                                        <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#bookingDetailsModal{{ $booking->id }}">
                                            <i class="bi bi-eye me-1"></i>View Details
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="bi bi-calendar-x"></i>
                            <h6>No Pending Bookings</h6>
                            <p>All available bookings have been assigned or there are no new requests.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Assigned Bookings -->
        <div class="col-lg-6">
            <div class="content-card">
                <div class="content-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="content-card-title">
                                <i class="bi bi-person-check me-2"></i>Assigned Bookings
                            </h5>
                            <p class="content-card-subtitle">Currently assigned to {{ $employee->name }}</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Export List</a></li>
                                <li><a class="dropdown-item" href="#">Print Schedule</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#">Unassign All</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-card-body">
                    @if($assignedBookings->count() > 0)
                        <div class="booking-list">
                            @foreach($assignedBookings as $booking)
                                <div class="booking-item assigned" data-booking-id="{{ $booking->id }}">
                                    <div class="booking-header">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="booking-info">
                                                <h6 class="booking-title">{{ $booking->service_type }}</h6>
                                                <div class="booking-meta">
                                                    <span class="meta-item">
                                                        <i class="bi bi-person me-1"></i>
                                                        {{ $booking->user->name }}
                                                    </span>
                                                    <span class="meta-item">
                                                        <i class="bi bi-telephone me-1"></i>
                                                        {{ $booking->user->phone ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="booking-status">
                                                <span class="status-badge status-{{ strtolower($booking->status) }}">
                                                    {{ $booking->status }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="booking-details">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="detail-item">
                                                    <i class="bi bi-calendar3 text-primary"></i>
                                                    <span>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-item">
                                                    <i class="bi bi-clock text-primary"></i>
                                                    <span>{{ \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="booking-progress">
                                        <div class="progress-info">
                                            <span class="progress-label">Progress</span>
                                            <span class="progress-percentage">
                                                @php
                                                    $progress = match($booking->status) {
                                                        'Pending' => 25,
                                                        'Confirmed' => 50,
                                                        'In Progress' => 75,
                                                        'Completed' => 100,
                                                        default => 0
                                                    };
                                                @endphp
                                                {{ $progress }}%
                                            </span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: {{ $progress }}%"></div>
                                        </div>
                                    </div>

                                    <div class="booking-actions">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="dropdown">
                                                <i class="bi bi-gear me-1"></i>Update Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Mark as Confirmed</a></li>
                                                <li><a class="dropdown-item" href="#">Mark as In Progress</a></li>
                                                <li><a class="dropdown-item" href="#">Mark as Completed</a></li>
                                            </ul>
                                        </div>
                                        <form action="{{ route('admin.bookings.unassign', $booking->id) }}" method="POST" class="unassign-form d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to unassign this booking?')">
                                                <i class="bi bi-person-x me-1"></i>Unassign
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="bi bi-person-x"></i>
                            <h6>No Assigned Bookings</h6>
                            <p>{{ $employee->name }} doesn't have any assigned bookings yet. Assign some from the pending list.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Assign Modal -->
<div class="modal fade" id="bulkAssignModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bulk Assign Bookings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="bulkAssignForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Bookings to Assign</label>
                        <div class="booking-checklist">
                            @foreach($pendingBookings as $booking)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="bookings[]" value="{{ $booking->id }}" id="bulk{{ $booking->id }}">
                                    <label class="form-check-label" for="bulk{{ $booking->id }}">
                                        {{ $booking->service_type }} - {{ $booking->user->name }} ({{ \Carbon\Carbon::parse($booking->booking_date)->format('M d') }})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitBulkAssign()">Assign Selected</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Page Header */
    .page-header {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid var(--admin-border);
        margin-bottom: 1.5rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--admin-text);
        margin: 0;
    }

    .page-subtitle {
        color: var(--admin-text-muted);
        font-size: 1rem;
    }

    .employee-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--admin-accent), #6366f1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .employee-info {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .info-badge {
        background: var(--admin-light);
        color: var(--admin-text-muted);
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.85rem;
        border: 1px solid var(--admin-border);
    }

    .header-actions {
        display: flex;
        gap: 0.75rem;
        align-items: flex-start;
    }

    /* Stats Cards */
    .stats-card {
        background: white;
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }

    .stats-content h3 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--admin-text);
        margin: 0;
        line-height: 1;
    }

    .stats-content p {
        color: var(--admin-text-muted);
        font-size: 0.9rem;
        margin: 0.25rem 0 0;
    }

    /* Content Cards */
    .content-card {
        background: white;
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        overflow: hidden;
        height: fit-content;
    }

    .content-card-header {
        padding: 1.25rem;
        background: var(--admin-light);
        border-bottom: 1px solid var(--admin-border);
    }

    .content-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--admin-text);
        margin: 0;
    }

    .content-card-subtitle {
        color: var(--admin-text-muted);
        font-size: 0.85rem;
        margin: 0.25rem 0 0;
    }

    .content-card-body {
        padding: 1.25rem;
        max-height: 600px;
        overflow-y: auto;
    }

    /* Booking Items */
    .booking-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .booking-item {
        background: var(--admin-light);
        border: 1px solid var(--admin-border);
        border-radius: 10px;
        padding: 1.25rem;
        transition: all 0.3s ease;
    }

    .booking-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .booking-item.pending {
        border-left: 4px solid #f59e0b;
    }

    .booking-item.assigned {
        border-left: 4px solid var(--admin-accent);
    }

    .booking-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--admin-text);
        margin: 0 0 0.5rem;
    }

    .booking-meta {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .meta-item {
        color: var(--admin-text-muted);
        font-size: 0.85rem;
        display: flex;
        align-items: center;
    }

    .booking-details {
        margin: 1rem 0;
        padding: 1rem;
        background: white;
        border-radius: 8px;
        border: 1px solid var(--admin-border);
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--admin-text);
    }

    .booking-notes {
        background: #fef3c7;
        border: 1px solid #fbbf24;
        border-radius: 6px;
        padding: 0.75rem;
        margin: 1rem 0;
        font-size: 0.85rem;
        color: #92400e;
    }

    .booking-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }

    /* Priority and Status Badges */
    .priority-badge, .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .priority-high {
        background: #fee2e2;
        color: #dc2626;
    }

    .priority-normal {
        background: #e0f2fe;
        color: #0369a1;
    }

    .priority-low {
        background: #f0fdf4;
        color: #16a34a;
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

    .status-cancelled {
        background: #fee2e2;
        color: #dc2626;
    }

    /* Progress Bar */
    .booking-progress {
        margin: 1rem 0;
    }

    .progress-info {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .progress-label {
        font-size: 0.85rem;
        color: var(--admin-text-muted);
    }

    .progress-percentage {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--admin-accent);
    }

    .progress {
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-bar {
        background: linear-gradient(90deg, var(--admin-accent), #6366f1);
        height: 100%;
        transition: width 0.3s ease;
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
        color: var(--admin-text);
    }

    /* Modal Styles */
    .booking-checklist {
        max-height: 300px;
        overflow-y: auto;
        border: 1px solid var(--admin-border);
        border-radius: 6px;
        padding: 1rem;
    }

    .form-check {
        margin-bottom: 0.75rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .employee-info {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .header-actions {
            flex-direction: column;
            width: 100%;
        }
        
        .booking-actions {
            flex-direction: column;
        }
        
        .content-card-body {
            max-height: none;
        }
    }
</style>

<script>
    // Form submission with loading states
    document.querySelectorAll('.assign-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            button.disabled = true;
            button.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Assigning...';
        });
    });

    document.querySelectorAll('.unassign-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            button.disabled = true;
            button.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Unassigning...';
        });
    });

    // Bulk assign functionality
    function submitBulkAssign() {
        const checkedBoxes = document.querySelectorAll('input[name="bookings[]"]:checked');
        if (checkedBoxes.length === 0) {
            alert('Please select at least one booking to assign.');
            return;
        }
        
        // Here you would submit the form or make an AJAX request
        console.log('Assigning bookings:', Array.from(checkedBoxes).map(cb => cb.value));
        
        // Close modal and show success message
        bootstrap.Modal.getInstance(document.getElementById('bulkAssignModal')).hide();
        
        // You would typically reload the page or update the UI here
        location.reload();
    }

    // Auto-refresh every 30 seconds to show real-time updates
    setInterval(() => {
        // You could implement AJAX refresh here
        console.log('Auto-refreshing booking data...');
    }, 30000);
</script>
@endsection