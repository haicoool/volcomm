<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Registration</title>
    <!-- TailwindCSS CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Flowbite CSS for additional components -->
    <link href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" rel="stylesheet">
    <!-- Font Awesome for icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg relative">

    <!-- Back Icon to Home Page -->
    <a href="{{ route('home') }}" class="absolute top-4 left-4 text-blue-600 hover:text-blue-800">
        <i class="fas fa-arrow-left text-2xl"></i>
    </a>

    <h2 class="text-3xl font-bold text-center mb-8">Volunteer Registration</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('volunteer.register') }}" enctype="multipart/form-data">
        @csrf
        <!-- Full Name -->
        <div class="mb-4">
            <label for="vName" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="vName" id="vName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="vEmail" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="vEmail" id="vEmail" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="vPass" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="vPass" id="vPass" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="vPass_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="vPass_confirmation" id="vPass_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Volunteer Skill -->
        <div class="mb-4">
            <label for="vSkill" class="block text-sm font-medium text-gray-700">Skill</label>
            <input type="text" name="vSkill" id="vSkill" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Profile Picture -->
        <div class="mb-4">
            <label for="vProfilepic" class="block text-sm font-medium text-gray-700">Profile Picture</label>
            <input type="file" name="vProfilepic" id="vProfilepic" accept="image/*" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Qualification (Multiple Files) -->
        <div class="mb-4">
            <label for="vQualification" class="block text-sm font-medium text-gray-700">Qualifications (Upload multiple files)</label>
            <input type="file" name="vQualification[]" id="vQualification" multiple class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300">
                Register
            </button>
        </div>
    </form>
</div>

<!-- Flowbite JS for additional components -->
<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
</body>
</html>
