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
                <input type="text" name="oppTitle" id="oppTitle" value="{{ old('oppTitle', $opportunity->oppTitle) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('oppTitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Opportunity Description -->
            <div class="mb-4">
                <label for="oppDesc" class="block text-sm font-medium text-gray-600 mb-2">Opportunity Description</label>
                <textarea name="oppDesc" id="oppDesc" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('oppDesc', $opportunity->oppDesc) }}</textarea>
                @error('oppDesc') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="oppLocation" class="block text-sm font-medium text-gray-600 mb-2">Location</label>
                <input type="text" name="oppLocation" id="oppLocation" value="{{ old('oppLocation', $opportunity->oppLocation) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('oppLocation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Date -->
            <div class="mb-4">
                <label for="oppDate" class="block text-sm font-medium text-gray-600 mb-2">Date</label>
                <input type="date" name="oppDate" id="oppDate" value="{{ old('oppDate', $opportunity->oppDate) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('oppDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Time -->
            <div class="mb-4">
                <label for="oppTime" class="block text-sm font-medium text-gray-600 mb-2">Time</label>
                <input type="time" name="oppTime" id="oppTime" value="{{ old('oppTime', $opportunity->oppTime) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('oppTime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Max Capacity -->
            <div class="mb-4">
                <label for="maxCapacity" class="block text-sm font-medium text-gray-600 mb-2">Max Capacity</label>
                <input type="number" name="maxCapacity" id="maxCapacity" value="{{ old('maxCapacity', $opportunity->maxCapacity) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('maxCapacity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Required Qualification -->
            <div class="mb-4">
                <label for="reqQualification" class="block text-sm font-medium text-gray-600 mb-2">Required Qualification</label>
                <select name="reqQualification" id="reqQualification" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="1" {{ old('reqQualification', $opportunity->reqQualification) == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('reqQualification', $opportunity->reqQualification) == 0 ? 'selected' : '' }}>No</option>
                </select>
                @error('reqQualification') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Required Skill -->
            <div class="mb-4">
                <label for="reqSkill" class="block text-sm font-medium text-gray-600 mb-2">Required Skill</label>
                <input type="text" name="reqSkill" id="reqSkill" value="{{ old('reqSkill', $opportunity->reqSkill) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('reqSkill') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-600 mb-2">Category</label>
                <div class="space-y-2">
                    @foreach(['animal_welfare', 'children', 'education', 'environment', 'health', 'senior_citizens', 'refugees', 'orang_asli', 'volunteerism', 'homeless_support', 'food'] as $category)
                        <label class="inline-flex items-center">
                            <input type="radio" name="category" value="{{ $category }}" class="form-radio text-blue-600 focus:ring-blue-500" {{ old('category', $opportunity->category) == $category ? 'checked' : '' }} required>
                            <span class="ml-2">{{ ucwords(str_replace('_', ' ', $category)) }}</span>
                        </label>
                    @endforeach
                </div>
                @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Opportunity Image -->
            <div class="mb-6">
                <label for="oppImage" class="block text-sm font-medium text-gray-600 mb-2">Opportunity Image</label>
                <input type="file" name="oppImage" id="oppImage" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="previewImage(event)">
                @if($opportunity->oppImage)
                    <!-- Display image from S3 -->
                    <img src="{{ Storage::disk('s3')->url($opportunity->oppImage) }}" alt="Current Image" class="mt-2 w-32 h-32 object-cover">
                @endif
                <img id="imagePreview" class="mt-4 w-full h-auto rounded-lg" style="display: none;">
            </div>

        </div>

        <script>
            // Preview uploaded image
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
@endsection
