<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(session()->has("admin"), session()->has("dealer"));
        if (!(session()->has("admin")) && (session()->has('adminToken'))) {
            // return redirect()->route("admin.dashboard");
            return redirect()->back();
        }
        return $next($request);
    }
}
