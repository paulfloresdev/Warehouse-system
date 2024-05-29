<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\AssignableAssetController;
use App\Http\Controllers\Controller;
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
    Route::get('/users/search', [UserController::class, 'search']);

    // ROLES
     Route::resource('roles', RoleController::class);

     // AREAS
     Route::resource('areas', AreaController::class);

     // ASSET TYPES
     Route::resource('asset-types', AssetTypeController::class);

     // ASSIGNABLE ASSETS
     Route::resource('assignable-assets', AssignableAssetController::class);
});
