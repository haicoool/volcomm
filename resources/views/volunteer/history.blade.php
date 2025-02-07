@extends('layouts.volunteer-app')

@section('title', 'History')

@section('content')
    <div class="container mx-auto py-12">
        <!-- Page Title -->
        <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">My Registered Events</h1>

        @php
            $currentDateTime = \Carbon\Carbon::now();

            // Filter upcoming opportunities (status: registered or pending)
            $upcomingRegistrations = $registrations->filter(function ($registration) use ($currentDateTime) {
                return in_array($registration->status, ['registered', 'pending']) &&
                       \Carbon\Carbon::parse($registration->oppDate)->endOfDay()->gte($currentDateTime);
            });

            // Filter past opportunities (status: attended)
            $pastRegistrations = $registrations->filter(function ($registration) use ($currentDateTime) {
                return $registration->status === 'attended' &&
                       \Carbon\Carbon::parse($registration->oppDate)->lt($currentDateTime);
            });
        @endphp

            <!-- Upcoming Opportunities Section -->
        @if ($upcomingRegistrations->isNotEmpty())
            <h2 class="text-3xl font-semibold mb-6 text-gray-800 text-center">Upcoming Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($upcomingRegistrations as $registration)
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg">
                        <div class="p-5">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $registration->oppTitle }}</h5>
                            <p class="mb-3 font-normal text-gray-700">
                                Date: {{ \Carbon\Carbon::parse($registration->oppDate)->format('d M Y') }}
                            </p>
                            <p class="{{ $registration->status === 'pending' ? 'text-yellow-500' : 'text-green-500' }} font-semibold mb-4">
                                Status: {{ ucfirst($registration->status) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex items-center justify-center mt-8">
                <p class="text-lg text-gray-600">No upcoming events found.</p>
            </div>
        @endif

        <!-- Past Opportunities Section -->
        @if ($pastRegistrations->isNotEmpty())
            <h2 class="text-3xl font-semibold mt-12 mb-6 text-gray-800 text-center">Past Events</h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Registration ID</th>
                        <th class="px-6 py-3">Event Name</th>
                        <th class="px-6 py-3">Event Date</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pastRegistrations as $registration)
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $registration->regId }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $registration->oppTitle }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($registration->oppDate)->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                {{ ucfirst($registration->status) }}
                            </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex items-center justify-center mt-8">
                <p class="text-lg text-gray-600">No past events found.</p>
            </div>
        @endif
    </div>
@endsection
