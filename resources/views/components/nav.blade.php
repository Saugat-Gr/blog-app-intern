<nav class="nav justify-content-center">
    <ul class="d-flex bg-body-secondary align-items-center mt-4 rounded shadow">
        @hasanyrole('admin|super-admin')
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.index') }}">Users</a>
            </li>

            @hasrole('super-admin')

            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.user.request') }}">Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.plan.index') }}">Plans</a>
            </li>
            @endhasrole

            
            @hasanyrole('admin|super-admin')
            <li class="nav-item mx-2">
                <a class="nav-link text-dark" href="{{ route('admin.post.index') }}">Posts</a>
            </li>
            @endhasanyrole
            
            @else

            <li class="nav-item mx-2">
                <a class="nav-link text-dark" href="{{ route('dashboard') }}"><i class="bi bi-house-fill"></i></a>
            </li>

            <li class="nav-item mx-2">
                <a class="nav-link text-dark" href="{{ route('user.index') }}"><i class="bi bi-person-fill-check"></i></a>
            </li>

            @haspermission('view-posts')

              <li class="nav-item mx-2">
                <a href="{{ route('user.posts', auth()->user()) }}" class="nav-link text-dark"><i class="bi bi-file-post"></i></a>
              </li>

            @endhaspermission


            @endhasanyrole


    </ul>
</nav>