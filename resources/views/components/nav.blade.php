<nav class="nav justify-content-center">
    <ul class="d-flex bg-body-secondary align-items-center mt-4 rounded shadow">
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.index') }}">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.user.request') }}">Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.plan.index') }}">Plans</a>
            </li>
    </ul>
</nav>