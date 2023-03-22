<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PasswordMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $password = $request->input('api_password');

        if ($password !== env('API_PASSWORD', 'pr&1i8y%fRL8&9P*AvEm%xnL$pobQ3')) {
            return response(['message' => 'Unauthorized api password.'], 401);
        }

        return $next($request);
    }
}
