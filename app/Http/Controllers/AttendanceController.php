<?php

namespace App\Http\Controllers;

use App\Models\Attendance_record;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;


class AttendanceController extends Controller
{
    use ResponseTrait;
    public function create(Request $request)
    {
        try {
            $user_id = auth()->user()->user_id;
            $unit_id = $request->get('unit_id');
            $status = $request->get('status');
            $attendance = Attendance_record::create(['user_id' => $user_id, 'unit_id' => $unit_id, 'status' => $status]);

            return $this->successResponse(
                $attendance,
                'Attendance has been submitted succesfully',
                200
            );
        } catch (JWTException $exception) {
            return $this->errorResponse([
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
