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
        // Bagikan data notifikasi ke semua view yang menggunakan layout admin
        \Illuminate\Support\Facades\View::composer(['layouts.app', 'layouts.navigation'], function ($view) {
            $notifications = \App\Models\PriorityNotification::where('is_read', false)
                ->with('kunjungan.pengunjung')
                ->orderBy('created_at', 'desc')
                ->get();
            $view->with('notifications', $notifications);
        });
    }
}
