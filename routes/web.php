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
    Route::post('units/store', [UnitController::class, 'store'])->name('units.store');
    Route::get('units/edit/{id}', [UnitController::class, 'edit'])->name('units.edit');
    Route::post('units/update/{id}', [UnitController::class, 'update'])->name('units.update');
    Route::get('campuses', [CampusController::class, 'index'])->name('campuses.index');
    Route::get('campuses/create', [CampusController::class, 'create'])->name('campuses.create');
    Route::post('campuses/store', [CampusController::class, 'store'])->name('campuses.store');
    Route::get('campuses/edit/{id}', [CampusController::class, 'edit'])->name('campuses.edit');
    Route::post('campuses/update/{id}', [CampusController::class, 'update'])->name('campuses.update');
    Route::get('attendance', [AttendanceController::class, 'index']);
    Route::get('students', [UserController::class, 'students'])->name('users.student');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('users/update/{id}', [UserController::class, 'update'])->name('users.update');
});
