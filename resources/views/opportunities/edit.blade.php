@extends('layouts.app')

@section('title', 'Edit Opportunity')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-center">Edit Opportunity: {{ $opportunity->oppTitle }}</h1>

    <form action="{{ route('opportunities.update', $opportunity->oppId) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Opportunity Title -->
            <div class="mb-4">
                <label for="oppTitle" class="block text-sm font-medium text-gray-600 mb-2">Opportunity Title</label>
                <input type="text" name="oppTitle" id="oppTitle" value="{{ $opportunity->oppTitle }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Opportunity Description -->
            <div class="mb-4">
                <label for="oppDesc" class="block text-sm font-medium text-gray-600 mb-2">Opportunity Description</label>
                <textarea name="oppDesc" id="oppDesc" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $opportunity->oppDesc }}</textarea>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="oppLocation" class="block text-sm font-medium text-gray-600 mb-2">Location</label>
                <input type="text" name="oppLocation" id="oppLocation" value="{{ $opportunity->oppLocation }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Date -->
            <div class="mb-4">
                <label for="oppDate" class="block text-sm font-medium text-gray-600 mb-2">Date</label>
                <input type="date" name="oppDate" id="oppDate" value="{{ $opportunity->oppDate }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Time -->
            <div class="mb-4">
                <label for="oppTime" class="block text-sm font-medium text-gray-600 mb-2">Time</label>
                <input type="time" name="oppTime" id="oppTime" value="{{ $opportunity->oppTime }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Max Capacity -->
            <div class="mb-4">
                <label for="maxCapacity" class="block text-sm font-medium text-gray-600 mb-2">Max Capacity</label>
                <input type="number" name="maxCapacity" id="maxCapacity" value="{{ $opportunity->maxCapacity }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Required Qualification -->
            <div class="mb-4">
                <label for="reqQualification" class="block text-sm font-medium text-gray-600 mb-2">Required Qualification</label>
                <select name="reqQualification" id="reqQualification" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="1" {{ $opportunity->reqQualification ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$opportunity->reqQualification ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <!-- Required Skill -->
            <div class="mb-4">
                <label for="reqSkill" class="block text-sm font-medium text-gray-600 mb-2">Required Skill</label>
                <input type="text" name="reqSkill" id="reqSkill" value="{{ $opportunity->reqSkill }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-2">Category</label>
                <div class="space-y-2">
                    @foreach(['animal_welfare', 'children', 'education', 'environment', 'health', 'senior_citizens', 'refugees', 'orang_asli', 'volunteerism', 'homeless_support', 'food'] as $category)
                        <label class="inline-flex items-center">
                            <input type="radio" name="category" value="{{ $category }}" class="form-radio text-blue-600 focus:ring-blue-500" {{ $opportunity->category == $category ? 'checked' : '' }} required>
                            <span class="ml-2">{{ ucwords(str_replace('_', ' ', $category)) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Opportunity Image -->
            <div class="mb-6">
                <label for="oppImage" class="block text-sm font-medium text-gray-600 mb-2">Opportunity Image</label>
                <input type="file" name="oppImage" id="oppImage" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="previewImage(event)">
                @if($opportunity->oppImage)
                    <img src="{{ asset('storage/' . $opportunity->oppImage) }}" alt="Current Image" class="mt-2 w-32 h-32 object-cover">
                @endif
                <img id="imagePreview" class="mt-4 w-full h-auto rounded-lg" style="display: none;">
            </div>
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
        <div class="flex justify-center mt-4">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                Update Opportunity
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