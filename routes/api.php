<?php

use App\Http\Controllers\API\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('profile', [UserController::class, 'profile']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('barang', [BarangController::class, 'dataBarang']);
    Route::post('editprofile/{uuid}', [UserController::class, 'editprofile']);
    Route::post('editpassword/{uuid}', [UserController::class, 'editpassword']);
});
