<ul class="nav flex-column">
    <li class="nav-item">
        <span class="nav-link disabled">Actions</span>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superadmin.dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superadmin.add-user') }}">Add User</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superadmin.view-users') }}">View Users</a>
    </li>
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link">Logout</button>
        </form>
    </li>
</ul>
