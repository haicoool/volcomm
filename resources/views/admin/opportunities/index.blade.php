@extends('layouts.admin-app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-100 mb-6">Manage Events</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Event Title</th>
                    <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Description</th>
                    <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Organization</th>
                    <th class="py-3 px-6 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($opportunities as $opportunity)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="py-4 px-6 text-sm text-gray-700 border-b">{{ $opportunity->oppTitle }}</td>
                    <td class="py-4 px-6 text-sm text-gray-500 border-b">{{ Str::limit($opportunity->oppDesc, 50) }}</td>
                    <td class="py-4 px-6 text-sm text-gray-700 border-b">{{ $opportunity->organization->organizationName }}</td>
                    <td class="py-4 px-6 text-sm border-b">
                        <a href="{{ route('admin.opportunities.view', $opportunity->oppId) }}" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                            <button class="bg-blue-100 hover:bg-blue-200 text-blue-600 py-2 px-4 rounded-md text-sm font-medium transition duration-200">View</button>
                        </a>
                        <form action="{{ route('admin.opportunities.delete', $opportunity->oppId) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-600 py-2 px-4 rounded-md text-sm font-medium transition duration-200"
                                onclick="return confirm('Are you sure you want to delete this opportunity?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
