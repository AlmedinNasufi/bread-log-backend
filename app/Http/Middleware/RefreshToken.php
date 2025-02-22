<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Auth\AuthenticationException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Http\Exceptions\HttpResponseException;

class RefreshToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        try {
            //检查请求中是否带有token 如果没有token值则抛出异常
            //Check if there is a token in the request and throw an exception if there is no token value
            $this->checkForToken($request);
            if ($request->user = JWTAuth::parseToken()->authenticate()) {
                // if (!$request->user->acc_status) {
                //     // Log out the user
                //     Auth::logout();

                //     // Return a response indicating account disabled
                //     return response()->json(['error' => 'Account disabled'], 403);
                // }

                return $next($request);
            }
            throw new AuthenticationException('Unauthorized', []);
        } catch (TokenExpiredException $exception){
            //返回特殊的code - return special code+
            throw new HttpResponseException(response()->json([
                'message' => 'token expired'
            ], 401));
        } catch (\Exception $exception) {
            // Log::info($exception);
            throw new AuthenticationException('Unauthorized', []);
        }
    }
}