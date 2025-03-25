<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;

// API endpoint for user registration
Route::post('register', [ApiAuthController::class, 'register']);

// API endpoint for user login
Route::post('login', [ApiAuthController::class, 'login']);

//Sorry I give up at this point because they don't show up in route:list
