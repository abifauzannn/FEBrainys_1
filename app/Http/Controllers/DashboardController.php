<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function dashboard()
{
    \Log::info('Dashboard start: ' . microtime(true));

    ini_set('max_execution_time', 300);

    if (session()->has('user')) {
        \Log::info('Dashboard before view: ' . microtime(true));
        $userData = session('user');
        return view('dashboards.dashboard', compact('userData'));
    }

    return redirect('/login');
}

    public function getUserLimit()
    {

        $response = Http::withToken(session('access_token'))
            ->get(env('APP_API') . '/user-profile');

        if ($response->successful()) {
            $data = $response->json('data') ?? [];

            $userLimit = [
                'limit'        => $data['credits']['limit'] ?? 0,
                'used'         => $data['credits']['used'] ?? 0,
                'credit'       => $data['credits']['credit'] ?? 0,
                'package_name' => $data['package'][0]['package_name'] ?? 'Tidak ada paket aktif',
            ];

            session(['user_limit_cache' => $userLimit]);

            return response()->json($userLimit);
        }

        return response()->json(session('user_limit_cache', [
            'limit'        => 0,
            'used'         => 0,
            'credit'       => 0,
            'package_name' => 'Tidak ada paket aktif',
        ]));
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
