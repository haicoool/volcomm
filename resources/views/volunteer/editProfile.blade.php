@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.volunteer-app')

@section('title', 'Edit Profile')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile, Manage Qualifications & Interests</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .hidden-section {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .visible-section {
            display: block;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }
        * {
            box-sizing: border-box;
        }
        :root {
            --switches-bg-color: indigo;
            --switches-label-color: white;
            --switch-bg-color: white;
            --switch-text-color: indigo;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 1rem;
            margin-left: auto;
            margin-right: auto;
            margin-top: 2%;
        }

        p {
            margin-top: 0.5rem;
            font-size: 0.85rem;
            text-align: center;
        }

        .switches-container {
            width: 100%;
            max-width: 600px;
            height: 2rem;
            position: relative;
            display: flex;
            padding: 0;
            background: var(--switches-bg-color);
            line-height: 2rem;
            border-radius: 2rem;
            margin-left: auto;
            margin-right: auto;
        }

        .switches-container input {
            visibility: hidden;
            position: absolute;
            top: 0;
        }

        .switches-container label {
            flex: 1;
            padding: 0;
            margin: 0;
            text-align: center;
            cursor: pointer;
            color: var(--switches-label-color);
        }

        .switch-wrapper {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 33.33%;
            padding: 0.1rem;
            z-index: 3;
            transition: transform .5s cubic-bezier(.77, 0, .175, 1);
        }

        .switch {
            border-radius: 2rem;
            background: var(--switch-bg-color);
            height: 100%;
        }

        .switch div {
            width: 100%;
            text-align: center;
            opacity: 0;
            display: block;
            color: var(--switch-text-color);
            transition: opacity .2s cubic-bezier(.77, 0, .175, 1) .125s;
            will-change: opacity;
            position: absolute;
            top: 0;
            left: 0;
        }

        .switches-container input:nth-of-type(1):checked~.switch-wrapper {
            transform: translateX(0%);
        }

        .switches-container input:nth-of-type(2):checked~.switch-wrapper {
            transform: translateX(100%);
        }

        .switches-container input:nth-of-type(3):checked~.switch-wrapper {
            transform: translateX(200%);
        }

        .switches-container input:nth-of-type(1):checked~.switch-wrapper .switch div:nth-of-type(1) {
            opacity: 1;
        }

        .switches-container input:nth-of-type(2):checked~.switch-wrapper .switch div:nth-of-type(2) {
            opacity: 1;
        }

        .switches-container input:nth-of-type(3):checked~.switch-wrapper .switch div:nth-of-type(3) {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
<h2 class="text-3xl font-bold text-center mt-8 text-gray-800">Edit Profile, Manage Qualifications & Interests</h2>

<!-- Toggle Switch - Moved outside of the form container -->
<div class="container">
    <div class="switches-container">
        <input type="radio" id="switchProfile" name="switchSection" value="Profile" checked="checked" onclick="showSection('editProfile')" />
        <input type="radio" id="switchQualifications" name="switchSection" value="Qualifications" onclick="showSection('manageQualifications')" />
        <input type="radio" id="switchInterests" name="switchSection" value="Interests" onclick="showSection('updateInterests')" />
        <label for="switchProfile">Edit Profile</label>
        <label for="switchQualifications">Manage Qualifications</label>
        <label for="switchInterests">Update Interests</label>
        <div class="switch-wrapper">
            <div class="switch">
                <div>Edit Profile</div>
                <div>Manage Qualifications</div>
                <div>Update Interests</div>
            </div>
        </div>
    </div>
    <p><small>Use the switch above to toggle sections.</small></p>
</div>

<!-- Main content - Forms and Sections -->
<div class="max-w-7xl mx-auto p-8 bg-white rounded-lg shadow-lg mt-8">
    <!-- Edit Profile Section -->
    <div id="editProfile" class="bg-white p-6 rounded-lg shadow visible-section">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">Edit Profile</h3>
        <form method="POST" action="{{ route('volunteer.update-profile') }}" enctype="multipart/form-data" onsubmit="handleUpdate(event)">
            @csrf
            <!-- Name -->
            <div class="mb-4">
                <label for="vName" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="vName" id="vName" value="{{ old('vName', $volunteer->vName) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Skill -->
            <div class="mb-4">
                <label for="vSkill" class="block text-sm font-medium text-gray-700">Skill</label>
                <input type="text" name="vSkill" id="vSkill" value="{{ old('vSkill', $volunteer->vSkill) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Profile Picture -->
            <div class="mb-4">
                <label for="vProfilepic" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                <input type="file" name="vProfilepic" id="vProfilepic" class="mt-1 block w-full">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition-all">
                    Update Profile
                </button>
            </div>
        </form>
    </div>

    <!-- Change Password Section -->
    <div id="changePassword" class="bg-white p-6 rounded-lg shadow hidden-section">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">Change Password</h3>
        <form method="POST" action="{{ route('volunteer.change-password') }}" onsubmit="handleUpdate(event)">
            @csrf
            <!-- Current Password -->
            <div class="mb-4">
                <label for="currentPassword" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input type="password" name="currentPassword" id="currentPassword" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- New Password -->
            <div class="mb-4">
                <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="newPassword" id="newPassword" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Confirm New Password -->
            <div class="mb-4">
                <label for="newPasswordConfirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="newPassword_confirmation" id="newPasswordConfirmation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition-all">
                    Change Password
                </button>
            </div>
        </form>
    </div>

    <!-- Manage Qualifications Section -->
    <div id="manageQualifications" class="bg-white p-6 rounded-lg shadow hidden-section">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">Manage Qualifications</h3>

        <!-- Current Qualifications -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Current Qualifications</label>
            @if($volunteer->vQualification)
                @foreach(json_decode($volunteer->vQualification) as $qualification)
                    <div class="flex items-center justify-between mb-2">
                        <!-- Construct the full S3 path and generate a public URL -->
                        @php
                            $fileUrl = Storage::disk('s3')->url($qualification); // Generate the public URL using the relative path
                        @endphp

                        <!-- Display file link -->
                        <a href="{{ $fileUrl }}" target="_blank" class="text-blue-500 hover:underline">{{ basename($qualification) }}</a>

                        <form action="{{ route('volunteer.remove-qualification') }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to remove this qualification?')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="qualification" value="{{ $qualification }}">
                            <button type="submit" class="text-red-500 text-sm">Remove</button>
                        </form>
                    </div>
                @endforeach
            @else
                <p>No qualifications uploaded.</p>
            @endif
        </div>


        <!-- Upload New Qualifications -->
        <form action="{{ route('volunteer.add-qualification') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Upload New Qualifications (optional)</label>
                <input type="file" name="vQualification[]" id="vQualification" multiple class="mt-1 block w-full border-gray-300 rounded-lg">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700">
                    Add Qualifications
                </button>
            </div>
        </form>
    </div>


    <!-- Update Interests Section -->
    <div id="updateInterests" class="bg-white p-6 rounded-lg shadow hidden-section">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">Update Interests</h3>

        <form method="POST" action="{{ route('volunteer.update-interests') }}" onsubmit="handleUpdate(event)">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">Choose your interests:</label>
                <div class="grid grid-cols-2 gap-4">
                    @php
                        $interests = ['animal_welfare', 'children', 'education', 'environment', 'health', 'senior_citizens', 'refugees', 'orang_asli', 'volunteerism', 'homeless_support', 'food'];
                        $selectedInterests = json_decode($volunteer->interest, true) ?? [];  // Decode interests from JSON
                    @endphp

                    @foreach ($interests as $interest)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="interests[]" value="{{ $interest }}" class="form-checkbox rounded text-blue-600 focus:ring-blue-500" @if (in_array($interest, $selectedInterests)) checked @endif>
                            <span class="ml-2 capitalize">{{ str_replace('_', ' ', $interest) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-8">
                <button type="submit" class="bg-indigo-500 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-300 transition-all">
                    Update Interest
                </button>
            </div>
        </form>
    </div>

</div>


<!-- JavaScript to toggle between sections and handle SweetAlert -->
<script>
    function showSection(section) {
        const sections = ['editProfile', 'manageQualifications', 'updateInterests'];
        sections.forEach(s => {
            document.getElementById(s).classList.remove('visible-section');
            document.getElementById(s).classList.add('hidden-section');
        });
        document.getElementById(section).classList.remove('hidden-section');
        document.getElementById(section).classList.add('visible-section');
    }

    // SweetAlert for form actions (Update)
    function handleUpdate(event) {
        event.preventDefault(); // Stop the form from submitting immediately
        const form = event.target; // Get the form that triggered the event

        Swal.fire({
            icon: 'success',
            title: 'Updated Successfully',
            text: 'Your changes have been saved!',
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            form.submit(); // Submit the form after SweetAlert is done
        });
    }

    // SweetAlert for adding qualifications (Add Qualification)
    function handleAdd(event) {
        event.preventDefault(); // Stop the form from submitting immediately
        const form = event.target; // Get the form that triggered the event

        Swal.fire({
            icon: 'success',
            title: 'Qualification Added',
            text: 'Your qualifications have been added!',
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            form.submit(); // Submit the form after SweetAlert is done
        });
    }

    // SweetAlert for deleting qualifications (Remove Qualification)
    function handleDelete(event) {
        event.preventDefault(); // Stop the form from submitting immediately
        const form = event.target; // Get the form that triggered the event

        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: 'You are about to remove this qualification!',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, remove it!',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit the form after SweetAlert is done
            }
        });
    }

    // Function to toggle the "Add Qualifications" button
    function toggleAddButton() {
        const fileInput = document.getElementById('vQualification');
        const addButton = document.getElementById('addQualificationButton');

        if (fileInput.files.length > 0) {
            addButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
            addButton.classList.add('bg-green-600', 'hover:bg-green-700', 'focus:ring-4', 'focus:ring-green-300');
            addButton.disabled = false;
        } else {
            addButton.classList.add('bg-gray-400', 'cursor-not-allowed');
            addButton.classList.remove('bg-green-600', 'hover:bg-green-700', 'focus:ring-4', 'focus:ring-green-300');
            addButton.disabled = true;
        }
    }
</script>

</body>
</html>
@endsection
