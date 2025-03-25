<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;                  // Import the User model
use Illuminate\Support\Facades\Hash;  // For password hashing

class AuthController extends Controller
{
   
    public function showLogin()
    {
        // Return the login view
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate request data: username and password are required
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Retrieve the user record based on the username
        $user = User::where('username', $request->username)->first();

        // If user is not found or the password is incorrect, redirect back with an error message
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', "Username and password don't match.");
        }

        // If credentials are valid, generate an access token using Passport
        $token = $user->createToken('authToken')->accessToken;

        // Redirect to the main page with a success message
        return redirect('/')->with('success', 'Login successful.');
    }

    public function showRegister()
    {
        // Return the registration view
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate request data:
        // 'name' is required, 'username' must be unique, and 'password' must be at least 8 characters.
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user record in the database with a bcrypt-hashed password.
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        // Generate an access token for the newly registered user using Passport.
        $token = $user->createToken('authToken')->accessToken;
        session()->put('auth_token', $token);

        // Redirect to the main page with a flash message indicating success.
        return redirect()->route('main')->with('success', 'Registration successful.');
    }
}
