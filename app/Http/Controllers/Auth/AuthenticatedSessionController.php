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
        if (request()->routeIs('display.login')) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
        }
        $page_title = 'Login';
        $page_description = 'Halaman Login';
        return view('pages.auth.login', compact('page_title', 'page_description'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // Login baru
        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->user();

        // Jika user role display → ke display
        if ($user && $user->role === 'display') {
            return redirect()->route('display');
        }

        // Selain display → ke dashboard
        return redirect()->intended(route('dashboard.index'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout dua guard untuk keamanan
        Auth::guard('web')->logout();
        // Auth::guard('display')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
