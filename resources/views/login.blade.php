<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
     <!-- If there's an error message, display it here -->
     @if(session('error'))
     <div style="color:red;">
         {{ session('error') }}
     </div>
    @endif
    <!-- Login form: sends POST request to /login -->
    <form method="POST" action="{{ url('login') }}">
        @csrf
        <!-- Username input field -->
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <!-- Password input field -->
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <!-- Submit button -->
        <button type="submit">Login</button>
    </form>
</body>
</html>
