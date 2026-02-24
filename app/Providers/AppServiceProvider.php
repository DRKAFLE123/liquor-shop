<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
     *
     * Global View Composer: shares $shop and $about across ALL blade views.
     *
     * ARCHITECTURE NOTE (Future Multi-Store):
     * ----------------------------------------
     * When migrating to multi-store support, replace the ::first() call
     * below with logic to resolve the active store by request domain/slug:
     *   $shop = \App\Models\StoreSetting::where('domain', request()->getHost())->first();
     */
    public function boot(): void
    {
        // Share $shop across all views using a View Composer for lazy loading.
        // This avoids querying the DB on artisan commands that don't need views.
        View::composer('*', function ($view) {
            if (Schema::hasTable('store_settings')) {
                $view->with('shop', \App\Models\StoreSetting::first());
            }
        });

        View::composer('*', function ($view) {
            if (Schema::hasTable('about_settings')) {
                $view->with('about', \App\Models\AboutSetting::first());
            }
        });

        View::composer('*', function ($view) {
            if (Schema::hasTable('categories')) {
                $view->with('categories', \App\Models\Category::orderBy('name')->get());
            }
        });
    }
}
