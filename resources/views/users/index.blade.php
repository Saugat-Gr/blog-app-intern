@extends('layouts.app')


@section('content')


<table class="table custom-danger-striped  mt-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Avatar</th>
      <th scope="col">User-Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
<tbody>
      @foreach ($users as $user)
          <tr>
              <td >{{ $user->id }}</td>
              <td>
                  <img src="{{ asset('storage/userAvatar.png') }}"
                      width="50"
                      height="50"
                      class="rounded-circle">
              </td>
              <td>{{ $user->user_name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->role }}</td>
              <td>{{ $user->status }}</td>
              <td>
                  <button class="btn btn-danger">
                      <i class="bi bi-trash-fill text-light"></i>
                  </button>
                  <button class="btn btn-info">
                      <i class="bi bi-pencil-square text-light"></i>
                  </button>
              </td>
          </tr>
      @endforeach
</tbody>
</table>

@endsection