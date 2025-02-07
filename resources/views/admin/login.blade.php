<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen relative">

<!-- Background Image with Opacity -->
<div class="absolute inset-0 bg-cover bg-center opacity-80" style="background-image: url('https://wallpapercave.com/wp/wp2508287.jpg');"></div>

<div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 relative">
    <!-- Back Button -->
    <a href="{{ route('home') }}" class="absolute top-4 left-4 text-gray-600 hover:text-gray-800 transition duration-200">
        <i class="fas fa-arrow-left text-lg"></i>
    </a>

    <h1 class="text-3xl font-bold mb-6 text-center">Admin Login</h1>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-4">
            <label for="adminEmail" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="adminEmail" id="adminEmail" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('adminEmail')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="adminPass" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="adminPass" id="adminPass" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('adminPass')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-200">Login</button>
    </form>
</div>
<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
