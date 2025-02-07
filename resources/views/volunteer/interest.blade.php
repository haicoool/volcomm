<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Interests</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <style>
        /* Background styling */
        .register-bg {
            background: url('{{ asset("storage/bg-vol.png") }}') no-repeat center center;
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

        /* Tooltip styling */
        .tooltip {
            display: none;
            position: absolute;
            z-index: 10;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 6px;
            border-radius: 4px;
            font-size: 12px;
        }

        .group:hover .tooltip {
            display: block;
        }
    </style>
</head>
<body class="register-bg relative flex items-center justify-center min-h-screen">
<div class="overlay"></div>

<!-- Registration Form Container -->
<div class="z-10 w-full max-w-xl bg-white p-8 rounded-lg shadow-lg relative">
    <h2 class="text-3xl font-extrabold text-center mb-6 text-gray-800">Select Your Interests</h2>

    <form method="POST" action="{{ route('volunteer.updateInterest') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-4">Choose your interests:</label>
            <div class="grid grid-cols-2 gap-4">
                <!-- Interest Checkboxes with Tooltip -->
                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="animal_welfare" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Animal Welfare</span>
                    <div class="tooltip">Support animal care and protection efforts.</div>
                </label>

                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="children" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Children</span>
                    <div class="tooltip">Help improve the lives of children.</div>
                </label>

                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="education" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Education</span>
                    <div class="tooltip">Support educational causes.</div>
                </label>

                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="environment" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Environment</span>
                    <div class="tooltip">Protect and preserve the environment.</div>
                </label>

                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="health" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Health</span>
                    <div class="tooltip">Promote healthcare and well-being.</div>
                </label>

                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="senior_citizens" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Senior Citizens</span>
                    <div class="tooltip">Help improve the lives of the elderly.</div>
                </label>

                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="refugees" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Refugees</span>
                    <div class="tooltip">Support refugee assistance efforts.</div>
                </label>

                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="orang_asli" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Orang Asli</span>
                    <div class="tooltip">Support Orang Asli communities.</div>
                </label>

                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="volunteerism" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Volunteerism</span>
                    <div class="tooltip">Promote community volunteer activities.</div>
                </label>

                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="homeless_support" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Homeless Support</span>
                    <div class="tooltip">Help with homeless support initiatives.</div>
                </label>

                <label class="inline-flex items-center group relative">
                    <input type="checkbox" name="interests[]" value="food" class="form-checkbox rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2">Food</span>
                    <div class="tooltip">Assist with food distribution efforts.</div>
                </label>
            </div>
        </div>

        <!-- Button with enhanced hover and active effects -->
        <div class="flex justify-center mt-8">
            <button type="submit" class="bg-blue-600 text-white px-5 py-3 rounded-full font-semibold shadow-lg transition hover:bg-blue-700 focus:ring focus:ring-blue-300 active:bg-blue-800">
                Save Interests
            </button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>
</html>
