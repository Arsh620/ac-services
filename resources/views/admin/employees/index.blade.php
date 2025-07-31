@extends('layouts.admin-sidebar')

@section('title', 'Manage Employees')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h1 class="page-title mb-1">Employee Management</h1>
                <p class="page-subtitle mb-0">Manage your team members and their assignments</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="bi bi-upload me-1"></i>Import
                </button>
                <button class="btn btn-outline-secondary" onclick="exportEmployees()">
                    <i class="bi bi-download me-1"></i>Export
                </button>
                <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus me-1"></i>Add Employee
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-primary">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $employees->count() }}</h3>
                    <p>Total Employees</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-success">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $employees->where('status', 'active')->count() }}</h3>
                    <p>Active Employees</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-info">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $employees->sum('assigned_bookings_count') ?? 0 }}</h3>
                    <p>Active Assignments</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-icon bg-warning">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $employees->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
                    <p>New This Month</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="content-card mb-4">
        <div class="content-card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Search Employees</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search by name, email, or position...">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Position</label>
                    <select class="form-select" id="positionFilter">
                        <option value="">All Positions</option>
                        <option value="Technician">Technician</option>
                        <option value="Senior Technician">Senior Technician</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Manager">Manager</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="on-leave">On Leave</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sort By</label>
                    <select class="form-select" id="sortBy">
                        <option value="name">Name</option>
                        <option value="position">Position</option>
                        <option value="created_at">Date Added</option>
                        <option value="assignments">Assignments</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                        <i class="bi bi-x-circle me-1"></i>Clear
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Cards/Table Toggle -->
    <div class="content-card">
        <div class="content-card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="content-card-title">
                        <i class="bi bi-people me-2"></i>Employee Directory
                    </h5>
                    <p class="content-card-subtitle">Manage your team members and their information</p>
                </div>
                <div class="view-toggle">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary active" id="cardView" onclick="toggleView('card')">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" id="tableView" onclick="toggleView('table')">
                            <i class="bi bi-table"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-card-body">
            <!-- Card View -->
            <div id="cardViewContainer" class="employee-cards">
                <div class="row g-4" id="employeeCards">
                    @forelse($employees as $employee)
                        <div class="col-xl-4 col-lg-6 employee-card-item" 
                             data-name="{{ strtolower($employee->name) }}" 
                             data-email="{{ strtolower($employee->email) }}" 
                             data-position="{{ strtolower($employee->position) }}"
                             data-status="{{ strtolower($employee->status ?? 'active') }}">
                            <div class="employee-card">
                                <div class="employee-card-header">
                                    <div class="employee-avatar">
                                        @if($employee->avatar)
                                            <img src="{{ asset('storage/' . $employee->avatar) }}" alt="{{ $employee->name }}">
                                        @else
                                            {{ substr($employee->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="employee-status">
                                        <span class="status-badge status-{{ strtolower($employee->status ?? 'active') }}">
                                            {{ ucfirst($employee->status ?? 'Active') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="employee-card-body">
                                    <h6 class="employee-name">{{ $employee->name }}</h6>
                                    <p class="employee-position">{{ $employee->position }}</p>
                                    
                                    <div class="employee-details">
                                        <div class="detail-item">
                                            <i class="bi bi-envelope"></i>
                                            <span>{{ $employee->email }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="bi bi-telephone"></i>
                                            <span>{{ $employee->phone ?? 'N/A' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="bi bi-calendar-check"></i>
                                            <span>{{ $employee->assigned_bookings_count ?? 0 }} Active Assignments</span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="bi bi-calendar3"></i>
                                            <span>Joined {{ \Carbon\Carbon::parse($employee->created_at)->format('M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="employee-card-footer">
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.employees.assign', $employee) }}" class="btn btn-outline-info btn-sm">
                                            <i class="bi bi-calendar-plus"></i>
                                        </a>
                                        <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Profile</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-graph-up me-2"></i>Performance</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to remove this employee?')">
                                                        <i class="bi bi-trash me-2"></i>Remove Employee
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <h6>No Employees Found</h6>
                                <p>Start by adding your first team member to get started.</p>
                                <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
                                    <i class="bi bi-person-plus me-1"></i>Add First Employee
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Table View -->
            <div id="tableViewContainer" class="employee-table d-none">
                <div class="table-responsive">
                    <table class="table table-hover" id="employeeTable">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th>Employee</th>
                                <th>Position</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Assignments</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $employee)
                                <tr class="employee-row" 
                                    data-name="{{ strtolower($employee->name) }}" 
                                    data-email="{{ strtolower($employee->email) }}" 
                                    data-position="{{ strtolower($employee->position) }}"
                                    data-status="{{ strtolower($employee->status ?? 'active') }}">
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input employee-checkbox" type="checkbox" value="{{ $employee->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="employee-avatar-sm me-3">
                                                @if($employee->avatar)
                                                    <img src="{{ asset('storage/' . $employee->avatar) }}" alt="{{ $employee->name }}">
                                                @else
                                                    {{ substr($employee->name, 0, 1) }}
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $employee->name }}</div>
                                                <small class="text-muted">ID: {{ str_pad($employee->id, 4, '0', STR_PAD_LEFT) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="position-badge">{{ $employee->position }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="small">{{ $employee->email }}</div>
                                            <div class="small text-muted">{{ $employee->phone ?? 'N/A' }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($employee->status ?? 'active') }}">
                                            {{ ucfirst($employee->status ?? 'Active') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div class="fw-semibold">{{ $employee->assigned_bookings_count ?? 0 }}</div>
                                            <small class="text-muted">Active</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small">{{ \Carbon\Carbon::parse($employee->created_at)->format('M d, Y') }}</div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ route('admin.employees.assign', $employee) }}" class="btn btn-sm btn-outline-info" title="Assign Bookings">
                                                <i class="bi bi-calendar-plus"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown" title="More Options">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Profile</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-graph-up me-2"></i>Performance</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to remove this employee?')">
                                                            <i class="bi bi-trash me-2"></i>Remove
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="bi bi-people"></i>
                                            <h6>No Employees Found</h6>
                                            <p>Start by adding your first team member.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Actions Bar -->
    <div class="bulk-actions-bar" id="bulkActionsBar" style="display: none;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span id="selectedCount">0</span> employees selected
            </div>
            <div class="btn-group">
                <button class="btn btn-outline-primary btn-sm" onclick="bulkAction('activate')">
                    <i class="bi bi-check-circle me-1"></i>Activate
                </button>
                <button class="btn btn-outline-warning btn-sm" onclick="bulkAction('deactivate')">
                    <i class="bi bi-pause-circle me-1"></i>Deactivate
                </button>
                <button class="btn btn-outline-danger btn-sm" onclick="bulkAction('delete')">
                    <i class="bi bi-trash me-1"></i>Delete
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Employees</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="importForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="csvFile" class="form-label">Select CSV File</label>
                        <input type="file" class="form-control" id="csvFile" name="csv_file" accept=".csv" required>
                        <div class="form-text">
                            Upload a CSV file with columns: name, email, position, phone
                        </div>
                    </div>
                    <div class="mb-3">
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-download me-1"></i>Download Template
                        </a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitImport()">Import Employees</button>
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

    /* Employee Cards */
    .employee-card {
        background: white;
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }

    .employee-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
    }

    .employee-card-header {
        padding: 1.25rem;
        background: linear-gradient(135deg, var(--admin-light) 0%, #e2e8f0 100%);
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .employee-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--admin-accent), #6366f1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        overflow: hidden;
    }

    .employee-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .employee-avatar-sm {
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

    .employee-avatar-sm img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .employee-card-body {
        padding: 1.25rem;
    }

    .employee-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--admin-text);
        margin: 0 0 0.25rem;
    }

    .employee-position {
        color: var(--admin-text-muted);
        font-size: 0.9rem;
        margin: 0 0 1rem;
    }

    .employee-details {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--admin-text-muted);
    }

    .detail-item i {
        width: 16px;
        color: var(--admin-accent);
    }

    .employee-card-footer {
        padding: 1rem 1.25rem;
        background: var(--admin-light);
        border-top: 1px solid var(--admin-border);
    }

    /* Status and Position Badges */
    .status-badge, .position-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background: #fee2e2;
        color: #dc2626;
    }

    .status-on-leave {
        background: #fef3c7;
        color: #92400e;
    }

    .position-badge {
        background: var(--admin-light);
        color: var(--admin-text);
        border: 1px solid var(--admin-border);
    }

    /* View Toggle */
    .view-toggle .btn {
        border-color: var(--admin-border);
    }

    .view-toggle .btn.active {
        background: var(--admin-accent);
        border-color: var(--admin-accent);
        color: white;
    }

    /* Table Styles */
    .table th {
        font-weight: 600;
        color: var(--admin-text);
        font-size: 0.85rem;
        border-bottom: 2px solid var(--admin-border);
        padding: 1rem 0.75rem;
    }

    .table td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--admin-border);
    }

    .table tbody tr:hover {
        background: var(--admin-light);
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
        min-width: 400px;
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
        
        .employee-cards .row {
            margin: 0;
        }
        
        .bulk-actions-bar {
            left: 1rem;
            right: 1rem;
            transform: none;
            min-width: auto;
        }
    }
</style>

<script>
    // Search and Filter Functionality
    document.getElementById('searchInput').addEventListener('input', filterEmployees);
    document.getElementById('positionFilter').addEventListener('change', filterEmployees);
    document.getElementById('statusFilter').addEventListener('change', filterEmployees);
    document.getElementById('sortBy').addEventListener('change', sortEmployees);

    function filterEmployees() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const positionFilter = document.getElementById('positionFilter').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        
        const isCardView = !document.getElementById('cardViewContainer').classList.contains('d-none');
        const items = isCardView ? 
            document.querySelectorAll('.employee-card-item') : 
            document.querySelectorAll('.employee-row');
        
        items.forEach(item => {
            const name = item.dataset.name;
            const email = item.dataset.email;
            const position = item.dataset.position;
            const status = item.dataset.status;
            
            const matchesSearch = !searchTerm || 
                name.includes(searchTerm) || 
                email.includes(searchTerm) || 
                position.includes(searchTerm);
            
            const matchesPosition = !positionFilter || position.includes(positionFilter);
            const matchesStatus = !statusFilter || status === statusFilter;
            
            if (matchesSearch && matchesPosition && matchesStatus) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function sortEmployees() {
        const sortBy = document.getElementById('sortBy').value;
        // Implement sorting logic here
        console.log('Sorting by:', sortBy);
    }

    function clearFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('positionFilter').value = '';
        document.getElementById('statusFilter').value = '';
        document.getElementById('sortBy').value = 'name';
        filterEmployees();
    }

    // View Toggle
    function toggleView(view) {
        const cardView = document.getElementById('cardViewContainer');
        const tableView = document.getElementById('tableViewContainer');
        const cardBtn = document.getElementById('cardView');
        const tableBtn = document.getElementById('tableView');
        
        if (view === 'card') {
            cardView.classList.remove('d-none');
            tableView.classList.add('d-none');
            cardBtn.classList.add('active');
            tableBtn.classList.remove('active');
        } else {
            cardView.classList.add('d-none');
            tableView.classList.remove('d-none');
            cardBtn.classList.remove('active');
            tableBtn.classList.add('active');
        }
    }

    // Bulk Actions
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.employee-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateBulkActions();
    });

    document.querySelectorAll('.employee-checkbox').forEach(cb => {
        cb.addEventListener('change', updateBulkActions);
    });

    function updateBulkActions() {
        const checkedBoxes = document.querySelectorAll('.employee-checkbox:checked');
        const bulkBar = document.getElementById('bulkActionsBar');
        const selectedCount = document.getElementById('selectedCount');
        
        if (checkedBoxes.length > 0) {
            bulkBar.style.display = 'block';
            selectedCount.textContent = checkedBoxes.length;
        } else {
            bulkBar.style.display = 'none';
        }
    }

    function bulkAction(action) {
        const checkedBoxes = document.querySelectorAll('.employee-checkbox:checked');
        const ids = Array.from(checkedBoxes).map(cb => cb.value);
        
        if (confirm(`Are you sure you want to ${action} ${ids.length} employees?`)) {
            console.log(`Bulk ${action}:`, ids);
            // Implement bulk action logic here
        }
    }

    // Export Functionality
    function exportEmployees() {
        console.log('Exporting employees...');
        // Implement export logic here
    }

    // Import Functionality
    function submitImport() {
        const formData = new FormData(document.getElementById('importForm'));
        console.log('Importing employees...');
        // Implement import logic here
        bootstrap.Modal.getInstance(document.getElementById('importModal')).hide();
    }
</script>
@endsection