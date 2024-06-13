<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function students()
    {
        $students = User::select('users.name', 'users.email', 'users.student_type', 'campuses.campus_name as campus', 'users.user_id')
            ->join('campuses', 'campuses.campus_id', 'users.campus_id')
            ->where('user_type', 'student')
            ->get();
        return view('administrators.user.student', ['students' => $students]);
    }

    public function index()
    {
        $users = User::select('users.name', 'users.email', 'users.user_type', 'campuses.campus_name as campus', 'users.user_id')
            ->join('campuses', 'campuses.campus_id', 'users.campus_id')
            ->where('user_type', '!=', 'student')
            ->get();

        return view('administrators.user.index', ['users' => $users]);
    }

    public function create()
    {
        $campuses = Campus::all();
        return view('administrators.user.create', ['campuses' => $campuses]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:20',
            'user_type' => 'required',
            'campus' => 'required'
        ]);

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'user_type' => $request->get('user_type'),
            'campus_id' => $request->get('campus')
        ]);

        return back()->with('success', 'User is created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $campuses = Campus::all();
        return view('administrators.user.edit', ['user' => $user, 'campuses' => $campuses]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'user_type' => 'required',
            'campus' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->user_type = $request->get('user_type');
        $user->campus_id = $request->get('campus');
        $user->save();

        return back()->with('success', 'User is updated successfully');
    }
}
