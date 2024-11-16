@extends('layouts.admin-app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Opportunity</h1>
    <form action="{{ route('admin.opportunities.update', $opportunity->oppId) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" name="title" id="title" value="{{ $opportunity->oppTitle }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="w-full px-3 py-2 border rounded">{{ $opportunity->oppDesc }}</textarea>
        </div>
        <!-- Add other fields as necessary -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Opportunity</button>
    </form>
</div>
@endsection 