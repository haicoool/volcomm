@extends('layouts.app')

@section('title', 'Validate Registration')

@section('content')
    <div class="container mx-auto py-12 px-4">
        <h2 class="text-3xl font-semibold mb-8 text-center">Pending Volunteer Registrations</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg shadow-md text-center mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Debugging output for organizationId -->
        <div class="mb-6 text-center text-gray-400">
            Organization ID: {{ Auth::guard('organization')->user()->organizationId }}
        </div>

        <!-- Table container with a max-width for smaller appearance -->
        <div class="max-w-5xl mx-auto overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full table-auto bg-white">
                <thead class="bg-gray-50">
                <tr class="text-left text-gray-600 uppercase tracking-wider">
                    <th class="px-4 py-4">Registration ID</th>
                    <th class="px-4 py-4">Volunteer Name</th>
                    <th class="px-4 py-4">Opportunity Title</th>
                    <th class="px-4 py-4">Qualification</th>
                    <th class="px-4 py-4 text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach ($pendingRegistrations as $registration)
                    <tr>
                        <td class="px-4 py-3 text-gray-700">{{ $registration->regId }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $registration->vName }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $registration->opportunity->oppTitle ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-gray-700">
                            @php
                                $qualification = json_decode($registration->vQualification);
                            @endphp

                            @if($qualification)
                                <a href="{{ asset('storage/' . $qualification) }}" target="_blank" class="text-blue-500 hover:underline">{{ basename($qualification) }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <form action="{{ route('organization.approve-registration', $registration->regId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition w-full md:w-auto">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('organization.reject-registration', $registration->regId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition w-full md:w-auto">
                                        Reject
                                    </button>
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
