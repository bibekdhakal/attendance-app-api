<?php

use App\Models\Tenant;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/subscription', function () {
    return view('subscription');
});

Route::post('/subscription', function (Request $request) {
    try {
        $university  = University::create(['university_name' => $request->university_name, 'status' => 'active']);
        $data        = Tenant::create(
            [
                'name' => $request->name,
                'university_id' => $university->university_id,
                'domain' => $request->domain,
                'database' => $request->database
            ]
        );
        $database = DB::statement('CREATE DATABASE IF NOT EXISTS ' . $request->database);
        // dd($database);
        return view('subscription');
    } catch (Exception $e) {
        return view('subscription');
    }
});
