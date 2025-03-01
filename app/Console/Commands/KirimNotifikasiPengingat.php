<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;
use App\Models\TransaksiMenabungUser;
use App\Models\NotifikasiUser;

class KirimNotifikasiPengingat extends Command
{
    protected $signature = 'notifikasi:pengingat';
    protected $description = 'Mengirim notifikasi pengingat ke user yang belum menabung di bulan ini';

    public function handle()
    {
        $tanggalAwalBulan = Carbon::now()->startOfMonth(); // Tanggal 1 bulan ini
        $tanggal25 = Carbon::now()->setDay(25); // Tanggal 25 bulan ini

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
            }
        }

        $this->info('Notifikasi pengingat berhasil dikirim.');
    }
}
