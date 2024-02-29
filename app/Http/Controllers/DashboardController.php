<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Periksa apakah kunci 'user' ada dalam sesi
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('syllabus.dashboard', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }


}
