<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use App\Models\TransaksiTopup;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Untuk perhitungan data perbulan
        $bulanIni = now()->month;
        // untuk mengambil tahunnya kita bisa memanfaatkan currentYear dibawah

        // Untuk perhitungan data pertahun
        $currentYear = now()->year;
        $lastYear = $currentYear - 1;

        // Hanya untuk ditampilkan diblade
        $tahunSekarang = Carbon::now()->year;

        // Total saldo masuk hari ini
        // Total saldo hari ini (termasuk yang soft deleted)
        $totalSaldoHariIni = TransaksiTopup::withTrashed()
            ->whereDate('created_at', Carbon::today())
            ->where('status', 'Sukses')
            ->sum('jumlah');

        // Total tabungan bulanan (termasuk yang soft deleted)
        $totalTabunganHariIni = TransaksiMenabungUser::withTrashed()
            ->whereDate('created_at', Carbon::today())
            ->where('status', 'Sukses')
            ->sum('jumlah');        

        // Jumlah user (menghitung semua datanya tanpna ada batas tanggal)
        $totalUsers = User::where('role', 'user')
            ->count();

        // Jumlah user (role = user) per tahun
        $userThisYear = User::where('role', 'user')
            ->whereYear('created_at', $currentYear)
            ->count();

        $userLastYear = User::where('role', 'user')
            ->whereYear('created_at', $lastYear)
            ->count();

        // Selisih pengguna
        $selisih = $userThisYear - $userLastYear;
        $trendStatus = $selisih >= 0 ? 'naik' : 'turun';
        $selisihAbs = abs($selisih);

        // Persentase perubahan
        if ($userLastYear > 0) {
            $percentageChange = round(($selisih / $userLastYear) * 100, 1);
        } else {
            $percentageChange = 100; // anggap naik 100% jika tahun sebelumnya 0
        }

        // Tentukan class warna dan ikon
        $badgeClass = 'bg-light-primary border border-primary';
        $textClass = 'text-primary';
        $iconClass = 'ti ti-trending-up';

        if ($trendStatus === 'turun') {
            $iconClass = 'ti ti-trending-down';

            if ($percentageChange <= 20) {
                // tetap pakai primary
                $badgeClass = 'bg-light-primary border border-primary';
                $textClass = 'text-primary';
            } elseif ($percentageChange <= 50) {
                $badgeClass = 'bg-light-warning border border-warning';
                $textClass = 'text-warning';
            } else {
                $badgeClass = 'bg-light-danger border border-danger';
                $textClass = 'text-danger';
            }
        }

        // Hitung total saldo tahun ini dengan perbandingan tahun lalu
        $saldoTahunIni = TransaksiTopup::withTrashed()
            ->where('status', 'Sukses')
            ->whereYear('created_at', $currentYear)
            ->sum('jumlah');

        $saldoTahunLalu = TransaksiTopup::withTrashed()
            ->where('status', 'Sukses')
            ->whereYear('created_at', $lastYear)
            ->sum('jumlah');


        // Hitung tren dan styling
        $saldoData = $this->hitungTren($saldoTahunIni, $saldoTahunLalu);

        // Hitung total tabungan per tahun dan perbandingan total tahun lalu
        $tabunganTahunIni = TransaksiMenabungUser::withTrashed()
            ->where('status', 'Sukses')
            ->whereYear('created_at', $currentYear)
            ->sum('jumlah');

        $tabunganTahunLalu = TransaksiMenabungUser::withTrashed()
            ->where('status', 'Sukses')
            ->whereYear('created_at', $lastYear)
            ->sum('jumlah');

        // Hitung tren tabungan
        $tabunganData = $this->hitungTren($tabunganTahunIni, $tabunganTahunLalu);

        // Hitung totak penarikan 
        $currentYear = now()->year;
        $lastYear = $currentYear - 1;

        // Total tabungan ditarik (status Sukses + termasuk soft deleted)
        $totalDitarikTahunIni = PenarikanUser::withTrashed()
            ->where('status', 'Sukses')
            ->whereYear('created_at', $currentYear)
            ->sum('jumlah');

        $totalDitarikTahunLalu = PenarikanUser::withTrashed()
            ->where('status', 'Sukses')
            ->whereYear('created_at', $lastYear)
            ->sum('jumlah');

        // Hitung tren penarikan
        $trenPenarikan = $this->hitungTren($totalDitarikTahunIni, $totalDitarikTahunLalu);


        // Perhitungan data jumlah transaksi untuk bar-chart

        // Top Up
        $dataTopup = TransaksiTopup::withTrashed()
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
            ->where('status', 'Sukses')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'bulan')
            ->toArray();

        // Menabung
        $dataMenabung = TransaksiMenabungUser::withTrashed()
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
            ->where('status', 'Sukses')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'bulan')
            ->toArray();

        // Penarikan
        $dataPenarikan = PenarikanUser::withTrashed()
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
            ->where('status', 'Sukses')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'bulan')
            ->toArray();

        $currentMonth = now()->month; // atau Carbon::now()->month
        $bulanAktif = range(1, $currentMonth); // hanya sampai bulan saat ini

        $namaBulan = [];
        $namaBulanLengkap = []; // Khusus untuk ditampilkan diblade
        $dataTopupGrafik = [];
        $dataMenabungGrafik = [];
        $dataPenarikanGrafik = [];

        foreach ($bulanAktif as $bulan) {
            $namaBulan[] = Carbon::create()->month($bulan)->format('M'); // Untuk Chart
            $namaBulanLengkap[] = Carbon::create()->month($bulan)->format('F'); // Untuk tampilan teks
            $dataTopupGrafik[] = $dataTopup[$bulan] ?? 0;
            $dataMenabungGrafik[] = $dataMenabung[$bulan] ?? 0;
            $dataPenarikanGrafik[] = $dataPenarikan[$bulan] ?? 0;
        }

        // Bulan terakhir dari array aktif
        $bulanTerbaru = end($namaBulanLengkap); // Ambil bulan terakhir untuk ditampilkan di judul

        // Perhitungan untuk data transaksi perbulan. digunakan di grafik donat
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Total transaksi Topup bulan ini
        $jumlahTopup = TransaksiTopup::withTrashed()
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('status', 'Sukses')
            ->count();

        // Total transaksi Menabung bulan ini
        $jumlahMenabung = TransaksiMenabungUser::withTrashed()
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('status', 'Sukses')
            ->count();

        // Total transaksi Penarikan bulan ini
        $jumlahPenarikan = PenarikanUser::withTrashed()
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('status', 'Sukses')
            ->count();

        // Buat array data untuk grafik donut
        $dataDonut = [
            'topup' => $jumlahTopup,
            'menabung' => $jumlahMenabung,
            'penarikan' => $jumlahPenarikan
        ];


        // Grafik yg menghitung jumlah nominal transaksi
        $dataTopupNominal = TransaksiTopup::withTrashed()
            ->selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total_nominal')
            ->whereYear('created_at', $currentYear)
            ->where('status', 'Sukses')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total_nominal', 'bulan')
            ->toArray();

        $dataMenabungNominal = TransaksiMenabungUser::withTrashed()
            ->selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total_nominal')
            ->whereYear('created_at', $currentYear)
            ->where('status', 'Sukses')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total_nominal', 'bulan')
            ->toArray();

        $dataPenarikanNominal = PenarikanUser::withTrashed()
            ->selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total_nominal')
            ->whereYear('created_at', $currentYear)
            ->where('status', 'Sukses')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total_nominal', 'bulan')
            ->toArray();

        foreach ($bulanAktif as $bulan) {
            $namaBulanNominal[] = Carbon::create()->month($bulan)->format('M');
            $grafikTopupNominal[] = $dataTopupNominal[$bulan] ?? 0;
            $grafikMenabungNominal[] = $dataMenabungNominal[$bulan] ?? 0;
            $grafikPenarikanNominal[] = $dataPenarikanNominal[$bulan] ?? 0;
        }

        return view('pointakses/admin/index', array_merge(
            compact(
                'totalSaldoHariIni',
                'totalTabunganHariIni',                
                'totalUsers',
                'userThisYear',
                'userLastYear',
                'selisihAbs',
                'percentageChange',
                'badgeClass',
                'textClass',
                'iconClass',
                'trendStatus',
                'bulanTerbaru',
                'tahunSekarang',
            ),
            [
                // Card 2 Total saldo
                'saldoTahunIni' => $saldoTahunIni,
                'saldoSelisih' => $saldoData['selisih'],
                'saldoStatus' => $saldoData['status'],
                'saldoPersen' => $saldoData['persen'],
                'saldoBadgeClass' => $saldoData['badgeClass'],
                'saldoTextClass' => $saldoData['textClass'],
                'saldoIconClass' => $saldoData['iconClass'],

                // Card 3 Total Tabungan
                'tabunganTahunIni'  => $tabunganTahunIni,
                'tabunganSelisih'   => $tabunganData['selisih'],
                'tabunganStatus'    => $tabunganData['status'],
                'tabunganPersen'    => $tabunganData['persen'],
                'tabunganBadgeClass' => $tabunganData['badgeClass'],
                'tabunganTextClass' => $tabunganData['textClass'],
                'tabunganIconClass' => $tabunganData['iconClass'],

                // Card 4 Total penarikan
                'totalDitarikTahunIni' => $totalDitarikTahunIni,
                'penarikanSelisih'     => $trenPenarikan['selisih'],
                'penarikanStatus'      => $trenPenarikan['status'],
                'penarikanPersen'      => $trenPenarikan['persen'],
                'penarikanBadgeClass'  => $trenPenarikan['badgeClass'],
                'penarikanTextClass'   => $trenPenarikan['textClass'],
                'penarikanIconClass'   => $trenPenarikan['iconClass'],

                // Untuk data perbulan
                'bulan' => $namaBulan,
                'dataTopup' => $dataTopupGrafik,
                'dataMenabung' => $dataMenabungGrafik,
                'dataPenarikan' => $dataPenarikanGrafik,

                // Untuk data di chart donat
                'dataDonut' => $dataDonut,

                // untuk data nominal transaksi
                'bulanNominal' => $namaBulanNominal,
                'grafikTopup' => $grafikTopupNominal,
                'grafikMenabung' => $grafikMenabungNominal,
                'grafikPenarikan' => $grafikPenarikanNominal,
            ]
        ));
    }

    // function reusable untuk menghitung selisih
    private function hitungTren($tahunIni, $tahunLalu)
    {
        $selisih = $tahunIni - $tahunLalu;
        $status = $selisih >= 0 ? 'naik' : 'turun';
        $selisihAbs = abs($selisih);

        if ($tahunLalu > 0) {
            $persen = round(($selisih / $tahunLalu) * 100, 1);
        } else {
            $persen = 100; // default jika tahun lalu 0
        }

        // default
        $badgeClass = 'bg-light-primary border border-primary';
        $textClass = 'text-primary';
        $icon = 'ti ti-trending-up';

        if ($status === 'turun') {
            $icon = 'ti ti-trending-down';

            if ($persen <= 20) {
                $badgeClass = 'bg-light-primary border border-primary';
                $textClass = 'text-primary';
            } elseif ($persen <= 50) {
                $badgeClass = 'bg-light-warning border border-warning';
                $textClass = 'text-warning';
            } else {
                $badgeClass = 'bg-light-danger border border-danger';
                $textClass = 'text-danger';
            }
        }

        return [
            'selisih' => $selisihAbs,
            'status' => $status,
            'persen' => $persen,
            'badgeClass' => $badgeClass,
            'textClass' => $textClass,
            'iconClass' => $icon,
        ];
    }
}
