<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = JWTAuth::parseToken()->authenticate();
        } catch (Exception $error) {
            $response = [
                "success" => false,
                "message" => "",
                "data" => null,
                "errors" => null
            ];
            if ($error instanceof TokenInvalidException) {
                $response['message'] = 'Token is Invalid';
            } else if ($error instanceof TokenExpiredException || $error instanceof TokenBlacklistedException) {
                $response['message'] = 'Token is Expired';
            } else {
                $response['message'] = 'Token Not Found';
            }
            return response()->json($response, 401);
        }
        return $next($request);
    }
}
