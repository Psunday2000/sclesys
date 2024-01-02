<!-- resources/views/student/view-data.blade.php -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/font-awesome.min.css"
        integrity="sha384-dp1f8a0WNAAK8onE6YOEC1SdqWl5vlSV3auuknHuMXYz5FfjsNQfAFH52r1Gt3" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('student.dashboard') }}" class="block text-blue-500 hover:text-blue-700">
                {{ __('Student Dashboard') }}</a>
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

                    <!-- Student Links -->
                    <h3 class="font-semibold text-lg mt-4 mb-2">Actions</h3>
                    <a href="{{ route('student.clearance-phase') }}" class="block text-blue-500 hover:text-blue-700">
                        Phases</a>
                    <a href="{{ route('student.clearance-history', ['status' => 'approved']) }}"
                        class="block text-blue-500 hover:text-blue-700">Approved Phases</a>
                    <a href="{{ route('student.clearance-history', ['status' => 'rejected']) }}"
                        class="block text-blue-500 hover:text-blue-700">Rejected Phases</a>
                    <a href="{{ route('student.view-data', auth()->user()->id) }}"
                        class="block text-blue-500 hover:text-blue-700">
                        Data</a>
                </div>

                <!-- Main Content -->
                <div class="w-3/4 p-4">
                    <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="container">
                                <strong><h2>Submitted Data</h2></strong>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Key</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($unitSpecificData as $key => $value)
                                            <tr>
                                                <td><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}</strong></td>
                                                <td>
                                                    @if (is_string($value) &&
                                                            (Str::endsWith($value, '.png') ||
                                                                Str::endsWith($value, '.jpg') ||
                                                                Str::endsWith($value, '.jpeg') ||
                                                                Str::endsWith($value, '.gif')))
                                                        <img style="max-width: 500px; height: auto;"
                                                            src="{{ asset('storage/' . $value) }}"
                                                            alt="{{ $key }}" class="img-fluid">
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                </td>
                                            </tr> @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
