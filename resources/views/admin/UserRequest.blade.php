@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Pending User Requests</h2>


    @if($requests->isEmpty())
        <p class="text-muted">No pending requests at the moment.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Requested At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $request->user_id }}</td>
                        <td>{{ $request->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <span class="badge bg-warning text-dark">{{ ucfirst($request->status) }}</span>
                        </td>
                        <td class="d-flex gap-2">
                          
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection