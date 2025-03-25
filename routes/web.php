<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiAuthController;

// Route for the main page with login and register buttons
Route::get('/', function () {
    return view('main');
})->name('main');

// Routes for login
Route::get('/login', [AuthController::class, 'showLogin']); // Show the login form
Route::post('/login', [AuthController::class, 'login']); // Process the login form

// Routes for registration
Route::get('/register', [AuthController::class, 'showRegister']); // Show the registration form
Route::post('/register', [AuthController::class, 'register']); // Process the registration form
