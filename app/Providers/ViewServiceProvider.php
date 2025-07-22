<?php

namespace App\Providers;

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {


        View::composer('langganan.extraCredit.extra-credit', function ($view) {
            $subscriptionController = new SubscriptionController();
            $credits = $subscriptionController->getExtraCredit();
            $view->with('credits', $credits);
        });


        View::composer('langganan.paket.bulanan', function ($view) {
            $response = Http::withToken(session()->get('access_token'))
                ->get(env('APP_API') . '/subscription/package');

            $packages = [];
            if ($response->successful()) {
                $data = $response->json();
                $packages = $data['data']['monthly'] ?? [];
            }

            $view->with('packages', $packages);
        });

        View::composer('langganan.paket.tahunan', function ($view) {
            $response = Http::withToken(session()->get('access_token'))
                ->get(env('APP_API') . '/subscription/package');

            $packages = [];
            if ($response->successful()) {
                $data = $response->json();
                $packages = $data['data']['annually'] ?? [];
            }

            $view->with('packages', $packages);
        });

        // Share the user limit data with the 'components.nav' view
        view()->composer('components.nav', function ($view) {
            $response = Http::withToken(session()->get('access_token'))
                ->get(env('APP_API') . '/user-profile');

            if ($response->successful()) {
                $data = $response->json()['data'];

                $userLimit = [
                    'limit' => $data['credits']['limit'] ?? null,
                    'used' => $data['credits']['used'] ?? null,
                    'credit' => $data['credits']['credit'] ?? null,
                    'package_name' => $data['package'][0]['package_name'] ?? 'Tidak ada paket aktif', // Ambil package pertama
                ];
            } else {
                $userLimit = null;
            }

            // Share data dengan view
            $view->with('userLimit', $userLimit);
        });
    }
}
