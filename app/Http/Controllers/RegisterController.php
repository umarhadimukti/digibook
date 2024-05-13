<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function index(): View
    {
        return view('register.index', [
            'title' => 'Register',
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'username' => 'required|min:3|max:50|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => 2,
        ]);

        return redirect()->route('login')->with('success', 'registrasi akun digibook berhasil, silahkan login');
    }
}
