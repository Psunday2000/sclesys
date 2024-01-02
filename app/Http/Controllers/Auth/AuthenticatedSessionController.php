<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return $this->redirectBasedOnRole(Auth::user()->role_id);
    }

    /**
     * Redirect users based on their role after authentication.
     */
    protected function redirectBasedOnRole($roleId): RedirectResponse
    {
        switch ($roleId) {
            case 1: // Superadmin
                return redirect()->intended('/superadmin/dashboard');
                break;

            case 2: // Admin
                return redirect()->intended('/admin/dashboard');
                break;

            case 3: // Staff
                return redirect()->intended('/staff/dashboard');
                break;

            case 4: // Student
                return redirect()->intended('/student/dashboard');
                break;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
