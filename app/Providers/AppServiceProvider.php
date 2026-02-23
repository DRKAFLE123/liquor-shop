<?php

namespace App\Providers;

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
        if (\Illuminate\Support\Facades\Schema::hasTable('store_settings')) {
            $shop = \App\Models\StoreSetting::first();
            \Illuminate\Support\Facades\View::share('shop', $shop);
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('about_settings')) {
            $about = \App\Models\AboutSetting::first();
            \Illuminate\Support\Facades\View::share('about', $about);
        }
    }
}
