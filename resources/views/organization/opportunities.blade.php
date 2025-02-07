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
                    <th class="py-3 px-4 text-center text-gray-600 font-semibold">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($opportunities as $opportunity)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-4 px-4 text-left">{{ $opportunity->oppTitle }}</td>
                        <td class="py-4 px-4 text-left">{{ $opportunity->oppDesc }}</td>
                        <td class="py-4 px-4 text-left">{{ $opportunity->oppLocation }}</td>
                        <td class="py-4 px-4 text-center">
                            @if($opportunity->oppDate->toDateString() === $currentDate->toDateString())
                                <a href="{{ route('registrations.show', $opportunity->oppId) }}" class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition duration-300">
                                    View Volunteer List
                                </a>
                            @else
                                <button onclick="showAlert()" class="inline-block px-4 py-2 text-white bg-gray-400 rounded cursor-not-allowed">
                                    View Volunteer List
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

