<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtpController extends Controller
{
    public function atp(){
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            // Panggil method getUserLimit() untuk mendapatkan data batas penggunaan
            // $userLimit = $this->getUserLimit();

            // Teruskan data pengguna dan batas penggunaan ke view
            return view('generates.generatesAtp', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }
}
