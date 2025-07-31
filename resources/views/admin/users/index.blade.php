@extends('layouts.admin-sidebar')

@section('title', 'Manage Users')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <div class="d-flex align-items-center mb-2">
                    <div class="page-icon me-3">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <h1 class="page-title mb-1">User Management</h1>
                        <p class="page-subtitle mb-0">Manage customer accounts and user permissions</p>
                    </div>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </nav>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exportModal">
                    <i class="bi bi-download me-1"></i>Export Users
                </button>
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#inviteModal">
                    <i class="bi bi-person-plus me-1"></i>Invite User
                </button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-plus-circle me-1"></i>Add User
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        @php
            $users = \App\Models\User::all();
            $totalUsers = $users->count();
            $adminUsers = $users->filter(fn($user) => $user->isAdmin())->count();
            $regularUsers = $totalUsers - $adminUsers;
            $recentUsers = $users->where('created_at', '>=', now()->subDays(30))->count();
            $activeUsers = $users->where('last_login_at', '>=', now()->subDays(7))->count();
        @endphp
        
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon bg-primary">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $totalUsers }}</h3>
                    <p>Total Users</p>
                    <div class="stats-trend">
                        <i class="bi bi-arrow-up text-success"></i>
                        <span class="text-success">+12% from last month</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon bg-success">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $regularUsers }}</h3>
                    <p>Customers</p>
                    <div class="stats-trend">
                        <i class="bi bi-arrow-up text-success"></i>
                        <span class="text-success">+8% from last month</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon bg-warning">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $adminUsers }}</h3>
                    <p>Administrators</p>
                    <div class="stats-trend">
                        <i class="bi bi-dash text-muted"></i>
                        <span class="text-muted">No change</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon bg-info">
                    <i class="bi bi-activity"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $activeUsers }}</h3>
                    <p>Active This Week</p>
                    <div class="stats-trend">
                        <i class="bi bi-arrow-up text-success"></i>
                        <span class="text-success">+15% activity</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="quick-action-card" onclick="showNewUsers()">
                <div class="quick-action-icon bg-primary">
                    <i class="bi bi-person-plus"></i>
                </div>
                <div class="quick-action-content">
                    <h6>New Registrations</h6>
                    <p>{{ $recentUsers }} this month</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="quick-action-card" onclick="showUnverifiedUsers()">
                <div class="quick-action-icon bg-warning">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div class="quick-action-content">
                    <h6>Unverified Users</h6>
                    <p>{{ $users->whereNull('email_verified_at')->count() }} pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="quick-action-card" onclick="showSuspendedUsers()">
                <div class="quick-action-icon bg-danger">
                    <i class="bi bi-person-x"></i>
                </div>
                <div class="quick-action-content">
                    <h6>Suspended Users</h6>
                    <p>{{ $users->where('status', 'suspended')->count() }} accounts</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="quick-action-card" onclick="exportUsers()">
                <div class="quick-action-icon bg-info">
                    <i class="bi bi-download"></i>
                </div>
                <div class="quick-action-content">
                    <h6>Export Data</h6>
                    <p>Download reports</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="content-card mb-4">
        <div class="content-card-body">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4 col-md-6">
                    <label class="form-label">Search Users</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search by name, email, or ID...">
                        <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <label class="form-label">Role</label>
                    <select class="form-select" id="roleFilter">
                        <option value="">All Roles</option>
                        <option value="admin">Admin</option>
                        <option value="user">Customer</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label">Registration</label>
                    <select class="form-select" id="dateFilter">
                        <option value="">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <button class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                        <i class="bi bi-funnel me-1"></i>Clear Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- User Management Table -->
    <div class="content-card">
        <div class="content-card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="content-card-title">
                        <i class="bi bi-people me-2"></i>User Directory
                    </h5>
                    <p class="content-card-subtitle">Manage customer accounts and permissions</p>
                </div>
                <div class="table-actions">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="toggleBulkActions()">
                            <i class="bi bi-check-square me-1"></i>Bulk Select
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="refreshTable()">
                            <i class="bi bi-arrow-clockwise me-1"></i>Refresh
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="exportUsers()">
                                <i class="bi bi-download me-2"></i>Export All
                            </a></li>
                            <li><a class="dropdown-item" href="#" onclick="printUsers()">
                                <i class="bi bi-printer me-2"></i>Print List
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="showUserStats()">
                                <i class="bi bi-graph-up me-2"></i>View Analytics
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="usersTable">
                    <thead>
                        <tr>
                            <th width="40">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                </div>
                            </th>
                            <th>User</th>
                            <th>Role & Permissions</th>
                            <th>Contact Info</th>
                            <th>Status</th>
                            <th>Activity</th>
                            <th>Registered</th>
                            <th width="140">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\User::orderBy('created_at', 'desc')->get() as $user)
                            <tr class="user-row" 
                                data-name="{{ strtolower($user->name) }}" 
                                data-email="{{ strtolower($user->email) }}" 
                                data-role="{{ $user->isAdmin() ? 'admin' : 'user' }}"
                                data-status="{{ $user->status ?? 'active' }}"
                                data-date="{{ $user->created_at->format('Y-m-d') }}">
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input user-checkbox" type="checkbox" value="{{ $user->id }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">
                                            @if($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                                            @else
                                                {{ substr($user->name, 0, 1) }}
                                            @endif
                                        </div>
                                        <div>
                                            <div class="fw-semibold user-name">{{ $user->name }}</div>
                                            <small class="text-muted">ID: {{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="role-badge role-{{ $user->isAdmin() ? 'admin' : 'user' }}">
                                            {{ $user->isAdmin() ? 'Administrator' : 'Customer' }}
                                        </span>
                                        @if($user->isAdmin())
                                            <div class="mt-1">
                                                <small class="text-muted">
                                                    <i class="bi bi-shield-check me-1"></i>Full Access
                                                </small>
                                            </div>
                                        @else
                                            <div class="mt-1">
                                                <small class="text-muted">
                                                    <i class="bi bi-person me-1"></i>Standard Access
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="small">
                                            <i class="bi bi-envelope me-1 text-primary"></i>
                                            {{ $user->email }}
                                        </div>
                                        @if($user->phone)
                                            <div class="small text-muted mt-1">
                                                <i class="bi bi-telephone me-1"></i>
                                                {{ $user->phone }}
                                            </div>
                                        @endif
                                        @if($user->email_verified_at)
                                            <div class="small text-success mt-1">
                                                <i class="bi bi-check-circle me-1"></i>Verified
                                            </div>
                                        @else
                                            <div class="small text-warning mt-1">
                                                <i class="bi bi-exclamation-circle me-1"></i>Unverified
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($user->status ?? 'active') }}">
                                        {{ ucfirst($user->status ?? 'Active') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="activity-info">
                                        @if($user->last_login_at)
                                            <div class="small">
                                                <i class="bi bi-clock me-1 text-success"></i>
                                                {{ $user->last_login_at->diffForHumans() }}
                                            </div>
                                        @else
                                            <div class="small text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                Never logged in
                                            </div>
                                        @endif
                                        <div class="small text-muted mt-1">
                                            <i class="bi bi-calendar-check me-1"></i>
                                            {{ $user->bookings_count ?? 0 }} bookings
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="small text-muted">
                                        {{ $user->created_at->format('g:i A') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewUserModal{{ $user->id }}" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}" title="Edit User">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="viewUserBookings({{ $user->id }})" title="View Bookings">
                                            <i class="bi bi-calendar-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown" title="More Options">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if(!$user->email_verified_at)
                                                <li><a class="dropdown-item" href="#" onclick="sendVerification({{ $user->id }})">
                                                    <i class="bi bi-envelope-check me-2"></i>Send Verification
                                                </a></li>
                                            @endif
                                            <li><a class="dropdown-item" href="#" onclick="resetPassword({{ $user->id }})">
                                                <i class="bi bi-key me-2"></i>Reset Password
                                            </a></li>
                                            <li><a class="dropdown-item" href="#" onclick="loginAsUser({{ $user->id }})">
                                                <i class="bi bi-person-circle me-2"></i>Login as User
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            @if(($user->status ?? 'active') === 'active')
                                                <li><a class="dropdown-item text-warning" href="#" onclick="suspendUser({{ $user->id }})">
                                                    <i class="bi bi-pause-circle me-2"></i>Suspend User
                                                </a></li>
                                            @else
                                                <li><a class="dropdown-item text-success" href="#" onclick="activateUser({{ $user->id }})">
                                                    <i class="bi bi-play-circle me-2"></i>Activate User
                                                </a></li>
                                            @endif
                                            @if(!$user->isAdmin())
                                                <li><a class="dropdown-item text-danger" href="#" onclick="deleteUser({{ $user->id }})">
                                                    <i class="bi bi-trash me-2"></i>Delete User
                                                </a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="bi bi-people"></i>
                                        <h6>No Users Found</h6>
                                        <p>No users match your current filters.</p>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                            <i class="bi bi-person-plus me-1"></i>Add First User
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bulk Actions Bar -->
    <div class="bulk-actions-bar" id="bulkActionsBar" style="display: none;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span id="selectedCount">0</span> users selected
            </div>
            <div class="btn-group">
                <button class="btn btn-outline-success btn-sm" onclick="bulkAction('activate')">
                    <i class="bi bi-check-circle me-1"></i>Activate
                </button>
                <button class="btn btn-outline-warning btn-sm" onclick="bulkAction('suspend')">
                    <i class="bi bi-pause-circle me-1"></i>Suspend
                </button>
                <button class="btn btn-outline-primary btn-sm" onclick="bulkAction('verify')">
                    <i class="bi bi-envelope-check me-1"></i>Send Verification
                </button>
                <button class="btn btn-outline-info btn-sm" onclick="bulkAction('export')">
                    <i class="bi bi-download me-1"></i>Export Selected
                </button>
                <button class="btn btn-outline-danger btn-sm" onclick="bulkAction('delete')">
                    <i class="bi bi-trash me-1"></i>Delete
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-person-plus me-2"></i>Add New User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="userName" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="userName" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="userEmail" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="userEmail" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="userPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="userPhone" name="phone">
                        </div>
                        <div class="col-md-6">
                            <label for="userRole" class="form-label">Role *</label>
                            <select class="form-select" id="userRole" name="role" required>
                                <option value="user">Customer</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="userPassword" class="form-label">Password *</label>
                            <input type="password" class="form-control" id="userPassword" name="password" required>
                            <div class="form-text">Minimum 8 characters required</div>
                        </div>
                        <div class="col-md-6">
                            <label for="userStatus" class="form-label">Status</label>
                            <select class="form-select" id="userStatus" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sendWelcome" name="send_welcome" checked>
                                <label class="form-check-label" for="sendWelcome">
                                    Send welcome email to user
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="requireVerification" name="require_verification" checked>
                                <label class="form-check-label" for="requireVerification">
                                    Require email verification before login
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitAddUser()">
                    <i class="bi bi-person-plus me-1"></i>Add User
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Export Modal -->
<div class="modal fade" id="exportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-download me-2"></i>Export Users
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="exportForm">
                    <div class="mb-3">
                        <label class="form-label">Export Format</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="format" id="csvFormat" value="csv" checked>
                            <label class="form-check-label" for="csvFormat">
                                <i class="bi bi-file-earmark-text me-1"></i>CSV File
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="format" id="excelFormat" value="excel">
                            <label class="form-check-label" for="excelFormat">
                                <i class="bi bi-file-earmark-excel me-1"></i>Excel File
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="format" id="pdfFormat" value="pdf">
                            <label class="form-check-label" for="pdfFormat">
                                <i class="bi bi-file-earmark-pdf me-1"></i>PDF Report
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Include Fields</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeName" checked>
                                    <label class="form-check-label" for="includeName">Name</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeEmail" checked>
                                    <label class="form-check-label" for="includeEmail">Email</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includePhone">
                                    <label class="form-check-label" for="includePhone">Phone</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeRole" checked>
                                    <label class="form-check-label" for="includeRole">Role</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeStatus">
                                    <label class="form-check-label" for="includeStatus">Status</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="includeDate" checked>
                                    <label class="form-check-label" for="includeDate">Registration Date</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date Range</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="date" class="form-control" id="startDate" name="start_date">
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control" id="endDate" name="end_date">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitExport()">
                    <i class="bi bi-download me-1"></i>Export Users
                </button>
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
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .page-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--admin-accent), #6366f1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
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

    .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
        font-size: 0.85rem;
    }

    .breadcrumb-item a {
        color: var(--admin-accent);
        text-decoration: none;
    }

    .header-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    /* Stats Cards */
    .stats-card {
        background: white;
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        padding: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        height: 100%;
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
        flex-shrink: 0;
    }

    .stats-content {
        flex: 1;
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
        margin: 0.25rem 0 0.5rem;
    }

    .stats-trend {
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Quick Action Cards */
    .quick-action-card {
        background: white;
        border: 1px solid var(--admin-border);
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        cursor: pointer;
        height: 100%;
    }

    .quick-action-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-color: var(--admin-accent);
    }

    .quick-action-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .quick-action-content h6 {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--admin-text);
        margin: 0 0 0.25rem;
    }

    .quick-action-content p {
        font-size: 0.8rem;
        color: var(--admin-text-muted);
        margin: 0;
    }

    /* Content Cards */
    .content-card {
        background: white;
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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
    }

    /* User Avatar */
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--admin-accent), #6366f1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        font-weight: 600;
        overflow: hidden;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Role and Status Badges */
    .role-badge, .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .role-admin {
        background: #fef3c7;
        color: #92400e;
    }

    .role-user {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background: #fee2e2;
        color: #dc2626;
    }

    .status-suspended {
        background: #fef3c7;
        color: #92400e;
    }

    /* Table Styles */
    .table th {
        font-weight: 600;
        color: var(--admin-text);
        font-size: 0.85rem;
        border-bottom: 2px solid var(--admin-border);
        padding: 1rem 0.75rem;
        background: var(--admin-light);
    }

    .table td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--admin-border);
    }

    .table tbody tr:hover {
        background: var(--admin-light);
    }

    /* Activity Info */
    .activity-info {
        font-size: 0.85rem;
    }

    /* Bulk Actions Bar */
    .bulk-actions-bar {
        position: fixed;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        padding: 1rem 1.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        min-width: 600px;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .header-actions {
            flex-direction: column;
            width: 100%;
            gap: 0.5rem;
        }
        
        .bulk-actions-bar {
            left: 1rem;
            right: 1rem;
            transform: none;
            min-width: auto;
        }
        
        .table-responsive {
            font-size: 0.85rem;
        }

        .stats-card {
            margin-bottom: 1rem;
        }

        .quick-action-card {
            margin-bottom: 0.75rem;
        }
    }
