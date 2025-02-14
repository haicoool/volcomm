<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Registration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
    <!-- Include Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

        /* Password validation messages */
        .validation-message {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .validation-message.valid {
            color: green;
        }

        .validation-message.invalid {
            color: red;
        }

        /* Landscape layout */
        .landscape-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .landscape-form .full-width {
            grid-column: span 2;
        }

        /* Icon styling */
        .icon {
            margin-right: 0.5rem;
        }

        .icon.valid {
            color: green;
        }

        .icon.invalid {
            color: red;
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center register-bg relative">
<div class="overlay"></div>

<!-- Registration Form Container -->
<div class="z-10 w-full max-w-4xl bg-white rounded-lg shadow-lg p-8">
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
    <form method="POST" action="{{ route('volunteer.register') }}" enctype="multipart/form-data" class="landscape-form">
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
        <div class="mb-4 full-width">
            <label for="vPass" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="vPass" id="vPass"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
            <!-- Password Requirements -->
            <div id="password-requirements" class="mt-2 text-sm text-gray-600">
                <div class="flex items-center" id="uppercase-requirement">
                    <span class="icon invalid"><i class="fas fa-times"></i></span>
                    <span>At least one uppercase letter</span>
                </div>
                <div class="flex items-center" id="number-requirement">
                    <span class="icon invalid"><i class="fas fa-times"></i></span>
                    <span>At least one number</span>
                </div>
                <div class="flex items-center" id="symbol-requirement">
                    <span class="icon invalid"><i class="fas fa-times"></i></span>
                    <span>At least one symbol</span>
                </div>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4 full-width">
            <label for="vPass_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="vPass_confirmation" id="vPass_confirmation"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   required>
            <div id="confirm-password-validation" class="validation-message"></div>
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
        <div class="mb-4 full-width">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                   for="vQualification">Qualifications (Upload multiple files)</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="vQualification" name="vQualification[]" type="file" multiple>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between full-width">
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

<script>
    // Password validation
    const passwordInput = document.getElementById('vPass');
    const confirmPasswordInput = document.getElementById('vPass_confirmation');
    const confirmPasswordValidation = document.getElementById('confirm-password-validation');

    // Password requirement elements
    const uppercaseRequirement = document.getElementById('uppercase-requirement');
    const numberRequirement = document.getElementById('number-requirement');
    const symbolRequirement = document.getElementById('symbol-requirement');

    passwordInput.addEventListener('input', () => {
        const password = passwordInput.value;

        // Check for uppercase letter
        const hasUppercase = /[A-Z]/.test(password);
        const uppercaseIcon = uppercaseRequirement.querySelector('.icon i');
        uppercaseIcon.classList.toggle('fa-check', hasUppercase);
        uppercaseIcon.classList.toggle('fa-times', !hasUppercase);
        uppercaseRequirement.querySelector('.icon').classList.toggle('valid', hasUppercase);
        uppercaseRequirement.querySelector('.icon').classList.toggle('invalid', !hasUppercase);

        // Check for number
        const hasNumber = /[0-9]/.test(password);
        const numberIcon = numberRequirement.querySelector('.icon i');
        numberIcon.classList.toggle('fa-check', hasNumber);
        numberIcon.classList.toggle('fa-times', !hasNumber);
        numberRequirement.querySelector('.icon').classList.toggle('valid', hasNumber);
        numberRequirement.querySelector('.icon').classList.toggle('invalid', !hasNumber);

        // Check for symbol
        const hasSymbol = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
        const symbolIcon = symbolRequirement.querySelector('.icon i');
        symbolIcon.classList.toggle('fa-check', hasSymbol);
        symbolIcon.classList.toggle('fa-times', !hasSymbol);
        symbolRequirement.querySelector('.icon').classList.toggle('valid', hasSymbol);
        symbolRequirement.querySelector('.icon').classList.toggle('invalid', !hasSymbol);
    });

    confirmPasswordInput.addEventListener('input', () => {
        const confirmPassword = confirmPasswordInput.value;

        // Only validate if the confirm password field is not empty
        if (confirmPassword.trim() !== '') {
            if (confirmPassword === passwordInput.value) {
                confirmPasswordValidation.textContent = 'Passwords match.';
                confirmPasswordValidation.classList.remove('invalid');
                confirmPasswordValidation.classList.add('valid');
            } else {
                confirmPasswordValidation.textContent = 'Passwords do not match.';
                confirmPasswordValidation.classList.remove('valid');
                confirmPasswordValidation.classList.add('invalid');
            }
        } else {
            // Clear the validation message if the field is empty
            confirmPasswordValidation.textContent = '';
            confirmPasswordValidation.classList.remove('valid', 'invalid');
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
