<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function index()
    {
        // Jika user sudah login, arahkan langsung ke halaman dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * Memproses percobaan login.
     */
    public function authenticate(Request $request)
    {
        // 1. Validasi input dari form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek apakah kotak "Remember Me" dicentang
        $remember = $request->has('remember');

        // 3. Lakukan percobaan login
        if (Auth::attempt($credentials, $remember)) {
            // Jika berhasil, regenerasi session untuk mencegah serangan session fixation
            $request->session()->regenerate();

            // Arahkan ke halaman dashboard (atau halaman yang ingin dituju sebelum terlempar ke login)
            return redirect()->intended('/')->with('success', 'Selamat datang kembali!');
        }

        // 4. Jika gagal, kembalikan ke halaman login beserta pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email'); // Tetap pertahankan isian email agar user tidak perlu mengetik ulang
    }

    /**
     * Memproses logout user.
     */
    public function logout(Request $request)
    {
        // Logout user dari sistem
        Auth::logout();

        // Hapus semua data di session
        $request->session()->invalidate();

        // Regenerasi token CSRF untuk keamanan
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}