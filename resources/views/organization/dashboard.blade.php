@extends('layouts.app')

@section('title', 'View Opportunities')

@section('content')
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">My Events</h1>

        <!-- Search and Sort -->
        <div class="flex items-center justify-between mb-6">
            <!-- Search Bar -->
            <form action="{{ route('organization.dashboard') }}" method="GET" class="w-full max-w-md">
                <div class="relative">
                    <input
                        type="text"
                        name="search"
                        value="{{ request()->query('search') }}"
                        class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Search opportunities..."
                    />
                    <i class="fas fa-search absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-500"></i>
                </div>
            </form>

            <!-- Sort Dropdown -->
            <form action="{{ route('organization.dashboard') }}" method="GET" class="ml-4">
                <select
                    name="status"
                    class="border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()"
                >
                    <option value="">Sort by</option>
                    <option value="active" {{ request()->query('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ request()->query('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </form>
        </div>

        <!-- Check if there are opportunities -->
        @if ($opportunities->isEmpty())
            <!-- Display this message if no opportunities are found -->
            <div class="text-center bg-blue-100 text-blue-700 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold">No opportunities available</h2>
                <p class="text-gray-700 mt-2">Try adjusting your search or check back later.</p>
            </div>
        @else
            <!-- Loop through opportunities -->
            @foreach ($opportunities as $opportunity)
                @php
                    // Parse the opportunity date and determine the status
                    $oppDate = \Carbon\Carbon::parse($opportunity->oppDate);
                    $status = ($oppDate->isFuture() || $oppDate->isToday()) ? 'Active' : 'Expired';
                    $statusClass = $status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                    $formattedDate = $oppDate->format('F j, Y'); // Example: January 5, 2025
                @endphp

                <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-lg shadow-lg mb-6 flex items-center transition-transform transform hover:scale-105 hover:shadow-xl duration-200 overflow-hidden">
                    <!-- Image on the left -->
                    <img class="h-40 w-40 rounded-lg object-cover shadow-md" src="{{ Storage::disk('s3')->url($opportunity->oppImage) }}" alt="Opportunity Image">

                    <!-- Opportunity details on the right -->
                    <div class="ml-6 flex-1">
                        <h2 class="text-2xl font-semibold text-blue-900 mb-2">{{ $opportunity->oppTitle }}</h2>
                        <p class="text-gray-700 mb-2">{{ Str::limit($opportunity->oppDesc, 120) }}</p>

                        <!-- Detail tags -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm font-medium rounded-lg">
                                <i class="fas fa-map-marker-alt"></i> {{ $opportunity->oppLocation }}
                            </span>
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm font-medium rounded-lg">
                                <i class="fas fa-calendar-alt"></i> {{ $formattedDate }}
                            </span>
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm font-medium rounded-lg">
                                <i class="fas fa-clock"></i> {{ $opportunity->oppTime }}
                            </span>
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm font-medium rounded-lg">
                                <i class="fas fa-briefcase"></i> {{ $opportunity->reqSkill }}
                            </span>
                        </div>

                        <!-- Status label -->
                        <span class="px-3 py-1 {{ $statusClass }} text-sm font-medium rounded-lg">{{ $status }}</span>

                        <a href="{{ route('opportunities.manage', $opportunity->oppId) }}" class="text-white bg-blue-600 hover:bg-blue-700 font-semibold rounded-lg px-4 py-2 transition-colors duration-200 inline-block shadow-md">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="mt-6">
                {{ $opportunities->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection
