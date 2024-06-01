<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $userRole = auth()->user()?->role;

        if (!$userRole) {
            // abort(403, 'Can not access this route');
            return to_route('dashboard');
        }

        if (!in_array($userRole, $roles)) {
            return to_route("$userRole.dashboard", $userRole);
        }

        return $next($request);
    }
}