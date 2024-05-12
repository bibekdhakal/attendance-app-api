<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance_record;
use App\Models\Campus;
use App\Models\Unit;
use App\Models\User;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ResponseTrait;
    public function campus_physical_location(Request $request)
    {
        try {
            $campus_id =  auth()->user()->campus_id;
            $geolocation = Campus::where('campus_id', $campus_id)->select('latitude', 'longitude')->first();

            return $this->successResponse($geolocation, [], 200);
        } catch (Exception $e) {
            return $this->errorResponse([
                'message' => 'Internal Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function units(Request $request)
    {
        try {
            $units = Unit::select('*')->orderBy('unit_name', 'ASC')->get();

            return $this->successResponse($units, [], 200);
        } catch (Exception $e) {
            return $this->errorResponse([
                'message' => 'Internal Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function get_campuses(Request $request)
    {
        try {
            $campuses = Campus::select('campus_id', 'campus_name')->orderBy('campus_name', 'ASC')->get();

            return $this->successResponse($campuses, [], 200);
        } catch (Exception $e) {
            return $this->errorResponse([
                'message' => 'Internal Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function check_unit_attendance($unit_id)
    {
        try {
            $attendance = Attendance_record::where('unit_id', $unit_id)->whereDate('created_at', date('Y-m-d'))->where('user_id', auth()->user()->user_id)->first();
            if ($attendance) {
                return $this->successResponse([], ['Attendance already done'], 200);
            }
        } catch (Exception $e) {
            return $this->errorResponse([
                'message' => 'Internal Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
