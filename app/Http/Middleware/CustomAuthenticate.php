<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards[0] ?? 'web')->guest()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 401);
            }

            if ($request->is('nasabah/*')) {
                return redirect()->route('nasabah.login');
            } elseif ($request->is('unit/*')) {
                return redirect()->route('unit.login');
            } elseif ($request->is('pusat/*')) {
                return redirect()->route('pusat.login');
            } else {
                return redirect()->route('landing');
            }
        }

        return $next($request);
    }
}
