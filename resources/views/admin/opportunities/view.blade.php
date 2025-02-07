@extends('layouts.admin-app')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6 text-center">View Opportunity</h1>

            <!-- Opportunity Details -->
            <div class="space-y-4">
                <p><strong>Title:</strong> {{ $opportunity->oppTitle }}</p>
                <p><strong>Description:</strong> {{ $opportunity->oppDesc }}</p>

                @if($opportunity->oppImage)
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $opportunity->oppImage) }}" alt="{{ $opportunity->oppTitle }}" class="w-full max-w-md mx-auto rounded-lg shadow-md">
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                    <p><strong>Location:</strong> {{ $opportunity->oppLocation }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($opportunity->oppDate)->format('Y-m-d') }}</p>
                    <p><strong>Time:</strong> {{ $opportunity->oppTime }}</p>
                    <p><strong>Required Skills:</strong> {{ $opportunity->reqSkill }}</p>
                    <p class="col-span-full"><strong>Additional Info:</strong> {{ $opportunity->oppDesc }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('admin.opportunities.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Back
                </a>
                <form action="{{ route('opportunities.destroy', $opportunity->oppId) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this opportunity?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
