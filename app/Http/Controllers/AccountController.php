<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  

class AccountController extends Controller
{
    public function showAdminLoginForm()
{
    return view('auth.login'); // You'll need to create this view
}

public function adminLogin(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        if (Auth::user()->is_admin) {
            return redirect()->intended(route('admin.dashboard'));
        }

        Auth::logout();
        return back()->withErrors([
            'email' => 'You do not have admin privileges.',
        ]);
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


public function adminLogout(Request $request)
{
    Auth::logout();
    
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect('/admin/login');
}

}
