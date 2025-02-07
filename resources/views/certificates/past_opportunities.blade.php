@extends('layouts.app')

@section('title', 'Generate Certificate')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Past Opportunities</h1>
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-6 text-left font-semibold text-gray-600">Title</th>
                    <th class="py-3 px-6 text-left font-semibold text-gray-600">Description</th>
                    <th class="py-3 px-6 text-left font-semibold text-gray-600">Date</th>
                    <th class="py-3 px-6 text-left font-semibold text-gray-600">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($opportunities as $opportunity)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $opportunity->oppTitle }}</td>
                        <td class="py-4 px-6">{{ $opportunity->oppDesc }}</td>
                        <td class="py-4 px-6">{{ $opportunity->oppDate->format('Y-m-d') }}</td>
                        <td class="py-4 px-6">
                            <a href="{{ route('certificates.volunteers', $opportunity) }}" class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors duration-150 ease-in-out">
                                View Volunteer List
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
