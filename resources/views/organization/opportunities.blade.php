@extends('layouts.app')

@section('title', 'Confirm Attendance')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Event</h1>

    <div class="overflow-x-auto">
        @if($opportunities->isEmpty())
            <p class="text-center text-gray-600 text-lg">No opportunities available at the moment.</p>
        @else
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 text-left text-gray-600 font-semibold">Title</th>
                    <th class="py-3 px-4 text-left text-gray-600 font-semibold">Description</th>
                    <th class="py-3 px-4 text-left text-gray-600 font-semibold">Location</th>
                </tr>
                </thead>
                <tbody>
                @foreach($opportunities as $opportunity)
                    <tr
                        class="border-b hover:bg-gray-100 cursor-pointer"
                        onclick="window.location='{{ $opportunity->oppDate->toDateString() === $currentDate->toDateString() ? route('registrations.show', $opportunity->oppId) : 'javascript:void(0)' }}'"
                    >
                        <td class="py-4 px-4 text-left">{{ $opportunity->oppTitle }}</td>
                        <td class="py-4 px-4 text-left">{{ $opportunity->oppDesc }}</td>
                        <td class="py-4 px-4 text-left">{{ $opportunity->oppLocation }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
