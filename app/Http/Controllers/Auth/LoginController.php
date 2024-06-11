<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class LoginController extends Controller
{
    public function authenticated(Request $request, $user)
    {
        // Redirect based on user role
        if ($user->hasRole('superadmin')) {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->hasRole('admin1')) {
            return redirect()->route('admin1.dashboard');
        } else {
            // Handle other roles accordingly, or provide a default redirect
            return redirect('/default-route');
        }
    }
}