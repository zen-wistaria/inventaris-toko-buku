<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAuth2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!auth()->check() || auth()->user()->role != 0 || auth()->user()->role != 1 || auth()->user()->role != 2) {
        //     abort(403);
        // }
        if (!auth()->check() || auth()->user()->role > 2 || auth()->user()->role == 1) {
            abort(403);
        }
        return $next($request);
    }
}
