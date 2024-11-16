@extends('layouts.admin-app')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-semibold mb-4">Edit Admin</h1>
    <form method="POST" action="{{ route('admin.update', $admin->adminId) }}">
        @csrf
        <div class="mb-4">
            <label for="adminName" class="block">Admin Name</label>
            <input type="text" name="adminName" id="adminName" value="{{ $admin->adminName }}" class="border rounded w-full p-2" required>
        </div>
        <div class="mb-4">
            <label for="adminEmail" class="block">Admin Email</label>
            <input type="email" name="adminEmail" id="adminEmail" value="{{ $admin->adminEmail }}" class="border rounded w-full p-2" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white rounded p-2">Update Admin</button>
    </form>
</div>
@endsection 