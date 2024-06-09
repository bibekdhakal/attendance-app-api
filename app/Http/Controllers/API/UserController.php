<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SendCodeResetPassword;
use App\Models\Campus;
use App\Models\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Traits\ResponseTrait;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use JWTAuth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    use ResponseTrait;

    public function authenticate(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        try {
            $user = User::where('email', $request->get('email'))->where('device_id', $request->get('device_id'))->first();
            if (!$user) {
                return $this->errorResponse([
                    'message' => 'You are using new device to login. Please reactive your account for new device.',
                ], 401);
            }
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

        $campus_id =  auth()->user()->campus_id;
        $geolocation = Campus::where('campus_id', $campus_id)->select('latitude', 'longitude')->first();

        return $this->successResponse([
            'token' => $token,
            'campusLocation' => $geolocation
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

    public function get_user(Request $request)
    {
        try {
            $user = JWTAuth::authenticate($request->token);
            return $this->successResponse($user, [], 200);
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], $exception->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
                'status' => 'required|string',
                'campus_id' => 'required|exists:campuses,campus_id',
                'student_type' => 'required|string',
            ]);

            $jsonData = [
                "name" => $request->json()->get('name'),
                "email" => $request->json()->get('email'),
                "password" => bcrypt($request->json()->get('password')),
                "student_type" => $request->json()->get('student_type'),
                "campus_id" => $request->json()->get('campus_id'),
                "device_id" => $request->json()->get('device_id')
            ];

            $user = User::create($jsonData);
            return $this->successResponse($user, ["Signed Up successfully"], 200);
        } catch (ValidationException $exception) {
            return $this->errorResponse(['message' => $exception->validator->errors()->first()], 422);
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], $exception->getCode());
        }
    }

    public function reset_password(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email',
            ]);

            $user = User::where('email', $data['email'])->first();

            if (!$user) {
                return $this->errorResponse(['message' => 'User not found'], 404);
            }

            ResetPassword::where('email', $request->email)->delete();

            $data['token'] = mt_rand(100000, 999999);
            $data = ResetPassword::create($data);
            Mail::to($request->email)->send(new SendCodeResetPassword($data->token));
            return $this->successResponse($data, ["Code is sent to your email. Please check your email and verify the code"], 200);
        } catch (ValidationException $exception) {
            return $this->errorResponse(['message' => $exception->validator->errors()->first()], 422);
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], $exception->getCode());
        }
    }

    public function verify_code(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email',
                'token' => 'required|numeric',
            ]);

            $reset_password = ResetPassword::where('email', $data['email'])
                ->where('token', $data['token'])
                ->first();

            if (!$reset_password) {
                return $this->errorResponse(['message' => 'Invalid code'], 400);
            }

            $user = User::where('email', $data['email'])->first();

            $user->password = bcrypt($request->password);
            $user->save();

            $reset_password->delete();

            return $this->successResponse([], ["Password reset successfully"], 200);
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()], $exception->getCode());
        }
    }
}
