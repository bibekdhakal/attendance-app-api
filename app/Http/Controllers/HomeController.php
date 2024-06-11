<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'logout']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->route()->named('dashboard')) {
            return view('administrators.dashboard.index');
        }

        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function dashboard()
    {
        Log::info('HomeController@dashboard: showing dashboard');
        return view('administrators.dashboard.index');
    }


    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
