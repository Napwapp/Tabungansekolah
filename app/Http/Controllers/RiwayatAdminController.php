<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiTopup;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;

class RiwayatAdminController extends Controller
{
    public function riwayatadmin()
    {
        $topup = TransaksiTopup::where('status', 'Menunggu Persetujuan')->get();
        $menabung = TransaksiMenabungUser::where('status', 'Menunggu Persetujuan')->get();
        $penarikan = PenarikanUser::where('status', 'Menunggu Persetujuan')->get();

        return view('pointakses.admin.riwayatadmin', compact('topup', 'menabung', 'penarikan'));
    }

    public function updateStatus($id, $type, $status)
    {
        if (!in_array($status, ['Sukses', 'Gagal'])) {
            return redirect()->back()->with('error', 'Status tidak valid!');
        }

        switch ($type) {
            case 'topup':
                $transaksi = TransaksiTopup::findOrFail($id);
                break;
            case 'menabung':
                $transaksi = TransaksiMenabungUser::findOrFail($id);
                break;
            case 'penarikan':
                $transaksi = PenarikanUser::findOrFail($id);
                break;
            default:
                return redirect()->back()->with('error', 'Jenis transaksi tidak valid!');
        }

        $transaksi->update(['status' => $status]);

        return redirect()->back()->with('success', 'Status transaksi diperbarui!');
    }
}
