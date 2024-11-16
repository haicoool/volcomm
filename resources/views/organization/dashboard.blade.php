@extends('layouts.app')

@section('title', 'View Opportunities')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Opportunities</h1>

    <!-- Loop through opportunities -->
    @foreach ($opportunities as $opportunity)
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-lg shadow-lg mb-6 flex items-center transition-transform transform hover:scale-105 hover:shadow-xl duration-200 overflow-hidden">
            <!-- Image on the left -->
            <img class="h-40 w-40 rounded-lg object-cover shadow-md" src="{{ asset('storage/' . $opportunity->oppImage) }}" alt="Opportunity Image">

            <!-- Opportunity details on the right -->
            <div class="ml-6 flex-1">
                <h2 class="text-2xl font-semibold text-indigo-900 mb-2">{{ $opportunity->oppTitle }}</h2>
                <p class="text-gray-700 mb-2">{{ Str::limit($opportunity->oppDesc, 120) }}</p>

                <!-- Detail tags -->
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-medium rounded-lg">📍 {{ $opportunity->oppLocation }}</span>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-lg">📅 {{ $opportunity->oppDate }}</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-lg">⏰ {{ $opportunity->oppTime }}</span>
                    <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-lg">💼 {{ $opportunity->reqSkill }}</span>
                </div>

                <a href="{{ route('opportunities.manage', $opportunity->oppId) }}" class="text-white bg-indigo-600 hover:bg-indigo-700 font-semibold rounded-lg px-4 py-2 transition-colors duration-200 inline-block shadow-md">
                    View Details
                </a>
            </div>
        </div>
    @endforeach

</div>
@endsection
