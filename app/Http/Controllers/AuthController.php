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

        // Auth::attempt secara otomatis akan mencocokkan input 'password' 
        // dengan kolom 'hashed_password' karena sudah kita atur di Model User.
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
        if (str_contains($request->email, '@ganteng.com')) {
            return back()->withErrors(['email' => 'Domain ini tidak diizinkan'])->withInput();
        }

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

        // Menggunakan kolom hashed_password sesuai struktur database
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

    // --- FORGOT PASSWORD & OTP GENERATION ---
    public function showForgotPasswordForm() {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'email tidak boleh kosong', 
            'email.email' => 'Email Anda Salah',    
            'email.exists' => 'Email Anda Salah'    
        ]);

        $user = User::where('email', $request->email)->first();

        // 1. Buat Password Baru (> 8 karakter)
        $new_password = Str::random(10); 

        // 2. Buat Kode OTP (6 Digit) untuk kolom otp_code
        $otp = rand(100000, 999999);

        // 3. Simpan ke database menggunakan nama kolom yang benar
        // Perbaikan: Menggunakan hashed_password agar tidak error "Column not found"
        $user->hashed_password = Hash::make($new_password);
        $user->otp_code = $otp; 
        $user->save();

        // 4. Kirim Email (Simulasi OTP & Password Baru)
        try {
            Mail::raw("Halo $user->name, \n\nPermintaan reset password diterima.\nOTP Verifikasi Anda adalah: $otp \nPassword Baru Anda adalah: $new_password \n\nSilakan verifikasi OTP terlebih dahulu sebelum login.", function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Kode OTP & Password Baru');
            });

            // Alihkan ke halaman verifikasi OTP
            return redirect()->route('otp.view')->with('status', 'Kode OTP telah dikirim ke email Anda!');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email (Cek koneksi SMTP).']);
        }
    }

    // --- FUNGSI BARU: VERIFIKASI OTP ---
    public function verifyOtp(Request $request) {
        $request->validate(['otp_code' => 'required|digits:6']);

        // Mencari user berdasarkan otp_code di database
        $user = User::where('otp_code', $request->otp_code)->first();

        if ($user) {
            // Berhasil: Kosongkan OTP agar tidak bisa dipakai ulang
            $user->otp_code = null;
            $user->save();
            
            return redirect()->route('login')->with('success', 'OTP Valid! Silakan login dengan password baru Anda.');
        }

        return back()->withErrors(['otp_error' => 'Kode OTP salah atau sudah kadaluwarsa!']);
    }
}