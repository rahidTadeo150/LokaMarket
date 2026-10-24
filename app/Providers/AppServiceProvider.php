<?php

namespace App\Providers;

use App\View\composers\CustomerLayoutComposer;
use App\View\Composers\SellerLayoutComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
