@extends('layouts.admin-sidebar')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Manage Bookings</h2>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Bookings</h5>
            <div>
                <select class="form-select form-select-sm d-inline-block w-auto" id="statusFilter">
                    <option value="">All Statuses</option>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Service Type</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->service_type }}</td>
                                <td>{{ $booking->booking_date }} at {{ $booking->booking_time }}</td>
                                <td>
                                    <span class="badge bg-{{ $booking->status == 'Pending' ? 'warning' : ($booking->status == 'Confirmed' ? 'primary' : ($booking->status == 'Completed' ? 'success' : 'danger')) }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($booking->assigned_to)
                                        {{ $booking->assignedEmployee->name }}
                                    @else
                                        <span class="text-muted">Not assigned</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $booking->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $booking->id }}">
                                            <li>
                                                <form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="Confirmed">
                                                    <button type="submit" class="dropdown-item">Confirm</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="Completed">
                                                    <button type="submit" class="dropdown-item">Complete</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="Cancelled">
                                                    <button type="submit" class="dropdown-item">Cancel</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No bookings found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusFilter = document.getElementById('statusFilter');
        const tableRows = document.querySelectorAll('tbody tr');
        
        statusFilter.addEventListener('change', function() {
            const selectedStatus = this.value;
            
            tableRows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(5)');
                if (!statusCell) return;
                
                const statusText = statusCell.textContent.trim();
                
                if (selectedStatus === '' || statusText === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection