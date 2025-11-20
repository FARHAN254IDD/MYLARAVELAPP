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
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);


        $credentials = $request->only('email', 'password', 'role');

    $user = \App\Models\User::where('email', $credentials['email'])
        ->where('role', $credentials['role'])
        ->first();

    if (! $user || ! \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
        return back()->withErrors([
            'email' => 'These credentials do not match our records or role.',
        ]);
    }

    Auth::login($user);

    // Redirect by role
    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'blogger':
            return redirect()->route('blogger.dashboard');
        case 'tester':
            return redirect()->route('tester.dashboard');
        default:
            return redirect()->route('user.dashboard');
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
