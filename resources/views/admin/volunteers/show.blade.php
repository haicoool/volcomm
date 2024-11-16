@extends('layouts.admin-app')

@section('content')
    <h1>{{ $volunteer->vName }}</h1> <!-- Ensure this matches the actual field name -->
    <p>Email: {{ $volunteer->vEmail }}</p> <!-- Ensure this matches the actual field name -->
    <!-- Add more volunteer details as needed -->
@endsection
