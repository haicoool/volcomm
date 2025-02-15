<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
<div class="max-w-lg w-full bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6">Reset Password</h2>
    <form method="POST" action="{{ route('volunteer.password.email') }}">
        @csrf
        <div class="mb-4">
            <label for="vEmail" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="vEmail" id="vEmail" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Send Password Reset Link</button>
        </div>
    </form>
</div>

<!-- Display SweetAlert for Error Messages -->
@if(session('alert_type'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "{{ session('alert_type') }}", // error, success, etc.
                title: "{{ session('alert_title') }}",
                text: "{{ session('alert_message') }}",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            });
        });
    </script>
@endif
</body>
</html>
