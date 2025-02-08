<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Organization</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
    <style>
        /* Background styling */
        {{--.register-bg {--}}
        {{--    background: url('{{ Storage::disk('s3')->url('volcomm/public/bg-org.png') }}') no-repeat center center;--}}
        {{--    background-size: cover;--}}
        {{--}--}}

        .overlay {
            background: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        /* Logo styling */
        .logo {
            width: 150px; /* Adjust the width as needed */
            height: auto;
            position: absolute;
            top: 20px; /* Adjust the top margin as needed */
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center register-bg relative">
<div class="overlay"></div>

<!-- Logo -->
<img src="{{ asset('storage/volcomm-logo.png') }}" alt="Logo" class="logo">

<!-- Registration Form Container -->
<div class="z-10 w-full max-w-lg bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Register Organization</h1>

    <!-- Display success or error messages -->
    @if(session('warning'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('warning') }}
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

    <!-- Registration Form -->
    <form method="POST" action="{{ route('organization.register') }}">
        @csrf

        <!-- Organization Name -->
        <div class="mb-4">
            <label for="organizationName" class="block text-sm font-medium text-gray-700">Organization Name</label>
            <input type="text" name="organizationName" id="organizationName"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Organization Email -->
        <div class="mb-4">
            <label for="organizationEmail" class="block text-sm font-medium text-gray-700">Organization Email</label>
            <input type="email" name="organizationEmail" id="organizationEmail"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="organizationPass" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="organizationPass" id="organizationPass"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="organizationPass_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="organizationPass_confirmation" id="organizationPass_confirmation"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- About the Organization -->
        <div class="mb-6">
            <label for="organizationAbout" class="block text-sm font-medium text-gray-700">About the Organization</label>
            <textarea name="organizationAbout" id="organizationAbout"
                      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <!-- Buttons: Back and Register -->
        <div class="flex justify-between">
            <!-- Back Button -->
            <a href="{{ url()->previous() }}"
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 focus:outline-none focus:ring focus:border-gray-300">
                Back
            </a>

            <!-- Register Button -->
            <button type="submit"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Register
            </button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
