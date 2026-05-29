<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

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
        // DEBUG: Log la tentative
        Log::info('=== TENTATIVE DE LOGIN ===');
        Log::info('Email: ' . $request->email);
        Log::info('Session avant: ' . session()->getId());

        // Tentative d'authentification
        $credentials = $request->only('email', 'password');
        Log::info('Credentials: ', $credentials);

        if (Auth::attempt($credentials)) {
            Log::info('Auth SUCCESS pour: ' . $request->email);
            Log::info('User ID: ' . Auth::id());
            Log::info('Session après attempt: ' . session()->getId());

            // Force la session à sauvegarder
            session()->put('auth_user_id', Auth::id());
            session()->save();
            Log::info('Session sauvegardée avec user_id: ' . session()->get('auth_user_id'));

            $request->session()->regenerate();
            Log::info('Session après regenerate: ' . session()->getId());

            return redirect()->intended(route('dashboard', absolute: false));
        }

        Log::error('Auth FAILED pour: ' . $request->email);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
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
