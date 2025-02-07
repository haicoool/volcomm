@extends('layouts.admin-app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <!-- Organization Details -->
        <h1 class="text-3xl font-bold text-gray-900">{{ $organization->organizationName }}</h1>
        <p class="text-lg text-gray-600 mt-2">Email: <span class="font-semibold">{{ $organization->organizationEmail }}</span></p>
        <p class="text-md text-gray-700 mt-2">About: {{ $organization->organizationAbout }}</p>

        <!-- Organization Logo -->
        <div class="mt-4">
            @if($organization->logo)
                <img src="{{ asset('storage/' . $organization->logo) }}" alt="Logo" class="w-32 h-32 object-cover rounded-full border border-gray-300">
            @else
                <p class="text-gray-500 mt-2">No logo available</p>
            @endif
        </div>

        <!-- Back Button using JavaScript -->
        <div class="mt-6 text-center">
            <button onclick="window.history.back()" class="inline-flex items-center px-6 py-2 mt-4 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <i class="fa fa-arrow-left mr-2"></i> Back
            </button>
        </div>
    </div>
@endsection
