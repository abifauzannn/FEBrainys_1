<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Periksa apakah kunci 'user' ada dalam sesi
        ini_set('max_execution_time', 300);
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('dashboards.dashboard', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function getUserLimit()
    {
        return Cache::remember('limit_user', 10, function () {
            $response = Http::withToken(session()->get('access_token'))
                ->get(env('APP_API') . '/user-status');

            if ($response->successful()) {
                $data = $response->json()['data'];

                // Ambil hanya data 'limit' dan 'used' dari 'all'
                return [
                    'limit' => $data['all']['limit'] ?? null,
                    'used' => $data['all']['used'] ?? null,
                    'credit' => $data['all']['credit'] ?? null
                ];
            } else {
                return null;
            }
        });
    }


    public function getLimit()
    {
        return Cache::remember('limit_user', 10, function () {
            $response = Http::withToken(session()->get('access_token'))
                ->get(env('APP_API') . '/user-status');

            if ($response->successful()) {
                $data = $response->json()['data'];

                return response()->json([
                    'limit' => $data['all']['limit'] ?? 0,
                    'used' => $data['all']['used'] ?? 0,
                    'credit' => $data['all']['credit'] ?? 0
                ]);
            } else {
                return response()->json(['error' => 'Failed to fetch data'], 500);
            }
        });
    }
}
