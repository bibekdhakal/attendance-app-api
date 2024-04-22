<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Campus;
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
}