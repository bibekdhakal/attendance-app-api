<?php

use App\Http\Controllers\Administrator\CampusController;
use App\Http\Controllers\Administrator\UnitController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('units', [UnitController::class, 'index'])->name('units.index');
    Route::get('campuses', [CampusController::class, 'index'])->name('campuses.index');
});
