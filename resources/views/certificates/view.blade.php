@extends('layouts.volunteer-app')

@section('title', 'My Certificates')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">My Certificates</h1>

    @if($certificates->isEmpty())
        <p>You have no certificates yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($certificates as $certificate)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold">{{ $certificate->oppTitle }}</h2>
                    <p>Date: {{ $certificate->oppDate }}</p>
                    <p>Location: {{ $certificate->oppLocation }}</p>
                    <a href="{{ route('volunteer.show-certificate', $certificate->certificateId) }}" target="_blank" class="text-blue-500 hover:underline">View Certificate</a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 