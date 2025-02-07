@extends('layouts.app')

@section('title', 'Generate Certificate')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Generate Certificates</h1>

    <!-- Form for generating certificates -->
    <form action="{{ route('certificates.bulk_generate') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @foreach ($registrations as $registration)
            <input type="hidden" name="registrations[]" value="{{ $registration->regId }}">
        @endforeach

        <!-- Logo Upload -->
        <div class="mb-6">
            <label for="logo" class="block text-sm font-medium text-gray-700">Organization Logo</label>
            <input type="file" name="logo" id="logo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required accept="image/*" onchange="previewImage(event, 'logoPreview')">
            <img id="logoPreview" class="mt-4 hidden w-48 h-48 object-cover rounded-md" />
        </div>

        <!-- Signature Upload -->
        <div class="mb-6">
            <label for="signature" class="block text-sm font-medium text-gray-700">Signature</label>
            <input type="file" name="signature" id="signature" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required accept="image/*" onchange="previewImage(event, 'signaturePreview')">
            <img id="signaturePreview" class="mt-4 hidden w-48 h-48 object-cover rounded-md" />
        </div>

        <!-- Signer Name -->
        <div class="mb-6">
            <label for="signerName" class="block text-sm font-medium text-gray-700">Signer Name</label>
            <input type="text" name="signerName" id="signerName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Signer Position -->
        <div class="mb-6">
            <label for="signerPosition" class="block text-sm font-medium text-gray-700">Signer Position</label>
            <input type="text" name="signerPosition" id="signerPosition" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Generate Certificates
            </button>
        </div>
    </form>
</div>

<!-- Image Preview JavaScript -->
<script>
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function() {
            const previewImage = document.getElementById(previewId);
            previewImage.src = reader.result;
            previewImage.classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
