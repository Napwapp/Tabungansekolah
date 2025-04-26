<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class HapusLaporanTahunan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hapus:laporan-tahunan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Hapus semua laporan
        DB::table('laporan_users')->delete();

        // Hapus notifikasi dengan tipe 'Laporan' atau 'Saran'
        DB::table('notifikasi_users')
            ->whereIn('tipe', ['Laporan', 'Saran'])
            ->delete();

        $this->info('Semua laporan dan notifikasi laporan/saran berhasil dihapus.');
    }
}
