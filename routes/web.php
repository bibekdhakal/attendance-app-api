<?php

use App\Models\Tenant;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        'domain' => 'required|string|unique:tenants',
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
        'username' => 'root',
        'password' => 'Kathmandu@',
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
    Artisan::call('tenants:artisan', [
        'artisanCommand' => "migrate --database=$request->database --path=database/migrations/tenant",
        '--tenant' => $tenantId,
        '--databaseName' => $request->database
    ]);

    return view('subscription');
});
