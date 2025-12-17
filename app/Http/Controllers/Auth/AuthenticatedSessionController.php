<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create($type): View
    {
        return view('auth.login', compact('type'));
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $type_user = $request->get('type_user');
        $guard = $this->getGuardFromType($type_user);

        if (Auth::guard($guard)->attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            return $this->authenticatedRedirect($guard);
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => __('auth.failed')]);
    }

    protected function getGuardFromType(string $type): string
    {
        return match ($type) {
            'student' => 'student',
            'teacher' => 'teacher',
            'parent' => 'parent',
            default => 'admin', 
        };
    }

    protected function authenticatedRedirect(string $guard): RedirectResponse
    {
        return match ($guard) {
            'student' => redirect(app()->getLocale() . '/students/dashboard'),
            'teacher' => redirect(app()->getLocale() . '/teachers/dashboard'),
            'parent' => redirect(app()->getLocale() . '/parents/dashboard'),
            default => redirect(app()->getLocale() . '/admin-dashboard'),
        };
    }

    public function destroy(Request $request, $type)
    {

        Auth::guard($type)->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
