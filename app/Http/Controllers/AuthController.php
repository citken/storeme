<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller 
{
    // --- FITUR LOGIN ---
    public function showLogin() { 
        return view('auth.login'); 
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return Auth::user()->isAdmin() 
                ? redirect()->intended('/admin/dashboard') 
                : redirect()->intended('/dashboard');
        }
        
        return back()->withErrors(['email' => 'Kredensial yang diberikan tidak cocok dengan data kami.'])->onlyInput('email');
    }

    // --- FITUR REGISTER ---
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'whatsapp' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' butuh field 'password_confirmation' di UI
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'whatsapp' => $validated['whatsapp'],
            'password' => $validated['password'], // Akan di-hash otomatis oleh Model
            'role' => 'user' // Default ke user
        ]);

        // Langsung auto-login setelah register
        Auth::login($user);

        return redirect()->route('user.dashboard');
    }

    // --- FITUR LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}