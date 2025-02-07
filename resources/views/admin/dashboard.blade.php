@extends('layouts.admin-app')

@section('content')
    <div class="p-10 min-h-screen text-gray-200">
        <!-- Welcome Message -->
        <h1 class="text-4xl font-extrabold text-gray-100 mb-6">Dashboard</h1>

        <!-- Notification Bar -->
        <div class="mb-8">
            @if ($waitingApprovalCount > 0)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-md flex items-center space-x-4">
                    <i class="fas fa-exclamation-circle text-2xl"></i>
                    <div>
                        <p class="text-lg font-semibold">Pending Approvals</p>
                        <p class="text-sm">There are <span class="font-bold">{{ $waitingApprovalCount }}</span> organizations waiting for your approval.</p>
                    </div>
                    <a href="{{ route('admin.approved.organizations') }}"
                       class="ml-auto bg-yellow-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-200">
                        Review Now
                    </a>
                </div>
            @else
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md flex items-center space-x-4">
                    <i class="fas fa-check-circle text-2xl"></i>
                    <div>
                        <p class="text-lg font-semibold">All Caught Up!</p>
                        <p class="text-sm">There are no organizations pending approval.</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Volunteers Registered -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-users text-4xl"></i>
                    <div>
                        <h2 class="text-xl font-semibold">Volunteers Registered</h2>
                        <p class="text-3xl font-bold">{{ $volunteerCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Organizations Registered -->
            <div class="bg-gradient-to-r from-green-500 to-teal-600 text-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-building text-4xl"></i>
                    <div>
                        <h2 class="text-xl font-semibold">Organizations Registered</h2>
                        <p class="text-3xl font-bold">{{ $organizationCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Organizations Waiting for Approval -->
            <div class="bg-gradient-to-r from-yellow-500 to-orange-600 text-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-hourglass-half text-4xl"></i>
                    <div>
                        <h2 class="text-xl font-semibold">Approval Pending</h2>
                        <p class="text-3xl font-bold">{{ $waitingApprovalCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="mt-10">
            <h2 class="text-2xl font-semibold text-gray-100 mb-6">Quick Links</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('admin.volunteers.index') }}" class="block bg-gray-700 p-6 rounded-lg shadow-md border border-gray-600 text-center hover:bg-gray-600 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-users text-blue-400 text-4xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-200">View Volunteers</h3>
                </a>
                <a href="{{ route('admin.organizations.index') }}" class="block bg-gray-700 p-6 rounded-lg shadow-md border border-gray-600 text-center hover:bg-gray-600 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-building text-green-400 text-4xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-200">View Organizations</h3>
                </a>
                <a href="{{ route('admin.approved.organizations') }}" class="block bg-gray-700 p-6 rounded-lg shadow-md border border-gray-600 text-center hover:bg-gray-600 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-check-circle text-yellow-400 text-4xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-200">Approved Organizations</h3>
                </a>
            </div>
        </div>
    </div>
@endsection
