@extends('layouts.admin-app')

@section('content')
    <div class="p-6 bg-gray-800 text-white rounded-lg shadow-lg max-w-lg mx-auto">
        <h1 class="text-2xl font-semibold mb-6">Edit Admin</h1>

        <form method="POST" action="{{ route('admin.update', $admin->adminId) }}">
            @csrf

            <!-- Admin Name -->
            <div class="mb-4">
                <label for="adminName" class="block text-white">Admin Name</label>
                <input type="text" name="adminName" id="adminName" value="{{ $admin->adminName }}"
                       class="border border-gray-600 rounded w-full p-2 bg-gray-700 text-white focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <!-- Admin Email -->
            <div class="mb-4">
                <label for="adminEmail" class="block text-white">Admin Email</label>
                <input type="email" name="adminEmail" id="adminEmail" value="{{ $admin->adminEmail }}"
                       class="border border-gray-600 rounded w-full p-2 bg-gray-700 text-white focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <!-- Dummy New Password Field -->
            <div class="mb-4">
                <label for="newPassword" class="block text-white">New Password</label>
                <input type="password" name="newPassword" id="newPassword"
                       class="border border-gray-600 rounded w-full p-2 bg-gray-700 text-white focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter new password">
            </div>

            <!-- Dummy Confirm New Password Field -->
            <div class="mb-6">
                <label for="confirmNewPassword" class="block text-white">Confirm New Password</label>
                <input type="password" name="confirmNewPassword" id="confirmNewPassword"
                       class="border border-gray-600 rounded w-full p-2 bg-gray-700 text-white focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Confirm new password">
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-300 w-full">
                Update Admin
            </button>
        </form>
    </div>
@endsection
