<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (auth('admin')->check()) {
            return redirect(app()->getLocale() . '/admin-dashboard');
        }

        if (auth('student')->check()) {
            return redirect(app()->getLocale() . '/students/dashboard');
        }

        if (auth('teacher')->check()) {
            return redirect(app()->getLocale() . '/teachers/dashboard');
        }

        if (auth('parent')->check()) {
            return redirect(app()->getLocale() . '/parents/dashboard');
        }

        return $next($request);
    }
}
