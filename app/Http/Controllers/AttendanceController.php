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
            $jsonData = $request->json()->all();

            $user_id = auth()->user()->user_id;
            $unit_id = $request->input('unit_id');
            $status = $request->input('status');
            $attendance = [$unit_id, $status];
            $jsonData['user_id'] = $user_id;
            $attendance = Attendance_record::create($jsonData);

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
