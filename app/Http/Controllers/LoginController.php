<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        $settingItem = SettingModel::first();
        return view('auth.login', [
            'title' => 'Login',
            'settingItem' => $settingItem,
        ]);
    }

    public function login_proses(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ], [
            'email.exists' => 'Email tidak terdaftar.',
            'password.required' => 'Password harus diisi.',
        ]);

        // Ambil user berdasarkan email
        $user = DB::table('users')->where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->with('loginError', 'Email tidak terdaftar.');
        }

        // Cek jika akun terblokir
        if ($user->blokir) {
            return back()->with('loginError', 'Akun Anda telah terblokir. Silahkan hubungi admin.');
        }

        // Cek password dan percobaan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Reset login attempts setelah login berhasil
            DB::table('users')->where('email', $credentials['email'])->update(['salah_password' => 0]);

            return redirect()->route('dashboard');
        } else {
            // Increment failed login attempts
            DB::table('users')->where('email', $credentials['email'])->increment('salah_password');

            // Ambil user terbaru untuk mengecek jumlah percobaan login
            $user = DB::table('users')->where('email', $credentials['email'])->first();
            
            // Cek sisa percobaan login
            $remainingAttempts = 3 - $user->salah_password;

            if ($user->salah_password >= 3) {
                DB::table('users')->where('email', $credentials['email'])->update(['blokir' => true]);
                return back()->with('loginError', 'Akun Anda telah terblokir setelah 3 kali percobaan login gagal.');
            }

            return back()->with('loginError', 'Login Gagal! Sisa percobaan login: ' . $remainingAttempts);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
