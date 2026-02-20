<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view) {
            $view->with('siteSettings', \App\Models\SiteSetting::find(1));
            $view->with('adminsCount', (int) \App\Models\Admin::count());
            $view->with('brandsForFooter', 2);
            $view->with('headerNotification', 1);
        });
    }
}
