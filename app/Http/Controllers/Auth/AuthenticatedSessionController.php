<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

        // If there was an intended URL (e.g. user tried to access a protected page), go there.
        // Otherwise, redirect based on the authenticated user's role to the correct dashboard.
        $intended = $request->session()->pull('url.intended');
        if ($intended) {
            return redirect()->to($intended);
        }

        $user = Auth::user();
        $rol = $user->rol->rol ?? null;
        if ($rol === 'administrador') {
            return redirect()->route('administrador.dashboard');
        }
        if ($rol === 'panadero') {
            return redirect()->route('panadero.dashboard');
        }

        // Default fallback
        return redirect('/');
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
    public function __construct()
    {
        $this->middleware('role.redirect')->only('store');
    }
}
