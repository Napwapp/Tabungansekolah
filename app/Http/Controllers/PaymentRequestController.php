<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentRequestController extends Controller
{
    public function index()
    {
        $transactions = collect(['transaksi_topup' => 'Top-up', 'transaksi_menabung_users' => 'Menabung', 'penarikan_users' => 'Penarikan'])
            ->map(function ($jenis, $table) {
                return DB::table($table)
                    ->where('status', 'Menunggu Persetujuan')
                    ->select('id', 'user_id', 'id_tabungan', 'namalengkap', 'kelas', 'jumlah', 'status', 'created_at')
                    ->addSelect(DB::raw("'$jenis' as jenis_transaksi"));
            })
            ->reduce(fn($carry, $query) => $carry ? $carry->union($query) : $query)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pointakses.admin.permintaan-transaksi', compact('transactions'));
    }

    public function updateTransaksi($id, $status, Request $request)
    {
        $jenis = $request->input('jenis_transaksi');
        $table = $this->getTableName($jenis);

        if (!$table) {
            return response()->json(['success' => false, 'message' => 'Jenis transaksi tidak valid!'], 400);
        }

        $transaksi = DB::table($table)->where('id', $id)->first();
        if (!$transaksi || $transaksi->status !== 'Menunggu Persetujuan') {
            return response()->json(['success' => false, 'message' => 'Transaksi tidak valid atau sudah diproses!'], 400);
        }

        $tabungan = DB::table('tabungan_users')->where('user_id', $transaksi->user_id)->first();
        if (!$tabungan) {
            return response()->json(['success' => false, 'message' => 'Data tabungan tidak ditemukan!'], 404);
        }

        $jenis = $request->input('jenis_transaksi'); // Simpan nilai $jenis sebelum transaksi

        DB::transaction(function () use ($transaksi, $table, $status, $jenis) {
            if ($status === 'Sukses') {
                $this->updateSaldo($transaksi, $table);
            }

            // Update status transaksi
            $transaksiData = DB::table($table)->where('id', $transaksi->id)->first();

            $updateData = [
                'status' => $status,
                'updated_at' => now(),
            ];

            if ($transaksiData->deleted_at !== null) {
                $updateData['deleted_at'] = null;
            }

            DB::table($table)->where('id', $transaksi->id)->update($updateData);


            // Judul yg diupdate
            $judul_messages = [
                'transaksi_topup' => [
                    'Sukses' => 'Top-Up Saldo Berhasil',
                    'Gagal' => 'Top-Up Saldo Gagal'
                ],
                'transaksi_menabung_users' => [
                    'Sukses' => 'Berhasil Menabung',
                    'Gagal' => 'Gagal Menabung'
                ],
                'penarikan_users' => [
                    'Sukses' => 'Berhasil Menarik Tabungan',
                    'Gagal' => 'Gagal Menarik Tabungan'
                ]
            ];

            // Pesan yg diupdate
            $messages = [
                'transaksi_topup' => [
                    'Sukses' => 'Top-Up Saldo telah disetujui dan Berhasil. Saldo berhasil ditambahkan',
                    'Gagal' => 'Transaksi Gagal, Transaksi ditolak oleh admin.'
                ],
                'transaksi_menabung_users' => [
                    'Sukses' => 'Berhasil Menabung. Saldomu berhasil ditabung!.',
                    'Gagal' => 'Transaksi Menabung Gagal, Transaksi ditolak oleh admin.'
                ],
                'penarikan_users' => [
                    'Sukses' => 'Berhasil Menarik Tabungan. Selamat menikmati hasil Tabunganmu',
                    'Gagal' => 'Pengajuan Penarikan Gagal. Transaksi ditolak oleh admin.'
                ]
            ];

            $judulBaru = $judul_messages[$table][$status];

            // Update notifikasi untuk transaksi yang relevan
            $affected = DB::table('notifikasi_users')
                ->where('user_id', $transaksi->user_id)
                ->where('tipe', 'Transaksi')
                ->where('judul', 'like', "%" . $jenis . "%")
                ->whereNull('deleted_at') // Update hanya jika belum dihapus
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->update([
                    'judul' => $judulBaru,
                    'isi_pesan' => $messages[$table][$status],
                    'status_transaksi' => $status,
                    'status' => 'Belum Dibaca',
                    'updated_at' => now(),
                ]);

            if ($affected == 0) {
                // Coba update notifikasi yang sudah dihapus (restore)
                $affected = DB::table('notifikasi_users')
                    ->where('user_id', $transaksi->user_id)
                    ->where('tipe', 'Transaksi')
                    ->where('judul', 'like', "%" . $jenis . "%")
                    ->whereNotNull('deleted_at') // Cari notifikasi yang sudah dihapus
                    ->orderBy('created_at', 'desc')
                    ->limit(1)
                    ->update([
                        'deleted_at' => null, // Restore notifikasi
                        'judul' => $judulBaru,
                        'isi_pesan' => $messages[$table][$status],
                        'status_transaksi' => $status,
                        'status' => 'Belum Dibaca',
                        'updated_at' => now(),
                    ]);
            }

            // Jika masih tidak ada yang diperbarui, baru buat notifikasi baru
            if ($affected == 0) {
                DB::table('notifikasi_users')->insert([
                    'user_id' => $transaksi->user_id,
                    'nama_pengirim' => 'Tabungan sekolah',
                    'foto_pengirim' => null,
                    'judul' => $judulBaru,
                    'isi_pesan' => $messages[$table][$status],
                    'status' => 'Belum Dibaca',
                    'tipe' => 'Transaksi',
                    'status_transaksi' => $status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        return response()->json(['success' => true, 'message' => "Berhasil Men$status kan Transaksi!", 'new_status' => $status, 'id' => $id]);
    }

    private function updateSaldo($transaksi, $table)
    {
        $user_id = $transaksi->user_id;
        $jumlah = $transaksi->jumlah;
        $tabungan = DB::table('tabungan_users')->where('user_id', $user_id)->first();

        if (!$tabungan) {
            throw new \Exception('Data tabungan tidak ditemukan untuk user ini!');
        }

        $updates = match ($table) {
            'transaksi_topup' => ['saldo' => $tabungan->saldo + $jumlah],
            'transaksi_menabung_users' => ['saldo' => $tabungan->saldo - $jumlah, 'total_tabungan' => $tabungan->total_tabungan + $jumlah],
            'penarikan_users' => ['total_tabungan' => $tabungan->total_tabungan - $jumlah],
            default => []
        };

        if ($updates) {
            DB::table('tabungan_users')->where('user_id', $user_id)->update(array_merge($updates, ['updated_at' => now()]));
        }
    }

    private function getTableName($jenis)
    {
        return match ($jenis) {
            'Top-up' => 'transaksi_topup',
            'Menabung' => 'transaksi_menabung_users',
            'Penarikan' => 'penarikan_users',
            default => null,
        };
    }
}
