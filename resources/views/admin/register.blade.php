<!DOCTYPE html>
<html>
<head>
    <title>Admin Register</title>
</head>
<body>
    <form action="{{ route('admin.register') }}" method="POST">
        @csrf
        <div>
            <label for="adminName">Name:</label>
            <input type="text" id="adminName" name="adminName" required>
        </div>
        <div>
            <label for="adminEmail">Email:</label>
            <input type="email" id="adminEmail" name="adminEmail" required>
        </div>
        <div>
            <label for="adminPass">Password:</label>
            <input type="password" id="adminPass" name="adminPass" required>
        </div>
        <div>
            <label for="adminPass_confirmation">Confirm Password:</label>
            <input type="password" id="adminPass_confirmation" name="adminPass_confirmation" required>
        </div>
        <button type="submit">Register</button>
    </form>
</body>
</html>
