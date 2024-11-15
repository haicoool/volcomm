@extends('layouts.admin-app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Manage Opportunities</h1>
    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Description</th>
                    <th class="py-2 px-4 border-b">Organization</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($opportunities as $opportunity)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $opportunity->oppTitle }}</td>
                    <td class="py-2 px-4 border-b">{{ $opportunity->oppDesc }}</td>
                    <td class="py-2 px-4 border-b">{{ $opportunity->organization->organizationName }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.opportunities.edit', $opportunity->oppId) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('admin.opportunities.delete', $opportunity->oppId) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this opportunity?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 