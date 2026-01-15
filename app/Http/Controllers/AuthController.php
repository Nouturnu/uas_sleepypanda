<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Str;          
use App\Models\User;

class AuthController extends Controller
{
    // --- LOGIN ---
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi tidak boleh kosong!',
            'password.required' => 'Password wajib diisi tidak boleh kosong!',
        ]);

        // Validasi Domain @ganteng.com
        if (str_contains($request->email, '@ganteng.com')) {
             return back()->withErrors(['login_error' => 'username/password incorrect'])->withInput();
        }

        // Validasi Panjang Password (> 8 karakter)
        if (strlen($request->password) <= 8) {
            return back()->withErrors(['login_error' => 'username/password incorrect'])->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['login_error' => 'username/password incorrect'])->withInput();
    }

    // --- REGISTER ---
    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        // Validasi Domain
        if (str_contains($request->email, '@ganteng.com')) {
            return back()->withErrors(['email' => 'Domain ini tidak diizinkan'])->withInput();
        }
        // Validasi Panjang Password
        if (strlen($request->password) <= 8) {
             return back()->withErrors(['password' => 'Password harus lebih dari 8 karakter'])->withInput();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:9',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'hashed_password' => Hash::make($request->password),
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }

    // --- LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // --- FORGOT PASSWORD ---
    public function showForgotPasswordForm() {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request) {
        // Validasi Sesuai S&K
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'email tidak boleh kosong', 
            'email.email' => 'Email Anda Salah',    
            'email.exists' => 'Email Anda Salah'    
        ]);

        // 1. Cari user
        $user = User::where('email', $request->email)->first();

        // 2. Buat Password Baru 
        // --- PERBAIKAN DI SINI ---
        // Kita ubah jadi 10 karakter agar lolos validasi Login (harus > 8)
        $new_password = Str::random(10); 
        // -------------------------

        // 3. Simpan password baru ke database (di-hash)
        $user->password = Hash::make($new_password);
        $user->save();

        // 4. Kirim Email berisi password mentah (Simulasi SMTP)
        try {
            Mail::raw("Halo $user->name, \n\nPermintaan reset password diterima.\nPassword/OTP baru Anda adalah: $new_password \n\nSilakan login dengan password ini.", function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Password Baru & OTP');
            });

            return back()->with('status', 'Password baru telah dikirim ke email Anda!');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email (Cek koneksi SMTP).']);
        }
    }
}