<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function students()
    {
        $students = User::select('users.name', 'users.email', 'users.student_type', 'campuses.campus_name as campus')
            ->join('campuses', 'campuses.campus_id', 'users.campus_id')->where('user_type', 'student')
            ->get();
        return view('administrators.user.student', ['students' => $students]);
    }
}
