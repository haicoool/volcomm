@extends('layouts.app')

@section('title', 'Pending Volunteer Registrations')

@section('content')
    <div class="container mx-auto py-12 px-4">
        <h2 class="text-4xl font-semibold text-center text-gray-800 mb-8">Pending Volunteer Registrations</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-6 py-4 rounded-lg shadow-md text-center mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Container -->
        <div class="overflow-hidden shadow-xl sm:rounded-lg bg-white">
            <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">Registration ID</th>
                    <th scope="col" class="px-6 py-4">Volunteer Name</th>
                    <th scope="col" class="px-6 py-4">Event Title</th>
                    <th scope="col" class="px-6 py-4">Qualification</th>
                    <th scope="col" class="px-6 py-4 text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pendingRegistrations as $registration)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $registration->regId }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $registration->vName }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $registration->opportunity->oppTitle ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-gray-700">
                            @php
                                $qualification = json_decode($registration->vQualification);
                            @endphp

                            @if($qualification)
                                <!-- Generate S3 URL for the qualification file -->
                                <a href="{{ Storage::disk('s3')->url($qualification) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($qualification) }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-3">
                                <form action="{{ route('organization.approve-registration', $registration->regId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 focus:outline-none transition-all duration-200">Approve</button>
                                </form>
                                <form action="{{ route('organization.reject-registration', $registration->regId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none transition-all duration-200">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
