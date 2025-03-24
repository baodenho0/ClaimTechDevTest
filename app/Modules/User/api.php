<?php

use Illuminate\Support\Facades\Route;
use App\Modules\User\Controllers\UserController;

Route::middleware('auth:sanctum')->prefix('users')->group(function () {
    Route::post('/upload', [UserController::class, 'upload']);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
