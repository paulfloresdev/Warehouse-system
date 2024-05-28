<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// AUTH
Route::post('auth/register', [AuthController::class, 'create']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    // AUTH
    Route::post('auth/checkToken', [AuthController::class, 'checkToken']);
    Route::post('auth/logout', [AuthController::class, 'logout']);

    // USERS
    Route::put('/users', [UserController::class, 'update']);
    Route::put('/users/update-password', [UserController::class, 'updatePassword']);
});
