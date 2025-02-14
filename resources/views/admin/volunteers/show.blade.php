@extends('layouts.admin-app')

@section('content')
    <div class="flex justify-center items-center min-h-screen 0">
        <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
            <!-- Profile Picture Section -->
            <div class="flex flex-col items-center mb-6">
                @if ($volunteer->vProfilepic)
                    <!-- Use volunteer's profile picture -->
                    <img src="{{ Storage::disk('s3')->url($volunteer->vProfilepic) }}">
                         alt="Profile Picture"
                         class="h-32 w-32 rounded-full object-cover border-2 border-gray-300 mb-4">
                @else
                    <!-- Use default Google-hosted profile picture -->
                    <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-11.jpg"
                         alt="Default Profile Picture"
                         class="h-32 w-32 rounded-full object-cover border-2 border-gray-300 mb-4">
                @endif
            </div>

            <!-- Volunteer Information Section -->
            <div class="space-y-4">
                <h1 class="text-3xl font-semibold text-gray-800 text-center">{{ $volunteer->vName }}</h1>
                <p class="text-center text-gray-600">{{ $volunteer->vEmail }}</p>

                <!-- Skills Section -->
                <div>
                    <p class="text-lg text-gray-700 font-medium">Skills:</p>
                    <p class="text-gray-500">{{ $volunteer->vSkill ?? 'N/A' }}</p>
                </div>

                <!-- Interests Section -->
                <div>
                    <p class="text-lg text-gray-700 font-medium">Interests:</p>
                    @if ($volunteer->interest)
                        @php
                            // Decode the interests if it's a JSON or serialized array
                            $interests = json_decode($volunteer->interest);
                        @endphp

                            <!-- If it's an array, loop through it -->
                        @if (is_array($interests))
                            <ul class="list-disc pl-5 text-gray-500">
                                @foreach($interests as $interest)
                                    <li>{{ $interest }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">{{ $volunteer->interest }}</p>
                        @endif
                    @else
                        <p class="text-gray-500">N/A</p>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('admin.volunteers.index') }}" class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Volunteer List
                </a>
            </div>
        </div>
    </div>
@endsection
