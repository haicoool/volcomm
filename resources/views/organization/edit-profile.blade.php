@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Profile</h2>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('organization.update-profile') }}" method="POST" enctype="multipart/form-data" id="editProfileForm">
            @csrf

            <!-- Organization Name -->
            <div class="mb-4">
                <label class="block text-gray-700">Organization Name</label>
                <input type="text" name="organizationName" value="{{ old('organizationName', $organization->organizationName) }}" class="border rounded w-full py-2 px-3 focus:ring focus:ring-blue-300" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="organizationEmail" value="{{ old('organizationEmail', $organization->organizationEmail) }}" class="border rounded w-full py-2 px-3 focus:ring focus:ring-blue-300" required>
            </div>

            <!-- About -->
            <div class="mb-4">
                <label class="block text-gray-700">About</label>
                <textarea name="organizationAbout" class="border rounded w-full py-2 px-3 focus:ring focus:ring-blue-300" required>{{ old('organizationAbout', $organization->organizationAbout) }}</textarea>
            </div>

            <!-- Upload Logo -->
            <div class="mb-4">
                <label class="block text-gray-700">Logo</label>
                @if($organization->logo)
                    <img src="{{ asset('storage/' . $organization->logo) }}" alt="Organization Logo" class="mb-2 h-20 rounded">
                @endif
                <input type="file" name="logo" class="border rounded w-full py-2 px-3 focus:ring focus:ring-blue-300">
            </div>

            <!-- Password Section -->
            <div class="mb-4">
                <label class="block text-gray-700">New Password</label>
                <input type="password" name="password" class="border rounded w-full py-2 px-3 focus:ring focus:ring-blue-300" placeholder="Leave blank to keep current password">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" class="border rounded w-full py-2 px-3 focus:ring focus:ring-blue-300" placeholder="Leave blank to keep current password">
            </div>

            <!-- Update Button -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-200">Update Profile</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const form = document.getElementById('editProfileForm');

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update your profile?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        </script>
    @endpush
@endsection
