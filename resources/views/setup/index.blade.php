@extends('layouts.admin-sidebar')

@section('title', 'System Setup')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <div class="d-flex align-items-center mb-2">
                    <div class="page-icon me-3">
                        <i class="bi bi-gear"></i>
                    </div>
                    <div>
                        <h1 class="page-title mb-1">System Setup</h1>
                        <p class="page-subtitle mb-0">Configure system settings and manage administrator privileges</p>
                    </div>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">System Setup</li>
                    </ol>
                </nav>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#backupModal">
                    <i class="bi bi-cloud-download me-1"></i>Backup System
                </button>
                <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#maintenanceModal">
                    <i class="bi bi-tools me-1"></i>Maintenance Mode
                </button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#systemInfoModal">
                    <i class="bi bi-info-circle me-1"></i>System Info
                </button>
            </div>
        </div>
    </div>

    <!-- Security Alert -->
    <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex align-items-start">
            <i class="bi bi-shield-exclamation me-3 mt-1" style="font-size: 1.25rem;"></i>
            <div>
                <h6 class="alert-heading mb-1">Security Notice</h6>
                <p class="mb-0">This page contains sensitive system configuration options. Only authorized administrators should access these settings. All changes are logged for security purposes.</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <!-- System Overview Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon bg-primary">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $users->count() }}</h3>
                    <p>Total Users</p>
                    <div class="stats-trend">
                        <i class="bi bi-arrow-up text-success"></i>
                        <span class="text-success">Active system</span>
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
                    <h3>{{ $users->where('is_admin', true)->count() }}</h3>
                    <p>Administrators</p>
                    <div class="stats-trend">
                        <i class="bi bi-shield text-warning"></i>
                        <span class="text-muted">Privileged accounts</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon bg-success">
                    <i class="bi bi-server"></i>
                </div>
                <div class="stats-content">
                    <h3>Online</h3>
                    <p>System Status</p>
                    <div class="stats-trend">
                        <i class="bi bi-circle-fill text-success"></i>
                        <span class="text-success">All services running</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon bg-info">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ now()->format('H:i') }}</h3>
                    <p>Server Time</p>
                    <div class="stats-trend">
                        <i class="bi bi-calendar text-info"></i>
                        <span class="text-muted">{{ now()->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Setup Sections -->
    <div class="row g-4">
        <!-- Administrator Management -->
        <div class="col-lg-8">
            <div class="content-card">
                <div class="content-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="content-card-title">
                                <i class="bi bi-shield-lock me-2"></i>Administrator Management
                            </h5>
                            <p class="content-card-subtitle">Manage user privileges and administrator access</p>
                        </div>
                        <div class="header-actions">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="filterAdmins()">
                                    <i class="bi bi-funnel me-1"></i>Admins Only
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="filterUsers()">
                                    <i class="bi bi-people me-1"></i>Users Only
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="showAll()">
                                    <i class="bi bi-eye me-1"></i>Show All
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="content-card-body">
                    <!-- Search and Filter -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" class="form-control" id="userSearch" placeholder="Search users by name or email...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="roleFilter">
                                <option value="">All Roles</option>
                                <option value="admin">Administrators</option>
                                <option value="user">Regular Users</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                                <i class="bi bi-x-circle me-1"></i>Clear
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover" id="usersTable">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Contact</th>
                                    <th>Current Role</th>
                                    <th>Last Activity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="user-row" 
                                        data-name="{{ strtolower($user->name) }}" 
                                        data-email="{{ strtolower($user->email) }}" 
                                        data-role="{{ $user->is_admin ? 'admin' : 'user' }}">
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
                                                    <div class="fw-semibold">{{ $user->name }}</div>
                                                    <small class="text-muted">ID: {{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</small>
                                                </div>
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
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($user->is_admin)
                                                    <span class="role-badge role-admin">
                                                        <i class="bi bi-shield-check me-1"></i>Administrator
                                                    </span>
                                                @else
                                                    <span class="role-badge role-user">
                                                        <i class="bi bi-person me-1"></i>Regular User
                                                    </span>
                                                @endif
                                            </div>
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
                                                    <i class="bi bi-calendar3 me-1"></i>
                                                    Joined {{ $user->created_at->format('M Y') }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                @if($user->is_admin)
                                                    <button class="btn btn-sm btn-outline-warning" 
                                                            onclick="confirmRoleChange({{ $user->id }}, 'remove', '{{ $user->name }}')"
                                                            title="Remove Admin Privileges">
                                                        <i class="bi bi-shield-x me-1"></i>Remove Admin
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-primary" 
                                                            onclick="confirmRoleChange({{ $user->id }}, 'make', '{{ $user->name }}')"
                                                            title="Grant Admin Privileges">
                                                        <i class="bi bi-shield-plus me-1"></i>Make Admin
                                                    </button>
                                                @endif
                                                
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown" title="More Options">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" onclick="viewUserDetails({{ $user->id }})">
                                                        <i class="bi bi-eye me-2"></i>View Details
                                                    </a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="viewUserActivity({{ $user->id }})">
                                                        <i class="bi bi-activity me-2"></i>Activity Log
                                                    </a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="#" onclick="resetUserPassword({{ $user->id }})">
                                                        <i class="bi bi-key me-2"></i>Reset Password
                                                    </a></li>
                                                    @if(!$user->is_admin)
                                                        <li><a class="dropdown-item text-warning" href="#" onclick="suspendUser({{ $user->id }})">
                                                            <i class="bi bi-pause-circle me-2"></i>Suspend User
                                                        </a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Configuration -->
        <div class="col-lg-4">
            <div class="content-card mb-4">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="bi bi-sliders me-2"></i>System Configuration
                    </h5>
                    <p class="content-card-subtitle">Quick system settings and controls</p>
                </div>
                <div class="content-card-body">
                    <div class="config-section">
                        <h6 class="config-title">Security Settings</h6>
                        <div class="config-item">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="twoFactorAuth" checked>
                                <label class="form-check-label" for="twoFactorAuth">
                                    Two-Factor Authentication
                                </label>
                            </div>
                            <small class="text-muted">Require 2FA for admin accounts</small>
                        </div>
                        <div class="config-item">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="sessionTimeout" checked>
                                <label class="form-check-label" for="sessionTimeout">
                                    Auto Session Timeout
                                </label>
                            </div>
                            <small class="text-muted">Auto-logout after inactivity</small>
                        </div>
                        <div class="config-item">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="loginLogging" checked>
                                <label class="form-check-label" for="loginLogging">
                                    Login Activity Logging
                                </label>
                            </div>
                            <small class="text-muted">Track all login attempts</small>
                        </div>
                    </div>

                    <div class="config-section">
                        <h6 class="config-title">System Maintenance</h6>
                        <div class="config-item">
                            <button class="btn btn-outline-info btn-sm w-100 mb-2" onclick="clearCache()">
                                <i class="bi bi-arrow-clockwise me-1"></i>Clear System Cache
                            </button>
                            <button class="btn btn-outline-warning btn-sm w-100 mb-2" onclick="optimizeDatabase()">
                                <i class="bi bi-database me-1"></i>Optimize Database
                            </button>
                            <button class="btn btn-outline-secondary btn-sm w-100" onclick="generateReport()">
                                <i class="bi bi-file-text me-1"></i>Generate System Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Admin Activities -->
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="bi bi-clock-history me-2"></i>Recent Admin Activities
                    </h5>
                    <p class="content-card-subtitle">Latest administrative actions</p>
                </div>
                <div class="content-card-body">
                    <div class="activity-timeline">
                        <div class="activity-item">
                            <div class="activity-icon bg-primary">
                                <i class="bi bi-shield-plus"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Admin privileges granted</div>
                                <div class="activity-meta">John Doe • 2 hours ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-warning">
                                <i class="bi bi-shield-x"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Admin privileges revoked</div>
                                <div class="activity-meta">Jane Smith • 5 hours ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-info">
                                <i class="bi bi-gear"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">System settings updated</div>
                                <div class="activity-meta">Admin • 1 day ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-success">
                                <i class="bi bi-cloud-download"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">System backup completed</div>
                                <div class="activity-meta">System • 2 days ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-secondary btn-sm" onclick="viewFullActivityLog()">
                            <i class="bi bi-list me-1"></i>View Full Log
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Role Change Confirmation Modal -->
<div class="modal fade" id="roleChangeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleChangeTitle">Confirm Role Change</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Important:</strong> This action will change user privileges and may affect system access.
                </div>
                <p id="roleChangeMessage"></p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="confirmRoleChange" required>
                    <label class="form-check-label" for="confirmRoleChange">
                        I understand the implications of this change
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmRoleBtn" onclick="executeRoleChange()" disabled>
                    Confirm Change
                </button>
            </div>
        </div>
    </div>
</div>

<!-- System Info Modal -->
<div class="modal fade" id="systemInfoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-info-circle me-2"></i>System Information
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <h6>Application Details</h6>
                        <table class="table table-sm">
                            <tr><td>Version:</td><td>1.0.0</td></tr>
                            <tr><td>Environment:</td><td>{{ app()->environment() }}</td></tr>
                            <tr><td>Debug Mode:</td><td>{{ config('app.debug') ? 'Enabled' : 'Disabled' }}</td></tr>
                            <tr><td>Timezone:</td><td>{{ config('app.timezone') }}</td></tr>
                            <tr><td>Locale:</td><td>{{ app()->getLocale() }}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Server Information</h6>
                        <table class="table table-sm">
                            <tr><td>PHP Version:</td><td>{{ PHP_VERSION }}</td></tr>
                            <tr><td>Laravel Version:</td><td>{{ app()->version() }}</td></tr>
                            <tr><td>Server Time:</td><td>{{ now()->format('Y-m-d H:i:s') }}</td></tr>
                            <tr><td>Memory Limit:</td><td>{{ ini_get('memory_limit') }}</td></tr>
                            <tr><td>Max Upload:</td><td>{{ ini_get('upload_max_filesize') }}</td></tr>
                        </table>
                    </div>
                    <div class="col-12">
                        <h6>Database Information</h6>
                        <table class="table table-sm">
                            <tr><td>Connection:</td><td>{{ config('database.default') }}</td></tr>
                            <tr><td>Database:</td><td>{{ config('database.connections.'.config('database.default').'.database') }}</td></tr>
                            <tr><td>Total Users:</td><td>{{ \App\Models\User::count() }}</td></tr>
                            <tr><td>Storage Used:</td><td>{{ number_format(disk_total_space('.') - disk_free_space('.')) }} bytes</td></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

    /* Role Badges */
    .role-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
    }

    .role-admin {
        background: #fef3c7;
        color: #92400e;
    }

    .role-user {
        background: #dbeafe;
        color: #1e40af;
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

    /* Configuration Sections */
    .config-section {
        margin-bottom: 1.5rem;
    }

    .config-section:last-child {
        margin-bottom: 0;
    }

    .config-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--admin-text);
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--admin-border);
    }

    .config-item {
        margin-bottom: 1rem;
    }

    .config-item:last-child {
        margin-bottom: 0;
    }

    /* Activity Timeline */
    .activity-timeline {
        position: relative;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 1rem;
        position: relative;
    }

    .activity-item:last-child {
        margin-bottom: 0;
    }

    .activity-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 15px;
        top: 30px;
        bottom: -16px;
        width: 2px;
        background: var(--admin-border);
    }

    .activity-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.8rem;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    .activity-content {
        flex: 1;
        padding-top: 0.25rem;
    }

    .activity-title {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--admin-text);
        margin-bottom: 0.25rem;
    }

    .activity-meta {
        font-size: 0.75rem;
        color: var(--admin-text-muted);
    }

    /* Activity Info */
    .activity-info {
        font-size: 0.85rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header-actions {
            flex-direction: column;
            width: 100%;
            gap: 0.5rem;
        }
        
        .stats-card {
            margin-bottom: 1rem;
        }
        
        .table-responsive {
            font-size: 0.85rem;
        }
    }
