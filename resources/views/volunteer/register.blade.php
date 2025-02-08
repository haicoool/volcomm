<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Registration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
    <style>
        /* Background styling */
        .register-bg {
            background: url('{{ Storage::disk('s3')->url('public/bg-vol.png') }}') no-repeat center center;
            background-size: cover;
        }

        .overlay {
            background: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        /* Logo inside the form container */
        .logo {
            width: 150px; /* Adjust the width as needed */
            height: auto;
            margin-bottom: 20px; /* Adds space below the logo */
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center register-bg relative">
<div class="overlay"></div>

<!-- Registration Form Container -->
<div class="z-10 w-full max-w-lg bg-white rounded-lg shadow-lg p-8">
    <!-- Logo inside the form -->
    <img src="{{ Storage::disk('s3')->url('public/volcomm-logo.png') }}" alt="Logo" class="logo">

    <h2 class="text-3xl font-bold text-center mb-8">Volunteer Registration</h2>

    <!-- Errors Display -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Registration Form -->
    <form method="POST" action="{{ route('volunteer.register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Full Name -->
        <div class="mb-4">
            <label for="vName" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="vName" id="vName"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="vEmail" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="vEmail" id="vEmail"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="vPass" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="vPass" id="vPass"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="vPass_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="vPass_confirmation" id="vPass_confirmation"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Volunteer Skill -->
        <div class="mb-4">
            <label for="vSkill" class="block text-sm font-medium text-gray-700">Skill</label>
            <input type="text" name="vSkill" id="vSkill"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Profile Picture -->
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="vProfilepic">Profile
                Picture</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="vProfilepic" name="vProfilepic" type="file" accept="image/*">
        </div>

        <!-- Qualification (Multiple Files) -->
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                   for="vQualification">Qualifications (Upload multiple files)</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="vQualification" name="vQualification[]" type="file" multiple>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between">
            <!-- Back Button -->
            <a href="{{ url()->previous() }}"
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 focus:outline-none focus:ring focus:border-gray-300">
                Back
            </a>

            <!-- Register Button -->
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300">
                Register
            </button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
