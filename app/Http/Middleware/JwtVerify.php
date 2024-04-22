<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Closure;
use Exception;
use JWTAuth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtVerify
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->errorResponse('Token is Invalid', Response::HTTP_UNAUTHORIZED);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->errorResponse('Token is Expired', Response::HTTP_UNAUTHORIZED);
            } else {
                return $this->errorResponse('Authorization Token not found', Response::HTTP_UNAUTHORIZED);
            }
        }
        return $next($request);
    }
}
