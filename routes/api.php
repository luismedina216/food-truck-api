<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodtruckController;

Route::post('/authentication/token', [AuthController::class, 'token']);

Route::middleware(['middleware' => 'auth:api'])->group(function () {

    Route::get('/foodtruck', [FoodtruckController::class, 'search'])->middleware(['scope:admin']);

    Route::get('/foodtruck/{id}', [FoodtruckController::class, 'index'])->middleware(['scope:admin,user']);

});

