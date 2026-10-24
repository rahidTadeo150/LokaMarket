<?php

namespace App\Providers;

use App\View\composers\CustomerLayoutComposer;
use App\View\Composers\SellerLayoutComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Midtrans\Config as MidtransConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        MidtransConfig::$serverKey = config('services.midtrans.server_key');
        MidtransConfig::$isProduction = (bool) config('services.midtrans.is_production');
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;

        View::composer(
            'components.navbar-user',
            CustomerLayoutComposer::class
        );

        View::composer(
            'components.navbar-seller',
            SellerLayoutComposer::class
        );
    }
}