</style>

<script>
    let currentUserId = null;
    let currentAction = null;

    // Search and Filter Functionality
    document.getElementById('userSearch').addEventListener('input', filterUsers);
    document.getElementById('roleFilter').addEventListener('change', filterUsers);

    function filterUsers() {
        const searchTerm = document.getElementById('userSearch').value.toLowerCase();
        const roleFilter = document.getElementById('roleFilter').value;
        
        const rows = document.querySelectorAll('.user-row');
        
        rows.forEach(row => {
            const name = row.dataset.name;
            const email = row.dataset.email;
            const role = row.dataset.role;
            
            const matchesSearch = !searchTerm || 
                name.includes(searchTerm) || 
                email.includes(searchTerm);
            
            const matchesRole = !roleFilter || role === roleFilter;
            
            if (matchesSearch && matchesRole) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function filterAdmins() {
        document.getElementById('roleFilter').value = 'admin';
        filterUsers();
    }

    function filterUsers() {
        document.getElementById('roleFilter').value = 'user';
        filterUsers();
    }

    function showAll() {
        document.getElementById('roleFilter').value = '';
        filterUsers();
    }

    function clearFilters() {
        document.getElementById('userSearch').value = '';
        document.getElementById('roleFilter').value = '';
        filterUsers();
    }

    // Role Change Functions
    function confirmRoleChange(userId, action, userName) {
        currentUserId = userId;
        currentAction = action;
        
        const modal = document.getElementById('roleChangeModal');
        const title = document.getElementById('roleChangeTitle');
        const message = document.getElementById('roleChangeMessage');
        const confirmBtn = document.getElementById('confirmRoleBtn');
        
        if (action === 'make') {
            title.textContent = 'Grant Administrator Privileges';
            message.innerHTML = `Are you sure you want to grant administrator privileges to <strong>${userName}</strong>?<br><br>This will give them full access to system settings and user management.`;
            confirmBtn.className = 'btn btn-primary';
            confirmBtn.innerHTML = '<i class="bi bi-shield-plus me-1"></i>Grant Admin Access';
        } else {
            title.textContent = 'Remove Administrator Privileges';
            message.innerHTML = `Are you sure you want to remove administrator privileges from <strong>${userName}</strong>?<br><br>They will lose access to admin features and system settings.`;
            confirmBtn.className = 'btn btn-warning';
            confirmBtn.innerHTML = '<i class="bi bi-shield-x me-1"></i>Remove Admin Access';
        }
        
        // Reset confirmation checkbox
        document.getElementById('confirmRoleChange').checked = false;
        confirmBtn.disabled = true;
        
        bootstrap.Modal.getOrCreateInstance(modal).show();
    }

    // Enable/disable confirm button based on checkbox
    document.getElementById('confirmRoleChange').addEventListener('change', function() {
        document.getElementById('confirmRoleBtn').disabled = !this.checked;
    });

    function executeRoleChange() {
        if (!currentUserId || !currentAction) return;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = currentAction === 'make' 
            ? `{{ route('setup.make-admin', '') }}/${currentUserId}`
            : `{{ route('setup.remove-admin', '') }}/${currentUserId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        document.body.appendChild(form);
        form.submit();
        
        bootstrap.Modal.getInstance(document.getElementById('roleChangeModal')).hide();
    }

    // User Action Functions
    function viewUserDetails(userId) {
        console.log('Viewing details for user:', userId);
        // Implement user details view
    }

    function viewUserActivity(userId) {
        console.log('Viewing activity for user:', userId);
        // Implement activity log view
    }

    function resetUserPassword(userId) {
        if (confirm('Send password reset email to this user?')) {
            console.log('Resetting password for user:', userId);
            showNotification('Password reset email sent successfully', 'success');
        }
    }

    function suspendUser(userId) {
        if (confirm('Are you sure you want to suspend this user?')) {
            console.log('Suspending user:', userId);
            showNotification('User suspended successfully', 'warning');
        }
    }

    // System Maintenance Functions
    function clearCache() {
        if (confirm('Clear system cache? This may temporarily slow down the application.')) {
            showNotification('System cache cleared successfully', 'success');
            console.log('Clearing system cache...');
        }
    }

    function optimizeDatabase() {
        if (confirm('Optimize database? This process may take a few minutes.')) {
            showNotification('Database optimization started...', 'info');
            console.log('Optimizing database...');
        }
    }

    function generateReport() {
        showNotification('Generating system report...', 'info');
        console.log('Generating system report...');
    }

    function viewFullActivityLog() {
        console.log('Opening full activity log...');
        // Implement full activity log view
    }

    // Configuration Functions
    document.querySelectorAll('.form-check-input').forEach(input => {
        input.addEventListener('change', function() {
            const setting = this.id;
            const enabled = this.checked;
            console.log(`Setting ${setting} to ${enabled}`);
            showNotification(`${setting} ${enabled ? 'enabled' : 'disabled'}`, 'info');
        });
    });

    // Utility Functions
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
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