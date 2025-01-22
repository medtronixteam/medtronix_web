<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class employeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $role = $request->user()->role;
        if ($role === 'employee' || $role === 'team_lead' || $role === 'finance' || $role === 'social_manager' || $role === 'seo') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
