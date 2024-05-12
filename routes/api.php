<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'authenticate']);
Route::post('user/create', [UserController::class, 'store']);
Route::get('campuses', [ApiController::class, 'get_campuses']);
Route::post('reset-password', [UserController::class, 'reset_password']);
Route::post('verify-otp', [UserController::class, 'verify_otp']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('user-detail', [UserController::class, 'get_user']);
    Route::get('geolocation', [ApiController::class, 'campus_physical_location']);
    Route::get('units', [ApiController::class, 'units']);
    Route::post('attendance/create', [AttendanceController::class, 'create']);
});
