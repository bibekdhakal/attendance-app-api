<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify', '']], function () {
    Route::get('logout', [UserController::class, 'logout']);
});
