@extends('layouts.admin-app')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-100">Add New Admin</h1>

        <!-- Form Container -->
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="{{ route('admin.add') }}">
                @csrf
                
                <!-- Admin Name Field -->
                <div class="mb-6">
                    <label for="adminName" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="adminName" id="adminName" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('adminName')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Admin Email Field -->
                <div class="mb-6">
                    <label for="adminEmail" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="adminEmail" id="adminEmail" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('adminEmail')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Admin Password Field -->
                <div class="mb-6">
                    <label for="adminPass" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="adminPass" id="adminPass" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('adminPass')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-6">
                    <label for="adminPass_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="adminPass_confirmation" id="adminPass_confirmation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('adminPass_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-6 flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Add Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
