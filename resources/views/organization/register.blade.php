<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Organization</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
    <!-- Include Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Background styling */
        .register-bg {
            background: url('{{ Storage::disk('s3')->url('public/bg-org.png') }}') no-repeat center center;
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

        /* Logo styling */
        .logo {
            width: 100px; /* Smaller logo */
            height: auto;
            position: absolute;
            top: 20px; /* Adjust the top margin as needed */
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }

        /* Form container styling */
        .form-container {
            max-height: 90vh; /* Fixed height to fit the screen */
            overflow-y: auto; /* Enable scrolling if content overflows */
            padding: 1rem; /* Reduced padding */
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

<!-- Logo -->
<img src="{{ Storage::disk('s3')->url('public/volcomm-logo.png') }}" alt="Logo" class="logo">

<!-- Registration Form Container -->
<div class="z-10 w-full max-w-md bg-white rounded-lg shadow-lg form-container">
    <h1 class="text-2xl font-bold mb-4 text-center">Register Organization</h1>

    <!-- Display success or error messages -->
    @if(session('warning'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-3 py-2 rounded relative mb-3 text-sm" role="alert">
            {{ session('warning') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded relative mb-3 text-sm" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Registration Form -->
    <form method="POST" action="{{ route('organization.register') }}" class="space-y-3 px-4">
        @csrf

        <!-- Organization Name -->
        <div>
            <label for="organizationName" class="block text-sm font-medium text-gray-700">Organization Name</label>
            <input type="text" name="organizationName" id="organizationName"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                   required>
        </div>

        <!-- Organization Email -->
        <div>
            <label for="organizationEmail" class="block text-sm font-medium text-gray-700">Organization Email</label>
            <input type="email" name="organizationEmail" id="organizationEmail"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                   required>
        </div>

        <!-- Password -->
        <div>
            <label for="organizationPass" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="organizationPass" id="organizationPass"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                   required>
            <!-- Password Requirements -->
            <div id="password-requirements" class="mt-2 text-sm text-gray-600 space-y-1">
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
        <div>
            <label for="organizationPass_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="organizationPass_confirmation" id="organizationPass_confirmation"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                   required>
            <div id="confirm-password-validation" class="validation-message"></div>
        </div>

        <!-- About the Organization -->
        <div>
            <label for="organizationAbout" class="block text-sm font-medium text-gray-700">About the Organization</label>
            <textarea name="organizationAbout" id="organizationAbout"
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
        </div>

        <!-- Buttons: Back and Register -->
        <div class="flex justify-between pt-4">
            <!-- Back Button -->
            <a href="{{ url()->previous() }}"
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 focus:outline-none focus:ring focus:border-gray-300 text-sm">
                Back
            </a>

            <!-- Register Button -->
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300 text-sm">
                Register
            </button>
        </div>
    </form>
</div>

<script>
    // Password validation
    const passwordInput = document.getElementById('organizationPass');
    const confirmPasswordInput = document.getElementById('organizationPass_confirmation');
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
