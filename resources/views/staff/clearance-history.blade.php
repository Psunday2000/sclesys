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
            <a href="{{ route('staff.dashboard') }}" class="block text-blue-500 hover:text-blue-700">
                {{ __('Staff Dashboard') }}</a>Clearance Requests
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

                    <!-- Staff Links -->
                    <h3 class="font-semibold text-lg mt-4 mb-2">Actions</h3>
                    <a href="{{ route('staff.add-student') }}" class="block text-blue-500 hover:text-blue-700">
                        Add Student</a>
                    <a href="{{ route('staff.view-students') }}" class="block text-blue-500 hover:text-blue-700">
                        Students</a>
                    <a href="{{ route('staff.clearance-requests') }}" class="block text-blue-500 hover:text-blue-700">
                        Clearance Requests</a>
                    <a href="{{ route('staff.clearance-history', ['status' => 'approved']) }}"
                        class="block text-blue-500 hover:text-blue-700">Approved History</a>
                    <a href="{{ route('staff.clearance-history', ['status' => 'rejected']) }}"
                        class="block text-blue-500 hover:text-blue-700">Rejected History</a>
                </div>

                <!-- Main Content -->
                <div class="w-3/4 p-4">
                    <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="font-semibold text-lg mb-4">Clearance History - {{ ucfirst($status) }}</h3>

                    @if ($clearanceHistory->isEmpty())
                        <p>No {{ $status }} requests.</p>
                    @else
                        @if ($status == 'approved')
                            <table class="table table-bordered thead-dark">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Student Name</th>
                                        <th>Registration</th>
                                        <th>Department</th>
                                        <th>Date Cleared</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clearanceHistory as $index => $request)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $studentNames[$request->user_id] ?? 'N/A' }}</td>
                                            <td>{{ $registrationNumbers[$request->user_id] ?? 'N/A' }}</td>
                                            <td>{{ $departments[$request->user_id] ?? 'N/A' }}</td>
                                            <td>{{ $request->date_cleared->format('Y-m-d H:i:s') }}</td>
                                        </tr> @endforeach
                                </tbody>
                            </table>
@elseif ($status == 'rejected')
<table class="table
    table-bordered thead-dark">
<thead>
    <tr>
        <th>S/N</th>
        <th>Student Name</th>
        <th>Registration</th>
        <th>Department</th>
        <th>Date Cleared</th>
        <th>Comment</th>
    </tr>
</thead>
<tbody>
    @foreach ($clearanceHistory as $index => $request)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $studentNames[$request->user_id] ?? 'N/A' }}</td>
            <td>{{ $registrationNumbers[$request->user_id] ?? 'N/A' }}</td>
            <td>{{ $departments[$request->user_id] ?? 'N/A' }}</td>
            <td>{{ $request->date_cleared->format('Y-m-d H:i:s') }}</td>
            <td>
                @if ($status == 'rejected' && $rejectionComments->has($request->id))
                    {{ $rejectionComments[$request->id] }}
                @else
                    N/A
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
</table>
@endif
@endif
</div>
</div>
</div>
</div>
</div>
</div>
</x-app-layout>
