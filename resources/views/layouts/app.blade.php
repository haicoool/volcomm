<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Organization Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="min-h-screen bg-blue-300">
<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-blue-200 shadow-md h-screen flex flex-col justify-between fixed">
        <div>
            <div class="p-6">
                <div class="flex items-center space-x-4">
                    <!-- Profile Picture Section -->
                    <div class="w-20 h-20">
                        <!-- Ensure the image is circular with larger size and darker hover effect -->
                        <img src="{{ Storage::disk('s3')->url(Auth::guard('organization')->user()->logo) }}" alt="Profile Picture"
                             class="w-20 h-20 rounded-full shadow bg-white object-cover">
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold">Hi, {{ Auth::guard('organization')->user()->organizationName }}</h2>
                        <!-- Debugging output for organizationId -->
{{--                        <p class="text-sm text-gray-500">Organization ID: {{ Auth::guard('organization')->user()->organizationId }}</p>--}}
                    </div>
                </div>
            </div>
            <nav class="mt-8">
                <ul class="space-y-2">
                    <!-- Listed Opportunity -->
                    <li>
                        <a href="{{ route('organization.dashboard') }}"
                           class="block py-2 px-4 text-gray-700 hover:bg-blue-300 hover:text-blue-900 rounded-md flex items-center space-x-2">
                            <i class="fas fa-list"></i>
                            <span>Listed Event</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('organization.edit-profile') }}"
                           class="block py-2 px-4 text-gray-700 hover:bg-blue-300 hover:text-blue-900 rounded-md flex items-center space-x-2">
                            <i class="fas fa-edit"></i>
                            <span>Edit Profile</span>
                        </a>
                    </li>

                    <!-- Create Opportunity -->
                    <li>
                        <a href="{{ route('organization.create-opportunity') }}"
                           class="block py-2 px-4 text-gray-700 hover:bg-blue-300 hover:text-blue-900 rounded-md flex items-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Create Event</span>
                        </a>
                    </li>

                    <!-- Confirm Attendance -->
                    <li>
                        <a href="{{ route('attendance.confirm') }}"
                           class="block py-2 px-4 text-gray-700 hover:bg-blue-300 hover:text-blue-900 rounded-md flex items-center space-x-2" aria-label="Confirm Attendance">
                            <i class="fas fa-check-circle"></i>
                            <span>Confirm Attendance</span>
                        </a>
                    </li>

                    <!-- Validate Registration -->
                    <li>
                        <a href="{{ route('organization.validate-registration') }}"
                           class="block py-2 px-4 text-gray-700 hover:bg-blue-300 hover:text-blue-900 rounded-md flex items-center space-x-2">
                            <i class="fas fa-check"></i>
                            <span>Validate Registration</span>
                        </a>
                    </li>

                    <!-- Gen cert -->
                    <li>
                        <a href="{{ route('certificates.pastOpportunities') }}"
                           class="block py-2 px-4 text-gray-700 hover:bg-blue-300 hover:text-blue-900 rounded-md flex items-center space-x-2">
                            <i class="fas fa-certificate"></i>
                            <span>Generate Certificate</span>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li>
                        <form method="POST" action="{{ route('organization.logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block py-2 px-4 text-gray-700 hover:bg-red-300 hover:text-red-900 rounded-md w-full text-left flex items-center space-x-2">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="p-6 text-center text-sm text-gray-500">
            &copy; 2025 Volcomm Platform
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 ml-64 bg-blue-300">
        @yield('content')
    </div>
</div>
</body>
</html>
