<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Attendance_record;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $records = Attendance_record::select(
            'users.name',
            'campuses.campus_name as campus',
            'units.unit_name as unit',
            'attendance_records.status',
            'attendance_records.created_at as date'
        )
            ->join('users', 'users.user_id', 'attendance_records.user_id')
            ->join('campuses', 'campuses.campus_id', 'users.campus_id')
            ->join('units', 'units.unit_id', 'attendance_records.unit_id')
            ->get();
        return view('administrators.attendance.index', ['records' => $records]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }
}
