<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\NotifikasiUser;

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
        // Bagikan unread count ke setiap view jika user sudah login
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $unreadCount = NotifikasiUser::where('user_id', Auth::id())
                    ->where('status', 'Belum Dibaca')
                    ->count();
                $view->with('unreadCount', $unreadCount);
            }
        });
    }
}
