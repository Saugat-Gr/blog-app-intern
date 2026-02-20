@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-5 mt-5 text-center">Admin Dashboard</h1>

    <!-- User Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3 shadow-lg">
                <h5>Total Users</h5>
                <p class="display-6">{{ $totalUsers }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3 shadow-lg">
                <h5>Active Users</h5>
                <p class="display-6 text-success">{{ $activeUsers }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3 shadow-lg">
                <h5>Inactive Users</h5>
                <p class="display-6 text-warning">{{ $inactiveUsers }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3 shadow-lg">
                <h5>Suspended Users</h5>
                <p class="display-6 text-danger">{{ $suspendedUsers }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Users Table -->
    <h4>Recent Users</h4>
    <table class="table custom-danger-striped shadow-lg">
        <thead >
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentUsers as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->status == 'active')
                        <span class="badge bg-success">Active</span>
                    @elseif($user->status == 'inactive')
                        <span class="badge bg-warning">Inactive</span>
                    @elseif($user->status == 'suspended')
                        <span class="badge bg-danger">Suspended</span>
                    @else
                        <span class="badge bg-secondary">{{ $user->status }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection