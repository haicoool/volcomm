@extends('layouts.volunteer-app')

@section('title', 'My Certificates')

@section('content')
    <div class="container mx-auto mt-12">
        <!-- Page Title -->
        <h1 class="text-4xl font-extrabold text-center text-gray-900 mb-10">My Certificates</h1>

        @if($certificates->isEmpty())
            <!-- No Certificates Message -->
            <div class="flex flex-col items-center justify-center">
                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
                <p class="text-lg text-gray-600">You have no certificates yet. Start volunteering to earn one!</p>
            </div>
        @else
            <!-- Certificates Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($certificates as $certificate)
                    <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <!-- Certificate Header -->
                        <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 p-4 text-white text-center">
                            <h2 class="text-lg font-bold">{{ $certificate->oppTitle }}</h2>
                            <p class="text-sm">Location: {{ $certificate->oppLocation }}</p>
                        </div>
                        <!-- Certificate Content -->
                        <div class="p-6">
                            <p class="text-gray-700 text-sm mb-2">
                                <span class="font-semibold">Date:</span> {{ \Carbon\Carbon::parse($certificate->oppDate)->format('d M Y') }}
                            </p>
                            <p class="text-gray-700 text-sm mb-4">
                                <span class="font-semibold">Location:</span> {{ $certificate->oppLocation }}
                            </p>
                            <div class="text-center">
                                <a href="{{ route('volunteer.show-certificate', $certificate->certificateId) }}"
                                   target="_blank"
                                   class="inline-flex items-center bg-indigo-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300">
                                    View Certificate
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
