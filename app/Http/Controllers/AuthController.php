<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect sesuai role
            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    return redirect('/admin/kelola-user');
                case 'validator':
                    return redirect('/validator/input-kata');
                case 'kontributor':
                    return redirect('/kontributor/entry-kata');
                default:
                    return redirect('/');
            }
            
        }

        return back()->withErrors(['username' => 'username atau password salah.',])->onlyInput('username');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
