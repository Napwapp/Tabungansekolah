<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\NotifikasiUser;
use App\Models\LaporanUser;

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

        // Bagikan unread count ke setiap view jika admin login
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->role == 'admin') { // Pastikan user adalah admin
                // Hitung jumlah laporan dengan status Terkirim
                $unreadLaporanCount = LaporanUser::where('status_laporan', 'Terkirim')->count();
                $view->with('unreadLaporanCount', $unreadLaporanCount);
            }
        });


        // Bagikan unread count ke setiap view jika user sudah login
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $unreadCount = NotifikasiUser::where('user_id', Auth::id())
                    ->where('status', 'Belum Dibaca')
                    ->count();
                $view->with('unreadCount', $unreadCount);
            }
        });

        View::composer('*', function ($view) {
            $pendingTransactions = DB::table('transaksi_topup')->where('status', 'Menunggu Persetujuan')->count() +
                DB::table('transaksi_menabung_users')->where('status', 'Menunggu Persetujuan')->count() +
                DB::table('penarikan_users')->where('status', 'Menunggu Persetujuan')->count();

            $view->with('pendingTransactions', $pendingTransactions);
        });
    }
}
