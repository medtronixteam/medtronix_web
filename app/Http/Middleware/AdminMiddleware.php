<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Clos
     *
     * ure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the user is authenticated and has the 'admin' role
         if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // If not 'admin', redirect to home page or any other route
        return redirect('/')->with('error', 'Unauthorized access.');

    }
}
