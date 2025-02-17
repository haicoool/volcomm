<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Volunteer Login</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center relative bg-gray-100">

<!-- Background Image with Opacity -->
<div class="absolute inset-0 bg-cover bg-center opacity-90" style="background-image: url('{{ Storage::disk('s3')->url('public/bg-volunteer.jpg') }}');"></div>

<div class="max-w-lg w-full bg-white p-8 rounded-lg shadow-lg relative transform transition-all duration-500 hover:scale-105">
    <!-- Back to home button -->
    <a href="{{ route('home') }}" class="absolute top-4 left-4 text-blue-600 hover:text-blue-800 flex items-center space-x-2">
        <i class="fas fa-arrow-left text-xl"></i>
    </a>

    <!-- Page Title -->
    <h2 class="text-4xl font-extrabold text-center text-gray-700 mb-6">Volunteer Login</h2>

    <!-- Error Message Section -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('volunteer.login') }}">
        @csrf
        <!-- Email Input -->
        <div class="mb-5">
            <label for="vEmail" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="vEmail" id="vEmail" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your email" required>
        </div>

        <!-- Password Input -->
        <div class="mb-6">
            <label for="vPass" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="vPass" id="vPass" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your password" required>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit" class="w-full px-4 py-2 text-white bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg hover:from-blue-600 hover:to-purple-700 focus:ring-4 focus:ring-blue-300 transform transition-all duration-300 hover:scale-105">
                Login
            </button>
        </div>

        <!-- Forgot Password Link -->
        <div class="text-center mt-4">
            <a href="{{ route('volunteer.password.request') }}" class="text-blue-500 hover:underline">Forgot Password?</a>
        </div>
    </form>

    <!-- Registration Link -->
    <div class="text-center mt-6">
        <p class="text-sm">Don't have an account?
            <a href="{{ route('volunteer.register') }}" class="text-blue-500 hover:underline">Register here</a>
        </p>
    </div>
</div>

<!-- Flowbite JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

</body>
</html>
