<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <!-- Registration form: sends POST request to /register -->
    <form method="POST" action="{{ url('register') }}">
        @csrf
        <!-- Form fields -->
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Register</button>
    </form>    
</body>
</html>
