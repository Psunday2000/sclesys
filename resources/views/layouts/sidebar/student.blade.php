<ul class="nav flex-column">
    <li class="nav-item">
        <span class="nav-link disabled">Student Actions</span>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('student.dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">Edit Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">View Phases</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">View Approved Phases</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">View Submitted Data</a>
    </li>
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link">Logout</button>
        </form>
    </li>
</ul>
