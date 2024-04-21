<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;

    public function authenticate(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'user_type' => 'student'
        ];
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        try {
            // Attempt to generate a JWT token
            if (!$token = JWTAuth::attempt($credentials)) {
                // Return error response for invalid credentials
                return $this->errorResponse([
                    'message' => 'Login credentials are invalid.',
                ], 401);
            }
        } catch (JWTException $e) {
            // Return error response for token generation failure
            return $this->errorResponse([
                'message' => 'Could not create token.',
                'error' => $e->getMessage(), // Optionally log the error message for debugging
            ], 500);
        }

        return $this->successResponse([
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);

            return $this->successResponse(
                [],
                'User has been logged out'
            );
        } catch (JWTException $exception) {
            return $this->errorResponse([
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}