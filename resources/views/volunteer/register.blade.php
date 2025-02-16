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
            width: 100px; /* Smaller logo */
            height: auto;
            margin-bottom: 10px; /* Reduced space below the logo */
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

        /* Form container styling */
        .form-container {
            max-height: 90vh; /* Fixed height to fit the screen */
            overflow-y: auto; /* Enable scrolling if content overflows */
            padding: 1rem; /* Reduced padding */
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center register-bg relative">
<div class="overlay"></div>

<!-- Registration Form Container -->
<div class="z-10 w-full max-w-md bg-white rounded-lg shadow-lg form-container">
    <!-- Logo inside the form -->
    <img src="{{ Storage::disk('s3')->url('public/volcomm-logo.png') }}" alt="Logo" class="logo">

    <h2 class="text-2xl font-bold text-center mb-4">Volunteer Registration</h2>

    <!-- Errors Display -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded relative mb-3 text-sm" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Registration Form -->
    <form method="POST" action="{{ route('volunteer.register') }}" enctype="multipart/form-data" class="space-y-3 px-4">
        @csrf

        <!-- Full Name -->
        <div>
            <label for="vName" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="vName" id="vName"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                   required>
        </div>

        <!-- Email -->
        <div>
            <label for="vEmail" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="vEmail" id="vEmail"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                   required>
        </div>

        <!-- Password -->
        <div>
            <label for="vPass" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="vPass" id="vPass"
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
            <label for="vPass_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="vPass_confirmation" id="vPass_confirmation"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                   required>
            <div id="confirm-password-validation" class="validation-message"></div>
        </div>

        <!-- Volunteer Skill -->
        <div>
            <label for="vSkill" class="block text-sm font-medium text-gray-700">Skill</label>
            <input type="text" name="vSkill" id="vSkill"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
        </div>

        <!-- Profile Picture -->
        <div>
            <label class="block text-sm font-medium text-gray-700" for="vProfilepic">Profile Picture</label>
            <input id="vProfilepic" type="file" accept="image/*">
            <button type="button" id="uploadProfilePic">Upload Profile Picture</button>
            <input type="hidden" name="vProfilepic" id="profilePicPath">
            <p class="mt-1 text-sm text-gray-500">Max file size: 10MB (JPEG, PNG, JPG, GIF).</p>
        </div>

        <!-- Qualification (Multiple Files) -->
        <div>
            <label class="block text-sm font-medium text-gray-700" for="vQualification">Qualifications</label>
            <input id="vQualification" type="file" multiple>
            <button type="button" id="uploadQualifications">Upload Qualifications</button>
            <input type="hidden" name="vQualification" id="qualificationPaths">
            <p class="mt-1 text-sm text-gray-500">Max file size per file: 10MB (PDF, DOC, DOCX, ZIP, JPEG, PNG, JPG, GIF).</p>
        </div>


        <!-- Submit Button -->
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

<script>
    document.getElementById('uploadProfilePic').addEventListener('click', async () => {
        const fileInput = document.getElementById('vProfilepic');
        if (fileInput.files.length === 0) return alert('Select a file first!');

        const file = fileInput.files[0];

        // Get Presigned URL from Laravel
        const response = await fetch('/api/s3-presigned-url', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ filename: file.name, filetype: file.type })
        });

        const { url } = await response.json();

        // Upload to S3
        const uploadResponse = await fetch(url, {
            method: 'PUT',
            body: file,
            headers: { 'Content-Type': file.type },
        });

        if (uploadResponse.ok) {
            document.getElementById('profilePicPath').value = url.split('?')[0]; // Store file URL in input field
            alert('Profile picture uploaded!');
        } else {
            alert('Upload failed!');
        }
    });

    document.getElementById('uploadQualifications').addEventListener('click', async () => {
        const fileInput = document.getElementById('vQualification');
        if (fileInput.files.length === 0) return alert('Select at least one file!');

        let uploadedPaths = [];

        for (const file of fileInput.files) {
            const response = await fetch('/api/s3-presigned-url', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ filename: file.name, filetype: file.type })
            });

            const { url } = await response.json();

            const uploadResponse = await fetch(url, {
                method: 'PUT',
                body: file,
                headers: { 'Content-Type': file.type },
            });

            if (uploadResponse.ok) {
                uploadedPaths.push(url.split('?')[0]); // Store file URLs
            }
        }

        document.getElementById('qualificationPaths').value = JSON.stringify(uploadedPaths);
        alert('Qualifications uploaded!');
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
