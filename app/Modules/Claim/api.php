<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Claim\Controllers\ClaimController;

Route::middleware('auth:sanctum')->prefix('claims')->group(function () {
    Route::get('/', [ClaimController::class, 'index']);
    Route::post('/', [ClaimController::class, 'store']);
});


