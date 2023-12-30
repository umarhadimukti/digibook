<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('login.index', [
            'title' => 'Masuk',
        ]);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // jika email dan password sesuai dengan yang ada di database
        if (Auth::attempt($credentials)) {
            // buat ulang session login
            $request->session()->regenerate();

            if (Auth::user()->role_id == 1) {
                return redirect()->route('admin.dashboard.books');
            } else {
                return redirect()->route('user.dashboard.books');
            }
        }

        // jika email atau password salah, kirim session error
        return back()->with('error', 'email atau password salah');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
