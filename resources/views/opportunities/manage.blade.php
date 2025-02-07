@extends('layouts.app')

@section('title', 'Manage Opportunity')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <!-- Opportunity Title -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">{{ $opportunity->oppTitle }}</h1>

        <!-- Opportunity Image -->
        @if($opportunity->oppImage)
            <div class="mb-8 text-center">
                <img src="{{ asset('storage/' . $opportunity->oppImage) }}" alt="{{ $opportunity->oppTitle }}" class="w-full max-w-lg mx-auto rounded-lg shadow-md">
            </div>
        @endif

        <!-- Opportunity Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10 p-6 bg-gray-50 rounded-lg shadow-sm">
            <div class="space-y-4">
                <p class="text-lg"><strong>Location:</strong> {{ $opportunity->oppLocation }}</p>
                <p class="text-lg"><strong>Date:</strong> {{ \Carbon\Carbon::parse($opportunity->oppDate)->format('F j, Y') }}</p>
                <p class="text-lg"><strong>Time:</strong> {{ \Carbon\Carbon::parse($opportunity->oppTime)->format('h:i A') }}</p>
                <p class="text-lg"><strong>Required Skills:</strong> {{ $opportunity->reqSkill }}</p>
            </div>
            <div class="space-y-4">
                <p class="text-lg font-semibold">Description:</p>
                <p class="text-gray-600">{{ $opportunity->oppDesc }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center mb-10">
            <!-- Edit Opportunity -->
            <a href="{{ route('opportunities.edit', $opportunity->oppId) }}" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center transition ease-in-out duration-150">
                Edit Event
            </a>

            <!-- Delete Opportunity -->
            <form action="{{ route('opportunities.destroy', $opportunity->oppId) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this opportunity?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center transition ease-in-out duration-150">
                    Delete Event
                </button>
            </form>
        </div>

        <!-- Registered Volunteers Section -->
        <div class="p-6 bg-gray-50 rounded-lg shadow-sm">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Registered Volunteers</h2>

            @if($volunteers->isEmpty())
                <p class="text-gray-500">No volunteers have registered for this opportunity yet.</p>
            @else
                <ul class="space-y-4">
                    @foreach ($volunteers as $volunteer)
                        <li class="text-lg text-gray-700">
                            <span class="font-semibold">{{ $loop->iteration }}. {{ $volunteer->vName }}</span>
                            <a href="mailto:{{ $volunteer->email }}" class="ml-2 text-blue-500 hover:underline">{{ $volunteer->email }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
