@extends('layouts.admin-sidebar')

@section('title', 'System Setup')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">System Setup</h2>
    <p class="text-muted">Assign administrator privileges to users</p>

    <div class="alert alert-warning">
        <strong>Warning!</strong> This page is for system setup. Be careful when assigning admin privileges.
    </div>

    <div class="card">
        <div class="card-header">
            <h4>User Management</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Admin Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->is_admin)
                                        <span class="badge bg-success">Admin</span>
                                    @else
                                        <span class="badge bg-secondary">User</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_admin)
                                        <form action="{{ route('setup.remove-admin', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning">Remove Admin</button>
                                        </form>
                                    @else
                                        <form action="{{ route('setup.make-admin', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">Make Admin</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection