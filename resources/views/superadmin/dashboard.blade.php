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
                        Admins</a>
                </div>

                <!-- Main Content -->
                <div class="w-3/4 p-4">
                    <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ __('Welcome to your Super Admin Dashboard!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
