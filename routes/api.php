<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('user-detail', [UserController::class, 'get_user']);
    Route::get('geolocation', [ApiController::class, 'campus_physical_location']);
});
