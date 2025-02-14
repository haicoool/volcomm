<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Volunteer Dashboard')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flaticon (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Flowbite CSS -->
    <link href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Additional styles if necessary -->
    @stack('styles')

</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<!-- Main Wrapper (use flex to stretch full height) -->
<div class="flex flex-1">

    <!-- Sidebar Navigation (full height) -->
    <div class="w-64 bg-[#F3EAFB] shadow-md min-h-screen pt-8 border-r border-gray-200">
        <!-- User Profile Section -->
        @if(Auth::check())
            <div class="flex items-center space-x-4 px-6 mb-6">
                <img src="{{ Storage::disk('s3')->url(Auth::user()->vProfilepic) }}" alt="Profile Picture" class="w-12 h-12 rounded-full shadow">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Hi, {{ Auth::user()->vName }}</h2>
                </div>
            </div>
        @endif

        <!-- Divider -->
        <div class="border-t border-gray-200 mb-4 mx-6"></div>

        <!-- Navigation Links with Icons -->
        <nav class="mt-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('volunteer.dashboard') }}" class="flex items-center space-x-3 py-2 px-6 text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition duration-300 ease-in-out rounded-md {{ request()->routeIs('volunteer.dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : '' }}">
                        <i class="fas fa-search text-gray-500 {{ request()->routeIs('volunteer.dashboard') ? 'text-blue-700' : '' }}"></i>
                        <span>Explore Volunteer Events</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('volunteer.edit-profile') }}" class="flex items-center space-x-3 py-2 px-6 text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition duration-300 ease-in-out rounded-md {{ request()->routeIs('volunteer.edit-profile') ? 'bg-blue-100 text-blue-700 font-semibold' : '' }}">
                        <i class="fas fa-user-edit text-gray-500 {{ request()->routeIs('volunteer.edit-profile') ? 'text-blue-700' : '' }}"></i>
                        <span>Edit Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('volunteer.view-history') }}" class="flex items-center space-x-3 py-2 px-6 text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition duration-300 ease-in-out rounded-md {{ request()->routeIs('volunteer.view-history') ? 'bg-blue-100 text-blue-700 font-semibold' : '' }}">
                        <i class="fas fa-history text-gray-500 {{ request()->routeIs('volunteer.view-history') ? 'text-blue-700' : '' }}"></i>
                        <span>Registered Events</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('volunteer.certificates') }}" class="flex items-center space-x-3 py-2 px-6 text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition duration-300 ease-in-out rounded-md {{ request()->routeIs('volunteer.certificates') ? 'bg-blue-100 text-blue-700 font-semibold' : '' }}">
                        <i class="fas fa-certificate text-gray-500 {{ request()->routeIs('volunteer.certificates') ? 'text-blue-700' : '' }}"></i>
                        <span>View Certificates</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('volunteer.logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 w-full text-left py-2 px-6 text-gray-600 hover:bg-red-100 hover:text-red-700 transition duration-300 ease-in-out rounded-md">
                            <i class="fas fa-sign-out-alt text-gray-500 hover:text-red-700"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Additional padding for end spacing -->
        <div class="p-6 text-center text-sm text-gray-500">
            &copy; 2025 Volcomm Platform
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 bg-[#FAF5FF]">
        @yield('content')
    </div>

</div>

<!-- Flowbite and Tailwind scripts -->
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.js"></script>



</body>
</html>
