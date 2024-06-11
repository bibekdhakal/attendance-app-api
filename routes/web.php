<?php

use App\Http\Controllers\Administrator\AttendanceController;
use App\Http\Controllers\Administrator\CampusController;
use App\Http\Controllers\Administrator\UnitController;
use App\Http\Controllers\Administrator\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('units', [UnitController::class, 'index'])->name('units.index');
    Route::get('units/create', [UnitController::class, 'create'])->name('units.create');
    Route::get('campuses', [CampusController::class, 'index'])->name('campuses.index');
    Route::get('campuses/create', [CampusController::class, 'create'])->name('campuses.create');
    Route::get('students', [UserController::class, 'students']);
    Route::get('attendance', [AttendanceController::class, 'index']);
});
