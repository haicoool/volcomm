@extends('layouts.volunteer-app')

@section('title', 'History')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">My Registered Opportunities</h1>

        <!-- Check for error messages and display them with SweetAlert -->
        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ $errors->first('error') }}',
                });
            </script>
        @endif

        <!-- Check for success messages and display them with SweetAlert -->
        @if (session('message'))
            @php
                $message = session('message');
                $alertType = $message['type'] === 'success' ? 'success' : 'warning';
            @endphp
            <script>
                Swal.fire({
                    icon: '{{ $alertType }}',
                    title: '{{ ucfirst($message['type']) }}!',
                    text: '{{ $message['text'] }}',
                });
            </script>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registration ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Opportunity Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Opportunity Date</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($registrations as $registration)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $registration->regId }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $registration->oppTitle }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($registration->oppDate)->format('d M Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
