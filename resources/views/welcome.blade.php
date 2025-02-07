<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VolComm</title>

    <!-- Load assets using Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }

        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        }

        @keyframes marquee-scroll {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }
    </style>
</head>

<body data-theme="none" class="bg-gradient-to-b from-gray-900 via-gray-800 to-black text-gray-100">

<!-- Sticky Navbar -->
<header class="sticky top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-gray-900 to-gray-800 rounded-full shadow-lg z-20 px-8 py-3 w-fit">
    <div class="flex items-center space-x-8">
        <h1 class="text-2xl font-bold text-white hover:text-gray-400 transition duration-300">VolComm</h1>
        <nav>
            <ul class="flex space-x-6 items-center">
                <!-- Register Dropdown -->
                <li>
                    <button id="dropdownRegister" data-dropdown-toggle="dropdownRegisterMenu"
                            class="flex items-center justify-between py-2 px-3 text-white hover:text-gray-300 rounded">
                        Register
                        <svg class="w-2.5 h-2.5 ms-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownRegisterMenu"
                         class="hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400">
                            <li><a href="{{ route('volunteer.register') }}" class="block px-4 py-2 hover:bg-gray-100">Volunteer</a></li>
                            <li><a href="{{ route('organization.register') }}" class="block px-4 py-2 hover:bg-gray-100">Organization</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Login Dropdown -->
                <li>
                    <button id="dropdownLogin" data-dropdown-toggle="dropdownLoginMenu"
                            class="flex items-center justify-between py-2 px-3 text-white hover:text-gray-300 rounded">
                        Login
                        <svg class="w-2.5 h-2.5 ms-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownLoginMenu"
                         class="hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400">
                            <li><a href="{{ route('volunteer.login') }}" class="block px-4 py-2 hover:bg-gray-100">Volunteer</a></li>
                            <li><a href="{{ route('organization.login') }}" class="block px-4 py-2 hover:bg-gray-100">Organization</a></li>
                            <li><a href="{{ route('admin.login') }}" class="block px-4 py-2 hover:bg-gray-100">Admin</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section class="relative text-center py-20">
    <div class="container mx-auto mt-10 fade-in-up">
        <h2 class="text-6xl font-extrabold leading-tight mb-6 text-gray-100">Empower Communities Through Volunteerism</h2>
        <p class="text-xl text-gray-400">Join a local movement to inspire, connect, and create lasting impact.</p>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-16">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12">
            <div class="fade-in-up">
                <h3 class="text-4xl font-bold text-white mb-6">Why Volunteer?</h3>
                <p class="text-lg text-gray-300">Volunteering strengthens communities and creates opportunities for personal growth.</p>
            </div>
            <div>
                <div class="grid grid-cols-1 gap-6">
                    <div class="p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-md hover-scale transition duration-300">
                        <h4 class="text-xl font-bold text-white mb-3">Make an Impact</h4>
                        <p class="text-gray-300">Be part of initiatives that leave a lasting legacy.</p>
                    </div>
                    <div class="p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-md hover-scale transition duration-300">
                        <h4 class="text-xl font-bold text-white mb-3">Build Connections</h4>
                        <p class="text-gray-300">Meet like-minded individuals and build meaningful relationships.</p>
                    </div>
                    <div class="p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-md hover-scale transition duration-300">
                        <h4 class="text-xl font-bold text-white mb-3">Develop Skills</h4>
                        <p class="text-gray-300">Enhance your personal and professional skills while giving back.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-6">
    <div class="container mx-auto text-center">
        <p class="text-gray-400">&copy; 2025 VolComm. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
