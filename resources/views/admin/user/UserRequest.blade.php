@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center mb-5">Users Request</h2>


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
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->user->user_name }}</td>
                        <td>{{ $request->user->email }}</td>
                        <td>{{ $request->created_at->format('d,M - Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : 'danger' }} text-light">{{ ucfirst($request->status) }}</span>
                        </td>

                        <td class="d-flex gap-2">
                        @if($request->status != 'rejected')

                            <form action="{{ route('admin.request.approve', $request) }}" method="POST">
                                 @method('PATCH')
                                 @csrf
                                 <button type="submit">
                                    <a href="#"><i class="bi bi-check-circle-fill"></i></a>
                                 </button>
                            </form>
                            <form action="{{ route('admin.request.reject', $request) }}" method="POST">
                                 @method('PATCH')
                                 @csrf
                                 <button type="submit">
                                    <a href="#"><i class="bi bi-x text-light bg-danger rounded-circle"></i></a>
                                 </button>
                            </form>
                    @else
                            <p class="text-center"> - </p>
                    @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection