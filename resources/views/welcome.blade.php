<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volcomm</title>
    <link rel="icon" type="image/x-icon" href="https://i.ibb.co/zN95Zm9/Untitled-design.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        rel="stylesheet"
        as="style"
        onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?display=swap&family=Plus+Jakarta+Sans:wght@400;500;700;800&family=Noto+Sans:wght@400;500;700;900"
    />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const images = [
                "https://cdn.solssmart.org/uploads/world-vision.jpg",
                "https://admin.jirehshope.com/wp-content/uploads/2018/02/15068954_10153426781862706_7498064568728848941_o.jpg",
                "https://kecharasoupkitchen.com/wp-content/uploads/2023/06/IMG_9175c.jpeg"
            ];
            let currentIndex = 0;
            const carouselContainer = document.querySelector('.carousel-container');

            function updateSlide() {
                carouselContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
                carouselContainer.style.transition = 'transform 1s ease-in-out';
            }

            setInterval(() => {
                currentIndex = (currentIndex + 1) % images.length;
                updateSlide();
            }, 3000);

            // Dropdown functionality
            const dropdownButtons = document.querySelectorAll('.dropdown-button');
            dropdownButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const dropdownMenu = this.nextElementSibling;
                    const allDropdownMenus = document.querySelectorAll('.dropdown-menu');
                    allDropdownMenus.forEach(menu => {
                        if (menu !== dropdownMenu) {
                            menu.classList.add('hidden');
                        }
                    });
                    dropdownMenu.classList.toggle('hidden');
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function (event) {
                if (!event.target.matches('.dropdown-button')) {
                    const dropdownMenus = document.querySelectorAll('.dropdown-menu');
                    dropdownMenus.forEach(menu => {
                        if (!menu.classList.contains('hidden')) {
                            menu.classList.add('hidden');
                        }
                    });
                }
            });
        });
    </script>
    <style>
        .carousel-wrapper {
            overflow: hidden; /* Removed scrollbar */
            position: relative;
            width: 100%;
            height: 100vh; /* Ensure the carousel takes up the full viewport height */
        }
        .carousel-container {
            display: flex;
            transition: transform 1s ease-in-out;
            width: 300%; /* 100% width per image * number of images */
        }
        .carousel-slide {
            flex: 0 0 100%; /* Take up 100% width of the wrapper */
            background-size: cover; /* Ensure the picture fits the screen */
            background-position: center;
            height: 100vh; /* Ensure each slide takes up the full viewport height */
        }
        .carousel-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 10;
        }
        .dropdown-menu a:hover {
            background-color: #333; /* Change the background color on hover */
        }
    </style>
</head>
<body class="relative min-h-screen flex flex-col overflow-x-hidden" style='font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f2f4] px-10 py-4 bg-black">
            <div class="flex items-center gap-4 text-white">
                <div class="size-4">
                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px">
                        <path d="M13.8261 17.4264C16.7203 18.1174 20.2244 18.5217 24 18.5217C27.7756 18.5217 31.2797 18.1174 34.1739 17.4264C36.9144 16.7722 39.9967 15.2331 41.3563 14.1648L24.8486 40.6391C24.4571 41.267 23.5429 41.267 23.1514 40.6391L6.64374 14.1648C8.00331 15.2331 11.0856 16.7722 13.8261 17.4264Z" fill="currentColor"></path>
                    </svg>
                </div>
                <h2 class="text-white text-lg font-bold leading-tight tracking-[-0.015em]">Volcomm</h2>
            </div>
            <nav class="flex gap-8 text-sm font-semibold text-white ml-10 pr-[6cm]"> <!-- Increased padding-right to 6cm here -->
                <div class="relative">
                    <button class="dropdown-button hover:text-[#1980e6]">Volunteer</button>
                    <div class="dropdown-menu absolute hidden bg-black shadow-lg border border-gray-200 rounded-md mt-2 min-w-[160px] z-20">
                        <a href="{{ route('volunteer.login') }}" class="block px-4 py-2 hover:bg-gray-100 text-white">Login</a>
                        <a href="{{ route('volunteer.register') }}" class="block px-4 py-2 hover:bg-gray-100 text-white">Register</a>
                    </div>
                </div>
                <div class="relative">
                    <button class="dropdown-button hover:text-[#1980e6]">Organization</button>
                    <div class="dropdown-menu absolute hidden bg-black shadow-lg border border-gray-200 rounded-md mt-2 min-w-[160px] z-20">
                        <a href="{{ route('organization.login') }}" class="block px-4 py-2 hover:bg-gray-100 text-white">Login</a>
                        <a href="{{ route('organization.register') }}" class="block px-4 py-2 hover:bg-gray-100 text-white">Register</a>
                    </div>
                </div>
                <div class="relative">
                    <button class="dropdown-button hover:text-[#1980e6]">Admin</button>
                    <div class="dropdown-menu absolute hidden bg-black shadow-lg border border-gray-200 rounded-md mt-2 min-w-[160px] z-20">
                        <a href="{{ route('admin.login') }}" class="block px-4 py-2 hover:bg-gray-100 text-white">Login</a>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Background Carousel Section -->
        <div class="relative flex-1 flex justify-center items-center overflow-hidden carousel-wrapper">
            <div class="carousel-container">
                <div class="carousel-slide" style='background-image: url("https://cdn.solssmart.org/uploads/world-vision.jpg");'></div>
                <div class="carousel-slide" style='background-image: url("https://admin.jirehshope.com/wp-content/uploads/2018/02/15068954_10153426781862706_7498064568728848941_o.jpg");'></div>
                <div class="carousel-slide" style='background-image: url("https://kecharasoupkitchen.com/wp-content/uploads/2023/06/IMG_9175c.jpeg");'></div>
            </div>
            <div class="carousel-content">
                <h1 class="text-3xl md:text-5xl font-bold tracking-[-0.02em] leading-tight typing-effect mb-4" data-text="Volunteering made easy">Volunteering made easy</h1>
                <p class="text-sm md:text-lg font-bold mt-2 typing-effect" data-text="Find and create meaningful projects that help you make an impact">Find and create meaningful projects that help you make an impact</p>
                <style>
                    .typing-effect {
                        overflow: hidden;
                        border-right: .15em solid white;
                        white-space: nowrap;
                        margin: 0 auto;
                        letter-spacing: .15em;
                        animation: typing 3.5s steps(40, end), blink-caret .75s step-end infinite;
                    }

                    @keyframes typing {
                        from { width: 0 }
                        to { width: 100% }
                    }

                    @keyframes blink-caret {
                        from, to { border-color: transparent }
                        50% { border-color: white; }
                    }
                </style>
            </div>
        </div>
    </div>
</body>
</html>
