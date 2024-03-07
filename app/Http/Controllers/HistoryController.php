<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{

    public function showHistoryModulAjar(){
        // Periksa apakah kunci 'user' ada dalam sesi
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            // Panggil method getHistory() untuk mendapatkan data riwayat
            $history = $this->historyModulAjar();

            return view('histories.modulAjar', compact('userData', 'history'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function historyModulAjar(){
        $token = session()->get('access_token');

        // Mengirim permintaan ke API dengan menyertakan token otorisasi
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://be.brainys.oasys.id/api/material/history');

        if($response->successful()){
            return $response->json()['data'];
        } else {
            return null;
        }
        }

        public function showHistorySyllabus(){
             // Periksa apakah kunci 'user' ada dalam sesi
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            // Panggil method getHistory() untuk mendapatkan data riwayat
            $history = $this->historySyllabus();

            return view('histories.syllabus', compact('userData', 'history'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
        }

        public function historySyllabus(){
            $token = session()->get('access_token');

            // Mengirim permintaan ke API dengan menyertakan token otorisasi
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('https://be.brainys.oasys.id/api/syllabus/history');

            if($response->successful()){
                return $response->json()['data'];
            } else {
                return null;
            }
        }
}

