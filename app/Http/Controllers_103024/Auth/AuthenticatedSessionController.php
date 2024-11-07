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
        $user = Auth::user();
        $sessionData = [
            'user_id' => $user->id,
            'user_name' => $user->firstname,
            'first_name_initial' => substr($user->name, 0, 1),
        ];

        $sessionData = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'first_name_initial' => substr($user->name, 0, 1),
            // Add other user attributes as needed
        ];

        session($sessionData);
        return redirect()->intended(route('dashboard'));
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Auth::logout();
         return redirect('/');
    }
}
