<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen flex items-center justify-center bg-gray-100">

<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold text-center mb-4">Reset Password</h1>

    @if($errors->any())
        <p class="text-red-500">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('organization.reset-password') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="email" class="block">Email Address</label>
        <input type="email" name="email" value="{{ request()->email }}" class="w-full px-4 py-2 border rounded mt-1" required>

        <label for="password" class="block mt-4">New Password</label>
        <input type="password" name="password" class="w-full px-4 py-2 border rounded mt-1" required>

        <label for="password_confirmation" class="block mt-4">Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded mt-1" required>

        <button type="submit" class="w-full bg-green-500 text-white py-2 mt-4 rounded">Reset Password</button>
    </form>
</div>

</body>
</html>
