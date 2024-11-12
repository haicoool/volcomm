@extends('layouts.admin-app')

@section('content')
    <h1>{{ $organization->organizationName }}</h1>
    <p>Email: {{ $organization->organizationEmail }}</p>
    <!-- Add more organization details as needed -->
@endsection