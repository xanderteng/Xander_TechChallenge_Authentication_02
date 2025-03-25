<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;                  // Import the User model
use Illuminate\Support\Facades\Hash;  // For password hashing

class ApiAuthController extends Controller
{
    /**
     * Register a new user and return an API token.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validate the incoming API request data.
        $request->validate([
            'name'     => 'required|string|max:255',      // User's full name
            'username' => 'required|string|max:255|unique:users', // Unique username
            'password' => 'required|string|min:8',          // Password must be at least 8 characters
        ]);

        // Create a new user record in the database with a bcrypt-hashed password.
        $user = User::create([
            'name'     => $request->name,                   // Save the user's name
            'username' => $request->username,               // Save the unique username
            'password' => bcrypt($request->password),       // Hash the password before saving
        ]);

        // Generate an access token for the newly registered user using Passport.
        $token = $user->createToken('authToken')->accessToken;

        // Return a JSON response with a success message and the API token.
        return response()->json([
            'message' => 'Registration successful.',
            'token'   => $token,
        ], 201); // HTTP 201 Created
    }

    /**
     * Log in an existing user and return an API token.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the incoming API request data.
        $request->validate([
            'username' => 'required|string',  // Username is required
            'password' => 'required|string',  // Password is required
        ]);

        // Retrieve the user record based on the username.
        $user = User::where('username', $request->username)->first();

        // If user is not found or the password is incorrect, return an error response.
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => "Invalid credentials: username and password don't match.",
            ], 401); // HTTP 401 Unauthorized
        }

        // Generate an access token for the user using Passport.
        $token = $user->createToken('authToken')->accessToken;

        // Return a JSON response with a success message and the API token.
        return response()->json([
            'message' => 'Login successful.',
            'token'   => $token,
        ], 200); // HTTP 200 OK
    }
}
