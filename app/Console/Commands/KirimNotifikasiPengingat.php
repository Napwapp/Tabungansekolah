<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;
use App\Models\TransaksiMenabungUser;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\Log;

class KirimNotifikasiPengingat extends Command
{
    protected $signature = 'notifikasi:pengingat';
    protected $description = 'Mengirim notifikasi pengingat ke user yang belum menabung di bulan ini';

    public function handle()
    {
        // Gunakan timezone Jakarta
        $tanggalSekarang = Carbon::now('Asia/Jakarta');

        // Logging untuk debugging
        Log::info("Scheduler berjalan pada: " . $tanggalSekarang->toDateTimeString());

        // Cek apakah hari ini tanggal 25
        if ($tanggalSekarang->day == 25) {
            $tanggalAwalBulan = Carbon::now('Asia/Jakarta')->startOfMonth();
            $tanggal25 = Carbon::now('Asia/Jakarta')->setDay(25);

            // Ambil semua user
            $users = User::all();

            foreach ($users as $user) {
                // Cek apakah user sudah menabung bulan ini
                $sudahMenabung = TransaksiMenabungUser::where('user_id', $user->id)
                    ->whereBetween('created_at', [$tanggalAwalBulan, $tanggal25])
                    ->exists();

                if (!$sudahMenabung) {
                    // Jika belum menabung, kirim notifikasi
                    NotifikasiUser::create([
                        'user_id' => $user->id,
                        'nama_pengirim' => 'Tabungan Sekolah',
                        'foto_pengirim' => null,
                        'judul' => 'Jangan Lupa Menabung!',
                        'isi_pesan' => 'Hallo, Kamu belum menabung bulan ini. Jangan lupa menabung yaa! Untuk bekal masa depanmu. <a href="' . url('/Menabung') . '">Menabung di sini</a>',
                        'status' => 'Belum Dibaca',
                        'tipe' => 'Pengingat',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Logging jika berhasil kirim notifikasi
                    Log::info("Notifikasi dikirim ke user ID: " . $user->id);
                }
            }

            $this->info('Notifikasi pengingat berhasil dikirim.');
        } else {
            Log::info("Hari ini bukan tanggal 25. Scheduler tidak dijalankan.");
        }
    }
}
