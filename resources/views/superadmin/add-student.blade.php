<!-- resources/views/superadmin/add-student.blade.php -->
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
            {{ __('Add Student') }}
        </h2>
    </x-slot>

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

                    <!-- Add Student Form -->
                    <form action="{{ route('superadmin.add-student') }}"
    method="POST" class="signin-form">
@csrf
<div class="form-group mb-3">
    <label class="label" for="name">Full Name</label>
    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
</div>

<div class="form-group mb-3">
    <label class="label" for="role">User Type</label>
    <select name="role_id" class="form-control" hidden>
        <!-- Populate the select options dynamically for Student role -->
        @foreach ($roles->where('name', 'Student') as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group mb-3">
    <label class="label" for="department">Department</label>
    <select name="department_id" class="form-control" required>
        <!-- Populate the select options dynamically from the Department table -->
        @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group mb-3">
    <label class="label" for="email">Email</label>
    <input type="email" name="email" class="form-control" placeholder="Email" required>
</div>

<div class="form-group mb-3">
    <label class="label" for="password">Password</label>
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
</x-app-layout>
