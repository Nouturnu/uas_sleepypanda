<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Panggil Model User biar bisa akses database

class DashboardController extends Controller
{
    // 1. Fungsi untuk Halaman Dashboard Utama (Grafik)
    public function index() {
        return view('dashboard');
    }

    // 2. Fungsi untuk Halaman Tabel User (YANG AKAN KITA KERJAKAN)
    public function users() {
        // Ambil semua data user dari database
        $users = User::all(); 
        
        // Kirim data $users ke tampilan 'user-data'
        return view('user-data', compact('users'));
    }

    // 3. Fungsi Placeholder (Jurnal & Report)
    public function jurnal() {
        return view('jurnal');
    }
    
    public function report() {
        return view('report');
    }
}