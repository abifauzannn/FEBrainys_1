<?php

namespace App\Providers;

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;
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

        View::composer('*', function($view){
            $infoPackage = new AuthenticationController();
            $namaPaket = $infoPackage->getInfoPackages();
            $view->with('infoPackage', $namaPaket);
        });

        View::composer('*', function ($view) {
            $userController = new DashboardController();
            $userLimit = $userController->getUserLimit();
            $view->with('userLimit', $userLimit);
        });

        View::composer('langganan.extraCredit.extra-credit', function ($view) {
            $subscriptionController = new SubscriptionController();
            $credits = $subscriptionController->getExtraCredit();
            $view->with('credits', $credits);
        });

        View::composer('langganan.paket.bulanan', function ($view) {
            $subscriptionController = app(SubscriptionController::class);
            $response = $subscriptionController->getPackages();

            // Extract the 'monthly' data from the response
            $monthlyPackages = $response['data']['monthly'] ?? [];

            // Share the 'monthlyPackages' with the view
            $view->with('monthlyPackages', $monthlyPackages);
        });

        View::composer('langganan.paket.tahunan', function ($view) {
            $subscriptionController = app(SubscriptionController::class);
            $response = $subscriptionController->getPackages();

            // Extract the 'monthly' data from the response
            $annuallyPackages = $response['data']['annually'] ?? [];

            // Share the 'annualyPackages' with the view
            $view->with('annuallyPackages', $annuallyPackages);
        });

        View::composer('langganan.tagihan.index', function ($view) {
            $subscriptionController = app(SubscriptionController::class);
            $response = $subscriptionController->getInfoPackages();

            // Extract the 'monthly' data from the response
            $packages = $response['data']['package'] ?? [];

            // Share the 'annualyPackages' with the view
            $view->with('packages', $packages);
        });
    }

}
