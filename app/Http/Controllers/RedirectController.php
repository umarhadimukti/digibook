<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{
    public function check(): RedirectResponse
    {
        if (Auth::user()->role_id == 1) {
            return redirect()->route('user.dashboard.profile');
        } else {
            return redirect()->route('user.dashboard.books');
        }
    }
}
