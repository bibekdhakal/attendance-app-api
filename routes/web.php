<?php

use App\Mail\SubscriptionMail;
use App\Models\Tenant;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Administrator\AttendanceController;
use App\Http\Controllers\Administrator\CampusController;
use App\Http\Controllers\Administrator\UnitController;
use App\Http\Controllers\Administrator\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Validator;

Route::get('/', function () {
    return view('home');
});

Route::get('/subscription/{plan?}', function ($plan = null) {
    return view('subscription', ['selectedPlan' => $plan]);
})->name('subscription.form');

Route::post('/subscription', function (Request $request) {

    $validator = $request->validate([
        'university_name' => 'required|string',
        'domain' => 'required|string|unique:tenants',
        'email' => 'required|email',
        'name' => 'required|string',
        'database' => 'required|string|min:6|max:50|unique:tenants',
        'plan' => 'required|string|in:basic,standard,premium',
    ]);
    $university  = University::create(['university_name' => $request->university_name, 'status' => 'active']);
    $data        = Tenant::create(
        [
            'name' => $request->name,
            'university_id' => $university->university_id,
            'domain' => $request->domain,
            'database' => $request->database
        ]
    );
    $tenantId = $data->id;
    $database = DB::statement('CREATE DATABASE IF NOT EXISTS ' . $request->database);
    Config::set('database.connections.tenant', [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => $request->database,
        'username' => env('DB_USERNAME_TENANT'),
        'password' => env('DB_PASSWORD_TENANT'),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ]);

    DB::purge('tenant');
    DB::reconnect('tenant');
    DB::setDefaultConnection('tenant');

    // Run migrations on the tenant database
    $artisan = Artisan::call('tenants:artisan', [
        'artisanCommand' => "migrate --database=$request->database --path=database/migrations/tenant",
        '--tenant' => $tenantId,
        '--databaseName' => $request->database
    ]);

    User::create(['name' => $request->get('name'), 'email' => $request->get('email'), 'password' => Hash::make('password'), 'campuse_id' => 1, 'user_type' => 'admin']);

    // $title = 'Subscription Purchase';
    // $body = 'Thank you for purchasing subcription! The admin user has been created. Use accordingly.';

    // Mail::to('manepali.bibek@gmail.com')->send(new SubscriptionMail($title, $body));

    return view('subscription', ['selectedPlan' => $request->get('plan')]);
});
Route::group(['middleware' => ['web', 'switch.tenant']], function () {
    // Route::prefix('/{tenant}')->group(function () {
    Route::get('/login', [HomeController::class, 'index']);

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
    // });
});
