<ul class="nav flex-column">
    <li class="nav-item">
        <span class="nav-link disabled">Admin Actions</span>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">Edit Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Clearance Requests</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Approved Requests</a>
    </li>
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link">Logout</button>
        </form>
    </li>
</ul>
