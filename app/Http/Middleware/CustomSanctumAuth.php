<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class CustomSanctumAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('sanctum')->check()) {
            $response=['message'=>'Invalid or Token has been expire','status'=>'error','code'=>401];
             return response($response, 401);
        }

        return $next($request);
    }
}
