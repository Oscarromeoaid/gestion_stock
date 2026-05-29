<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RestoreSession
{
    public function handle(Request $request, Closure $next)
    {
        // Si l'utilisateur n'est pas authentifié mais a une session avec user_id
        if (!Auth::check() && session()->has('auth_user_id')) {
            $userId = session()->get('auth_user_id');
            Log::info('Restoring session pour user_id: ' . $userId);
            Auth::loginUsingId($userId);
        }

        return $next($request);
    }
}
