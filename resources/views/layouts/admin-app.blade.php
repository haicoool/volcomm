<!-- resources/views/layouts/admin-app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... existing head content ... -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-gray-300 shadow-lg">
            <div class="p-6 text-center border-b border-gray-700">
                <i class="fas fa-user-shield text-4xl text-blue-400 mb-2"></i>
                <h2 class="text-2xl font-semibold">Admin Panel</h2>
            </div>
            <nav class="mt-8 space-y-2 px-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-3 rounded-lg text-gray-300 transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
                @if(auth()->user()->adminEmail === 'admin@volcomm.com')
                    <a href="{{ route('admin.add.form') }}" class="flex items-center py-2 px-3 rounded-lg text-gray-300 transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.add.form') ? 'bg-gray-700 text-white' : '' }}">
                        <i class="fas fa-user-plus mr-3"></i>
                        <span>Add Admin</span>
                    </a>

                    <!-- Manage Admin (visible only for admin@volcomm.com) -->
                    <a href="{{ route('admin.manage') }}" class="flex items-center py-2 px-3 rounded-lg text-gray-300 transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.manage') ? 'bg-gray-700 text-white' : '' }}">
                        <i class="fas fa-user-cog mr-3"></i>
                        <span>Manage Admin</span>
                    </a>
                @endif
                <a href="{{ route('admin.volunteers.index') }}" class="flex items-center py-2 px-3 rounded-lg text-gray-300 transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.volunteers.index') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    <span>View Volunteers</span>
                </a>
                <a href="{{ route('admin.organizations.index') }}" class="flex items-center py-2 px-3 rounded-lg text-gray-300 transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.organizations.index') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-building mr-3"></i>
                    <span>View Organizations</span>
                </a>
                <a href="{{ route('admin.approved.organizations') }}" class="flex items-center py-2 px-3 rounded-lg text-gray-300 transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.approved.organizations') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span>Manage Organization Registrations</span>
                </a>
                <a href="{{ route('admin.opportunities.index') }}" class="flex items-center py-2 px-3 rounded-lg text-gray-300 transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.opportunities.index') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-briefcase mr-3"></i>
                    <span>Manage Event</span>
                </a>

                <form method="POST" action="{{ route('admin.logout') }}" class="mt-6">
                    @csrf
                    <button type="submit" class="flex items-center w-full py-2 px-3 rounded-lg text-gray-300 transition duration-200 hover:bg-red-700 hover:text-white">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
            <div class="p-6 text-center text-sm text-gray-500">
                &copy; 2025 Volcomm Platform
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1 bg-gray-800">
            @yield('content')
        </div>
    </div>

</body>
</html>
