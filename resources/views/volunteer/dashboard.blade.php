@extends('layouts.volunteer-app')

@section('content')

    <!-- Full-Width Main Container -->
    <div class="min-h-screen flex flex-col items-center">

        <!-- Content Container to Limit Width of Inner Content and Center It -->
        <div class="w-full max-w-6xl px-4 py-8">
            <!-- Header Section with Grid Layout -->
            <div class="grid grid-cols-3 items-center mb-8 gap-4">
                <!-- Title aligned on the left -->
                <h1 class="col-span-1 text-3xl font-bold text-gray-800">Explore Volunteer Events</h1>

                <!-- Empty Spacer for Center Alignment -->
                <div></div>

                <!-- Search and Filter Section on the Right -->
                <div class="col-span-2 flex space-x-4 items-center justify-end">
                    <!-- Search Bar -->
                    <form method="GET" action="{{ route('volunteer.dashboard') }}" class="flex items-center">
                        <input type="text" name="search" placeholder="Search events name..."
                               class="border border-indigo-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm rounded-lg px-4 py-2 w-56 mr-2 transition duration-200 ease-in-out transform focus:scale-105"
                               value="{{ request('search') }}">
                        <button type="submit" class="bg-indigo-500 text-white px-3 py-2 rounded-lg hover:bg-indigo-600 transition duration-200 ease-in-out transform hover:scale-105">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- Filter Buttons with Animation -->
                    <div class="flex space-x-2">
                        <form method="GET" action="{{ route('volunteer.dashboard') }}">
                            <button type="submit" name="filter" value="all"
                                    class="bg-indigo-500 text-white px-3 py-2 rounded-lg hover:bg-indigo-600 transition duration-200 ease-in-out transform hover:scale-105">
                                All
                            </button>
                        </form>
                        <form method="GET" action="{{ route('volunteer.dashboard') }}">
                            <button type="submit" name="filter" value="interests"
                                    class="bg-indigo-500 text-white px-3 py-2 rounded-lg hover:bg-indigo-600 transition duration-200 ease-in-out transform hover:scale-105">
                                Based on Interests
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Opportunities List -->
            <div class="space-y-6">
                @forelse ($opportunities as $opportunity)
                    <div class="relative bg-white border border-gray-200 shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                        <div class="p-6 flex space-x-6">
                            <!-- Image -->
                            <div class="relative flex-shrink-0">
                                <img src="{{ Storage::url($opportunity->oppImage) }}" alt="{{ $opportunity->oppTitle }}" class="w-40 h-40 object-cover rounded-md">
                            </div>
                            <!-- Content -->
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-indigo-700 mb-2">{{ $opportunity->oppTitle }}</h2>
                                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($opportunity->oppDesc, 150) }}</p>
                                <div class="text-indigo-500 text-sm space-y-1 mb-4">
                                    <p><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($opportunity->oppDate)->format('F j, Y') }}</p>
                                    <p><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($opportunity->oppTime)->format('g:i A') }}</p>
                                </div>
                                <a href="{{ route('opportunities.show', $opportunity->oppId) }}" class="bg-indigo-500 text-white py-2 px-4 rounded-lg text-sm hover:bg-indigo-600 transition duration-200 transform hover:scale-105">
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
            @if ($opportunities->hasPages())
                <nav class="mt-6 flex justify-center" aria-label="Page navigation">
                    <ul class="inline-flex space-x-2">
                        <!-- Previous Page Link -->
                        @if ($opportunities->onFirstPage())
                            <li class="px-3 py-2 text-gray-400 bg-gray-100 rounded-md">Previous</li>
                        @else
                            <li>
                                <a href="{{ $opportunities->previousPageUrl() }}" class="px-3 py-2 text-indigo-600 bg-white border rounded-md hover:bg-indigo-50 transition duration-200 transform hover:scale-105">
                                    Previous
                                </a>
                            </li>
                        @endif

                        <!-- Pagination Elements -->
                        @foreach ($opportunities->links()->elements[0] as $page => $url)
                            @if ($page == $opportunities->currentPage())
                                <li class="px-3 py-2 text-white bg-indigo-500 rounded-md">{{ $page }}</li>
                            @else
                                <li>
                                    <a href="{{ $url }}" class="px-3 py-2 text-indigo-600 bg-white border rounded-md hover:bg-indigo-50 transition duration-200 transform hover:scale-105">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        <!-- Next Page Link -->
                        @if ($opportunities->hasMorePages())
                            <li>
                                <a href="{{ $opportunities->nextPageUrl() }}" class="px-3 py-2 text-indigo-600 bg-white border rounded-md hover:bg-indigo-50 transition duration-200 transform hover:scale-105">
                                    Next
                                </a>
                            </li>
                        @else
                            <li class="px-3 py-2 text-gray-400 bg-gray-100 rounded-md">Next</li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </div>

@endsection