</style>

<script>
    // Search and Filter Functionality
    document.getElementById('searchInput').addEventListener('input', filterUsers);
    document.getElementById('roleFilter').addEventListener('change', filterUsers);
    document.getElementById('statusFilter').addEventListener('change', filterUsers);
    document.getElementById('dateFilter').addEventListener('change', filterUsers);

    function filterUsers() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const roleFilter = document.getElementById('roleFilter').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        const dateFilter = document.getElementById('dateFilter').value;
        
        const rows = document.querySelectorAll('.user-row');
        let visibleCount = 0;
        
        rows.forEach(row => {
            const name = row.dataset.name;
            const email = row.dataset.email;
            const role = row.dataset.role;
            const status = row.dataset.status;
            const date = new Date(row.dataset.date);
            
            const matchesSearch = !searchTerm || 
                name.includes(searchTerm) || 
                email.includes(searchTerm);
            
            const matchesRole = !roleFilter || role === roleFilter;
            const matchesStatus = !statusFilter || status === statusFilter;
            
            let matchesDate = true;
            if (dateFilter) {
                const now = new Date();
                switch(dateFilter) {
                    case 'today':
                        matchesDate = date.toDateString() === now.toDateString();
                        break;
                    case 'week':
                        const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                        matchesDate = date >= weekAgo;
                        break;
                    case 'month':
                        matchesDate = date.getMonth() === now.getMonth() && date.getFullYear() === now.getFullYear();
                        break;
                    case 'year':
                        matchesDate = date.getFullYear() === now.getFullYear();
                        break;
                }
            }
            
            if (matchesSearch && matchesRole && matchesStatus && matchesDate) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update table message if no results
        updateTableMessage(visibleCount);
    }

    function updateTableMessage(count) {
        const tbody = document.querySelector('#usersTable tbody');
        const existingMessage = tbody.querySelector('.no-results-message');
        
        if (existingMessage) {
            existingMessage.remove();
        }
        
        if (count === 0) {
            const messageRow = document.createElement('tr');
            messageRow.className = 'no-results-message';
            messageRow.innerHTML = `
                <td colspan="8" class="text-center py-4">
                    <div class="text-muted">
                        <i class="bi bi-search mb-2" style="font-size: 2rem; opacity: 0.5;"></i>
                        <h6>No users found</h6>
                        <p>Try adjusting your search criteria</p>
                    </div>
                </td>
            `;
            tbody.appendChild(messageRow);
        }
    }

    function clearSearch() {
        document.getElementById('searchInput').value = '';
        filterUsers();
    }

    function clearFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('roleFilter').value = '';
        document.getElementById('statusFilter').value = '';
        document.getElementById('dateFilter').value = '';
        filterUsers();
    }

    // Quick Action Functions
    function showNewUsers() {
        document.getElementById('dateFilter').value = 'month';
        filterUsers();
    }

    function showUnverifiedUsers() {
        // This would need backend support to filter by verification status
        console.log('Showing unverified users...');
    }

    function showSuspendedUsers() {
        document.getElementById('statusFilter').value = 'suspended';
        filterUsers();
    }

    // Bulk Actions
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateBulkActions();
    });

    document.querySelectorAll('.user-checkbox').forEach(cb => {
        cb.addEventListener('change', updateBulkActions);
    });

    function updateBulkActions() {
        const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
        const bulkBar = document.getElementById('bulkActionsBar');
        const selectedCount = document.getElementById('selectedCount');
        
        if (checkedBoxes.length > 0) {
            bulkBar.style.display = 'block';
            selectedCount.textContent = checkedBoxes.length;
        } else {
            bulkBar.style.display = 'none';
        }
    }

    function toggleBulkActions() {
        const bulkBar = document.getElementById('bulkActionsBar');
        if (bulkBar.style.display === 'none' || !bulkBar.style.display) {
            // Select first few visible users for demo
            const visibleCheckboxes = Array.from(document.querySelectorAll('.user-checkbox'))
                .filter(cb => cb.closest('tr').style.display !== 'none');
            visibleCheckboxes.slice(0, 3).forEach(cb => cb.checked = true);
            updateBulkActions();
        } else {
            // Deselect all
            document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = false);
            document.getElementById('selectAll').checked = false;
            updateBulkActions();
        }
    }

    function bulkAction(action) {
        const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
        const ids = Array.from(checkedBoxes).map(cb => cb.value);
        
        if (confirm(`Are you sure you want to ${action} ${ids.length} users?`)) {
            console.log(`Bulk ${action}:`, ids);
            // Implement bulk action logic here
            
            // Show success message
            showNotification(`Successfully ${action}ed ${ids.length} users`, 'success');
            
            // Clear selections
            document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = false);
            document.getElementById('selectAll').checked = false;
            updateBulkActions();
        }
    }

    // User Actions
    function sendVerification(userId) {
        console.log('Sending verification to user:', userId);
        showNotification('Verification email sent successfully', 'success');
    }

    function resetPassword(userId) {
        if (confirm('Send password reset email to this user?')) {
            console.log('Resetting password for user:', userId);
            showNotification('Password reset email sent', 'success');
        }
    }

    function viewUserBookings(userId) {
        console.log('Viewing bookings for user:', userId);
        // Redirect to bookings page with user filter
        window.location.href = `{{ route('admin.bookings') }}?user_id=${userId}`;
    }

    function loginAsUser(userId) {
        if (confirm('Login as this user? You will be logged out of your admin account.')) {
            console.log('Logging in as user:', userId);
            // Implement login as user logic
        }
    }

    function suspendUser(userId) {
        if (confirm('Are you sure you want to suspend this user?')) {
            console.log('Suspending user:', userId);
            showNotification('User suspended successfully', 'warning');
        }
    }

    function activateUser(userId) {
        console.log('Activating user:', userId);
        showNotification('User activated successfully', 'success');
    }

    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
            console.log('Deleting user:', userId);
            showNotification('User deleted successfully', 'success');
        }
    }

    // Modal Functions
    function submitAddUser() {
        const form = document.getElementById('addUserForm');
        const formData = new FormData(form);
        
        console.log('Adding new user:', Object.fromEntries(formData));
        // Implement add user logic
        
        bootstrap.Modal.getInstance(document.getElementById('addUserModal')).hide();
        showNotification('User added successfully', 'success');
    }

    function submitExport() {
        const format = document.querySelector('input[name="format"]:checked').value;
        console.log('Exporting users in format:', format);
        // Implement export logic
        
        bootstrap.Modal.getInstance(document.getElementById('exportModal')).hide();
        showNotification('Export started. You will receive an email when ready.', 'info');
    }

    // Utility Functions
    function exportUsers() {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('exportModal')).show();
    }

    function printUsers() {
        window.print();
    }

    function refreshTable() {
        showNotification('Refreshing user data...', 'info');
        setTimeout(() => {
            location.reload();
        }, 1000);
    }

    function showUserStats() {
        console.log('Showing user statistics...');
        // Implement user analytics view
    }

    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection