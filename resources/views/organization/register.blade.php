<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Organization</title>
    <!-- Add Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white shadow-md rounded-lg p-8 max-w-lg w-full relative">

    <!-- Back Icon to Home Page -->
    <a href="{{ route('home') }}" class="absolute top-4 left-4 text-blue-600 hover:text-blue-800">
        <i class="fas fa-arrow-left text-2xl"></i>
    </a>

    <h1 class="text-3xl font-bold mb-6 text-center">Register Organization</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('organization.register') }}">
        @csrf

        <div class="mb-4">
            <label for="organizationName" class="block text-sm font-medium text-gray-700">Organization Name</label>
            <input type="text" name="organizationName" id="organizationName" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="organizationEmail" class="block text-sm font-medium text-gray-700">Organization Email</label>
            <input type="email" name="organizationEmail" id="organizationEmail" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="organizationPass" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="organizationPass" id="organizationPass" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="organizationPass_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="organizationPass_confirmation" id="organizationPass_confirmation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-6">
            <label for="organizationAbout" class="block text-sm font-medium text-gray-700">About the Organization</label>
            <textarea name="organizationAbout" id="organizationAbout" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Register</button>
    </form>
</div>

</body>
</html>
