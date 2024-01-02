<!-- resources/views/superadmin/edit-user.blade.php -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/font-awesome.min.css"
        integrity="sha384-dp1f8a0WNAAK8onE6YOEC1SdqWl5vlSV3auuknHuMXYz5FfjsNQfAFH52r1Gt3" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('superadmin.dashboard') }}" class="block text-blue-500 hover:text-blue-700">
                    {{ __('Super Admin Dashboard') }}</a>
            </h2>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex bg-white overflow-scroll shadow-sm sm:rounded-lg">
    
                    <!-- Side Panel -->
                    <div class="w-1/4  p-4 bg-gray-200">
                        <h3 class="font-semibold text-lg mb-4">{{ Auth::user()->name }}</h3>
    
                        <!-- Common Links -->
                        <a href="{{ route('profile.edit') }}" class="block text-gray-500 hover:text-gray-700">
                            Profile</a>
    
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block text-red-500 hover:text-red-700 mt-2">Logout</button>
                        </form>
    
                        <!-- Super Admin Links -->
                        <h3 class="font-semibold text-lg mt-4 mb-2">Actions</h3>
                        <a href="{{ route('superadmin.add-user') }}" class="block text-blue-500 hover:text-blue-700">
                            Add User</a>
                            <a href="{{ route('superadmin.view-students') }}" class="block text-blue-500 hover:text-blue-700">
                                Students</a>
                            <a href="{{ route('superadmin.view-staff') }}" class="block text-blue-500 hover:text-blue-700">
                                    Staff</a>
                            <a href="{{ route('superadmin.view-admins') }}" class="block text-blue-500 hover:text-blue-700">
                                        Admin</a>
                    </div>
    
                    <!-- Main Content -->
                    <div class="w-3/4 p-4">
                        <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Edit User') }} - {{ $user->name }}
                                </h2>
                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                                        <div class="p-6 bg-white border-b border-gray-200">
                                            <!-- Display success message if it exists -->
                                            @if (session('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                    
                                            <!-- Display validation errors if they exist -->
                                            @if ($errors->any())
                                                <div class="alert alert-danger" role="alert">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li> @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                    
                                            <!-- Edit User Form -->
                                            <form action="{{ route('superadmin.update-edited-user', ['id' => $user->id]) }}"
    method="POST" class="signin-form">
@csrf
<!-- Include any user details you want to display or edit in the form -->

<div class="form-group mb-3">
    <label class="label" for="name">Full Name</label>
    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
</div>

<div class="form-group mb-3">
    <label class="label" for="email">Email</label>
    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
</div>

<div class="form-group mb-3">
    <label class="label" for="password">Password - Optional</label>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
</div>

<div class="form-group mb-3">
    <label class="label" for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
</div>

<div class="form-group">
    <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</x-app-layout>
