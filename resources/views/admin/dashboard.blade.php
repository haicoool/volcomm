<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.admin-app')

@section('content')
    <div class="p-10">
        <h1 class="text-3xl font-bold mb-4">Welcome to the Admin Dashboard</h1>
        
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold">Volunteers Registered</h2>
                <p class="text-2xl">{{ $volunteerCount }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold">Organizations Registered</h2>
                <p class="text-2xl">{{ $organizationCount }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold">Organizations Waiting for Approval</h2>
                <p class="text-2xl">{{ $waitingApprovalCount }}</p>
            </div>
        </div>
    </div>
@endsection
