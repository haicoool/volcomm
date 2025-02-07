@extends('layouts.app')

@section('title', 'Create Opportunity')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-center">Create New Event</h1>

    <form method="POST" action="{{ route('organization.store-opportunity') }}" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf
        <!-- Opportunity Title -->
        <div class="mb-4">
            <label for="oppTitle" class="block text-sm font-medium text-gray-600 mb-2">Event Title</label>
            <input type="text" name="oppTitle" id="oppTitle" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Opportunity Description -->
        <div class="mb-4">
            <label for="oppDesc" class="block text-sm font-medium text-gray-600 mb-2">Event Description</label>
            <textarea name="oppDesc" id="oppDesc" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>

        <!-- Location -->
        <div class="mb-4">
            <label for="oppLocation" class="block text-sm font-medium text-gray-600 mb-2">Location</label>
            <input type="text" name="oppLocation" id="oppLocation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label for="oppDate" class="block text-sm font-medium text-gray-600 mb-2">Date</label>
            <input type="date" name="oppDate" id="oppDate" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Time -->
        <div class="mb-4">
            <label for="oppTime" class="block text-sm font-medium text-gray-600 mb-2">Time</label>
            <input type="time" name="oppTime" id="oppTime" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Max Capacity -->
        <div class="mb-4">
            <label for="maxCapacity" class="block text-sm font-medium text-gray-600 mb-2">Max Capacity</label>
            <input type="number" name="maxCapacity" id="maxCapacity" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Required Qualification -->
        <div class="mb-4">
            <label for="reqQualification" class="block text-sm font-medium text-gray-600 mb-2">Required Qualification</label>
            <select name="reqQualification" id="reqQualification" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <!-- Required Skill -->
        <div class="mb-4">
            <label for="reqSkill" class="block text-sm font-medium text-gray-600 mb-2">Required Skill</label>
            <input type="text" name="reqSkill" id="reqSkill" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-2">Category</label>
            <div class="space-y-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="animal_welfare" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Animal Welfare</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="children" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Children</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="education" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Education</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="environment" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Environment</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="health" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Health</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="senior_citizens" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Senior Citizens</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="refugees" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Refugees</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="orang_asli" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Orang Asli</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="volunteerism" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Volunteerism</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="homeless_support" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Homeless Support</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="category" value="food" class="form-radio text-blue-600 focus:ring-blue-500" required>
                    <span class="ml-2">Food</span>
                </label>
            </div>
        </div>

        <!-- Opportunity Image -->
        <div class="mb-6">
            <label for="oppImage" class="block text-sm font-medium text-gray-600 mb-2">Opportunity Image</label>
            <input type="file" name="oppImage" id="oppImage" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="previewImage(event)">
            <img id="imagePreview" class="mt-4 w-full h-auto rounded-lg" style="display: none;">
        </div>

        <script>
            function previewImage(event) {
                const input = event.target;
                const reader = new FileReader();
                reader.onload = function() {
                    const dataURL = reader.result;
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = dataURL;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        </script>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                Create Opportunity
            </button>
        </div>
    </form>

    <script>
        // Get today's date in 'YYYY-MM-DD' format
        const today = new Date().toISOString().split('T')[0];

        // Set the min attribute for the date input to today's date
        document.getElementById("oppDate").setAttribute('min', today);
    </script>
@endsection
