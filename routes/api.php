<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

foreach (glob(base_path('app/Modules/*/api.php')) as $file) {
    require $file;
}
