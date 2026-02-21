<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!(session()->has('token') && session()->has('admin') || session()->has('employee') || session()->has('dealer') || session()->has('installer'))) {
            session()->flash('error_middleware', 'You need to login first');
            return redirect()->route('guest.login');
        }
        return $next($request);
    }
}
