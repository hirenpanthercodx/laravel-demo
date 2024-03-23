<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (strpos($request->fullUrl(), Session::get('auth_user')->role) == false) {
            return redirect((Session::get('auth_user')->role === 'admin') ? '/admin' : '/employee');
        } else {
            return $next($request);
        }
    }
}
