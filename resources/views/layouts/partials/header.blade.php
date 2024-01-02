<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<header class="header">
    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}"
            style="max-height: 100px; border-radius:1px; max-width:50px; object-fit: cover;" alt="Logo">
    </div>
    <div class="title">
        <h1>Online Clearance System</h1>
    </div>
    <div class="user-menu">
        <!-- User profile image and menu icon -->
        <!-- You can customize this part based on your needs -->
        <img src="{{ asset('images/profile.png') }}" style="max-height: 100px; max-width:50px; object-fit;"
            alt="User Profile">
    </div>
    <div>
        <button type="submit">Logout</button>
    </div>
</header>
