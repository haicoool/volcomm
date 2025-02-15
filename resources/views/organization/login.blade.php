<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Organization Login</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Flowbite CSS -->
    <link href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="h-screen flex items-center justify-center relative bg-gray-100">

<!-- Background Image with Opacity -->
<div class="absolute inset-0 bg-cover bg-center opacity-80" style="background-image: url('{{ Storage::disk('s3')->url('public/bg-organization.jpg') }}');"></div>

<!-- Login Form Container -->
<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md relative transform transition-transform hover:scale-105 duration-500 ease-in-out">

    <!-- Back to Home Button -->
    <a href="{{ route('home') }}" class="absolute top-4 left-4 text-blue-600 hover:text-blue-800 flex items-center space-x-2">
        <i class="fas fa-arrow-left text-2xl"></i>
    </a>

    <!-- Page Title -->
    <h1 class="text-4xl font-extrabold text-center mb-6 text-gray-700">Organization Login</h1>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('organization.login') }}">
        @csrf
        <!-- Email Field -->
        <div class="mb-4">
            <label for="organizationEmail" class="block text-sm font-medium text-gray-700">Organization Email</label>
            <input type="email" name="organizationEmail" id="organizationEmail" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
        </div>

        <!-- Password Field -->
        <div class="mb-6">
            <label for="organizationPass" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="organizationPass" id="organizationPass" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-2 px-4 rounded-lg hover:bg-gradient-to-l hover:from-pink-500 hover:to-purple-500 transition duration-300">
            Login
        </button>
    </form>

    <!-- Registration Link -->
    <div class="text-center mt-6">
        <p class="text-sm">Don't have an account?
            <a href="{{ route('organization.register') }}" class="text-blue-500 hover:underline">Register here</a>
        </p>
    </div>

    <!-- Forgot Password Link -->
    <div class="text-center mt-4">
        <a href="{{ route('organization.forgot-password') }}" class="text-blue-500 hover:underline">Forgot Password?</a>
    </div>

</div>

<!-- Flowbite JS -->
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.js"></script>

</body>
</html>
