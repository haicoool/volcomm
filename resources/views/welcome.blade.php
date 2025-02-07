<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VolComm</title>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
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

        /* Marquee Section Styling */
        .marquee {
            background-color: #1f2937; /* Matches the site theme */
            display: flex;
            overflow-x: hidden;
            white-space: nowrap;
            height: 150px;
            align-items: center;
            border-top: 2px solid #2d3748; /* Optional divider */
            border-bottom: 2px solid #2d3748;
        }

        .marquee-content {
            display: flex;
            flex-shrink: 0;
            animation: marquee-scroll 20s linear infinite;
        }

        .marquee-block {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 2rem;
        }

        .marquee-logo {
            filter: grayscale(1) contrast(0.7);
            height: 80px;
            transition: all 0.3s ease;
        }

        .marquee-block:hover .marquee-logo {
            filter: grayscale(0);
            transform: scale(1.1);
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
<header
    class="sticky top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-gray-900 to-gray-800 rounded-full shadow-lg z-20 px-8 py-3 w-fit">
    <div class="flex items-center space-x-8">
        <div class="flex items-center space-x-2">
            <i class="fi fi-sr-volunteer-vest text-white text-2xl"></i>
            <h1 class="text-2xl font-bold text-white hover:text-gray-400 transition duration-300">Volcomm</h1>
        </div>
        <nav>
            <ul class="flex space-x-6 items-center">
                <!-- Register Dropdown -->
                <li>
                    <button id="dropdownRegister" data-dropdown-toggle="dropdownRegisterMenu"
                            class="flex items-center justify-between w-full py-2 px-3 text-white hover:text-gray-300 rounded md:hover:bg-transparent md:border-0 md:p-0 md:w-auto focus:outline-none">
                        Register
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownRegisterMenu"
                         class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownRegister">
                            <li>
                                <a href="{{ route('volunteer.register') }}"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Volunteer</a>
                            </li>
                            <li>
                                <a href="{{ route('organization.register') }}"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Organization</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Login Dropdown -->
                <li>
                    <button id="dropdownLogin" data-dropdown-toggle="dropdownLoginMenu"
                            class="flex items-center justify-between w-full py-2 px-3 text-white hover:text-gray-300 rounded md:hover:bg-transparent md:border-0 md:p-0 md:w-auto focus:outline-none">
                        Login
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownLoginMenu"
                         class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLogin">
                            <li>
                                <a href="{{ route('volunteer.login') }}"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Volunteer</a>
                            </li>
                            <li>
                                <a href="{{ route('organization.login') }}"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Organization</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.login') }}"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Admin</a>
                            </li>
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
        <h2 class="text-6xl font-extrabold leading-tight mb-6 text-gray-100">
            Empower Communities <br /> Through Volunteerism
        </h2>
        <p class="text-xl text-gray-400">
            Join a local movement to inspire, connect, and create lasting impact. Together, we make a difference.
        </p>
    </div>
</section>

<!-- Full-Screen Carousel Section -->
<section id="carousel" class="relative flex items-center justify-center">
    <div class="relative w-full max-w-4xl h-96 mx-auto overflow-hidden rounded-lg shadow-lg">
        <!-- Slide 1 -->
        <div class="absolute inset-0 opacity-0 duration-1000 ease-in-out transition-opacity" data-carousel-item>
            <img src="https://cdn.solssmart.org/uploads/world-vision.jpg"
                 class="block w-full h-full object-cover rounded-lg" alt="Volunteering Image 1">
        </div>
        <!-- Slide 2 -->
        <div class="absolute inset-0 opacity-0 duration-1000 ease-in-out transition-opacity" data-carousel-item>
            <img src="https://admin.jirehshope.com/wp-content/uploads/2018/02/15068954_10153426781862706_7498064568728848941_o.jpg"
                 class="block w-full h-full object-cover rounded-lg" alt="Volunteering Image 2">
        </div>
        <!-- Slide 3 -->
        <div class="absolute inset-0 opacity-0 duration-1000 ease-in-out transition-opacity" data-carousel-item>
            <img src="https://kecharasoupkitchen.com/wp-content/uploads/2023/06/IMG_9175c.jpeg"
                 class="block w-full h-full object-cover rounded-lg" alt="Volunteering Image 3">
        </div>
    </div>
</section>

<script>
    // Auto-rotating carousel logic
    const carouselItems = document.querySelectorAll('[data-carousel-item]');
    let currentIndex = 0;

    function showNextSlide() {
        // Hide current slide
        carouselItems[currentIndex].classList.remove('opacity-100');
        carouselItems[currentIndex].classList.add('opacity-0');

        // Move to the next slide
        currentIndex = (currentIndex + 1) % carouselItems.length;

        // Show the next slide
        carouselItems[currentIndex].classList.remove('opacity-0');
        carouselItems[currentIndex].classList.add('opacity-100');
    }

    // Start auto-rotating every 5 seconds
    setInterval(showNextSlide, 5000);

    // Initialize the first slide as visible
    carouselItems[currentIndex].classList.add('opacity-100');
</script>

<section class="py-12">
    <div class="container mx-auto text-center mt-4">
        <h3 class="text-4xl font-extrabold text-gray-100 mb-4">Organizations Registered With Us</h3>
        <p class="text-lg text-gray-400">
            We are proud to collaborate with local organizations that share our mission of making a lasting impact.
        </p>
    </div>
</section>

<!-- Marquee Section -->
<section class="marquee">
    <div class="marquee-content">
        <a class="marquee-block">
            <img class="marquee-logo" src="https://teachformalaysia.org/wp-content/uploads/2022/06/TFM_logo_red.png" alt="Forbes Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://kecharasoupkitchen.com/wp-content/uploads/2022/08/logo-w.png" alt="Inc Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://www.theworldkindnessmovement.org/wp-content/uploads/2020/06/rep2.jpg" alt="National Geographic Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://res.cloudinary.com/mercymalaysia/image/upload/v1679454605/logo-trace_akgqya.png" alt="Red Cross Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://www.wikiimpact.com/wp-content/uploads/2022/02/hopes.png" alt="Discovery Channel Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://d2yy7txqjmdbsq.cloudfront.net/social/ac390ce4-c8f2-4c5f-be93-1d8fee9b0dbe/logo_cropped_logo_FA_KembaraLogo.png" alt="REI Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://cdn.store-assets.com/s/921568/f/10900110.png" alt="Fortune Logo">
        </a>
    </div>
    <div class="marquee-content">
        <a class="marquee-block">
            <img class="marquee-logo" src="https://teachformalaysia.org/wp-content/uploads/2022/06/TFM_logo_red.png" alt="Forbes Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://kecharasoupkitchen.com/wp-content/uploads/2022/08/logo-w.png" alt="Inc Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://www.theworldkindnessmovement.org/wp-content/uploads/2020/06/rep2.jpg" alt="National Geographic Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://res.cloudinary.com/mercymalaysia/image/upload/v1679454605/logo-trace_akgqya.png" alt="Red Cross Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://www.wikiimpact.com/wp-content/uploads/2022/02/hopes.png" alt="Discovery Channel Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://d2yy7txqjmdbsq.cloudfront.net/social/ac390ce4-c8f2-4c5f-be93-1d8fee9b0dbe/logo_cropped_logo_FA_KembaraLogo.png" alt="REI Logo">
        </a>
        <a class="marquee-block">
            <img class="marquee-logo" src="https://cdn.store-assets.com/s/921568/f/10900110.png" alt="Fortune Logo">
        </a>
    </div>
</section>


<!-- About Section -->
<section id="about" class="py-16">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12">
            <div class="fade-in-up">
                <h3 class="text-4xl font-bold text-white mb-6">Why Volunteer?</h3>
                <p class="text-lg text-gray-300 leading-relaxed">
                    Volunteering strengthens communities and creates opportunities for personal growth. At Volcomm, we help
                    you connect with causes you care about and make an impact.
                </p>
            </div>
            <div>
                <div class="grid grid-cols-1 gap-6">
                    <div
                        class="p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-md hover-scale transition duration-300">
                        <h4 class="text-xl font-bold text-white mb-3">Make an Impact</h4>
                        <p class="text-gray-300">Be part of initiatives that leave a lasting legacy.</p>
                    </div>
                    <div
                        class="p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-md hover-scale transition duration-300">
                        <h4 class="text-xl font-bold text-white mb-3">Build Connections</h4>
                        <p class="text-gray-300">Meet like-minded individuals and build meaningful relationships.</p>
                    </div>
                    <div
                        class="p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-md hover-scale transition duration-300">
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
        <p class="text-gray-400">&copy; 2025 Volcomm. All rights reserved.</p>
    </div>
</footer>
</body>

</html>
