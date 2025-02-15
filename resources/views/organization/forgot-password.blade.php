<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen flex items-center justify-center bg-gray-100">

<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold text-center mb-4">Forgot Password</h1>

    @if(session('status'))
        <p class="text-green-500">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('organization.forgot-password') }}">
        @csrf
        <label for="email" class="block">Email Address</label>
        <input type="email" name="email" class="w-full px-4 py-2 border rounded mt-1" required>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 mt-4 rounded">Send Reset Link</button>
    </form>
</div>

</body>
</html>
