<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Session as FacadesSession;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->hasHeader('access-token')) {
            return response()->json(['status' => 'error', 'status_code' => 401, 'message' => 'Access token not provided'], 401);
        }

        // Retrieve the token from the custom access-token header
        $token = $request->header('access-token');

        try {
            // Attempt to authenticate the user based on the token
            $user = JWTAuth::setToken($token)->authenticate();
            FacadesSession::flash('userToken', $token);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'status_code' => 401, 'message' => 'Token has expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'status_code' => 401, 'message' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'status_code' => 401, 'message' => 'Token could not be parsed'], 401);
        }

        return $next($request);
    }
}
