<!DOCTYPE html>
<html>
<head>
    <title>Main Page</title>
</head>
<body>
    <!-- If there's a success message, display it here -->
    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif
    <!-- Main page with login and register buttons -->
    <!-- Link to the login page -->
    <a href="{{ url('login') }}">Login</a>
    <!-- Link to the registration page -->
    <a href="{{ url('register') }}">Register</a>
</body>
</html>
