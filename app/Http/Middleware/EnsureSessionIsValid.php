<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureSessionIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Session::get('auth_user'));
        if (Session::get('auth_user')) {

            return $next($request);
        } else {
            // echo Session::get('auth_user');
            return redirect('/login');
        }
        return $next($request);

        // return Session::get('auth_user') ? $next($request) : url('/');
        // return Session::get('auth_user');
    }
}
