@extends('layouts.volunteer-app')

@section('content')

    <!-- Heading -->
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Explore Opportunities</h1>
    
    <!-- Search Bar -->
    <div class="mb-6 flex justify-center items-center space-x-4">
        <form method="GET" action="{{ route('volunteer.dashboard') }}" class="flex items-center w-full max-w-md">
            <input type="text" name="search" placeholder="Search opportunities..." 
                   class="border border-indigo-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm rounded-lg px-4 py-2 mr-2 w-full"
                   value="{{ request('search') }}">
            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition duration-200">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    
    <!-- Filter Buttons -->
    <div class="mb-6 flex justify-center space-x-2">
        <form method="GET" action="{{ route('volunteer.dashboard') }}">
            <button type="submit" name="filter" value="all" 
                    class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition duration-200">
                All
            </button>
        </form>
        <form method="GET" action="{{ route('volunteer.dashboard') }}">
            <button type="submit" name="filter" value="interests" 
                    class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition duration-200">
                Based on Interests
            </button>
        </form>
    </div>
    
    <!-- Opportunities List -->
    <div class="space-y-8">
        @forelse ($opportunities as $opportunity)
            <div class="relative bg-white border border-gray-200 shadow-lg rounded-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="p-8 flex space-x-8">
                    <!-- Image and Category Badge -->
                    <div class="relative flex-shrink-0">
                        <img src="{{ asset('storage/' . $opportunity->oppImage) }}" alt="{{ $opportunity->oppTitle }}" class="w-48 h-48 object-cover rounded-md">
                        <span class="absolute top-4 left-4 bg-indigo-100 text-indigo-700 text-base font-semibold py-2 px-4 rounded-full">
                            {{ $opportunity->category ?? 'General' }}
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-indigo-800 mb-4">{{ $opportunity->oppTitle }}</h2>
                        <p class="text-gray-600 text-base mb-4">{{ Str::limit($opportunity->oppDesc, 200) }}</p>
                        <div class="text-indigo-500 text-base space-y-2 mb-6">
                            <p><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($opportunity->oppDate)->format('F j, Y') }}</p>
                            <p><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($opportunity->oppTime)->format('g:i A') }}</p>
                        </div>
                        <a href="{{ route('opportunities.show', $opportunity->oppId) }}" class="bg-indigo-500 text-white py-3 px-6 rounded-lg text-base hover:bg-indigo-600 transition duration-200">
                            More Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 italic text-center">No opportunities available right now. Check back later!</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $opportunities->appends(request()->query())->links('pagination::tailwind') }}
    </div>
@endsection
