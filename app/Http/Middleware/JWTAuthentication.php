<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\AuthController;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenExpiredException) {
                $newToken = JWTAuth::parseToken()->refresh();
                return response()->json([
                    'success' => false,
                    'token' => $newToken,
                    'status' => 'Token Renovado!'], 200);
            } else if ($e instanceof TokenInvalidException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token Inválido!'], 401);
            }
            else if ($e instanceof TokenBlacklistedException) {
                $newToken = JWTAuth::parseToken()->refresh();
                return response()->json([
                    'success' => false,
                    'token' => $newToken,
                    'status' => 'Token BlackListed Renovado!'], 200);
            }
            else {
                return response()->json([
                    'success' => false,
                    'message' => 'Token não encontrado!'], 401);
            }
        }
        return $next($request);

    }
}
