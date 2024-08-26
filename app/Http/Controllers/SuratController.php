<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function surat()
    {
        // Periksa apakah kunci 'user' ada dalam sesi
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            // Teruskan data pengguna dan batas penggunaan ke view
            return view('generates.generateModulAjar', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }
}
