<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabungan Sekolah</title>

    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/logoSMK_.png')}}" type="image/x-icony">
    <link rel="shortcut icon" href="{{asset ('dashboard/dist/assets/images/logo/logosekolah.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset ('dashboard/dist/assets/css/mycss/dashboardadmin.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/shared/iconly.css')}}">
    <link rel="stylesheet" href="{{asset ('dashboard/dist/assets/css/mycss/default.css')}}">

    <link rel="stylesheet" href="{{asset ('dashboard/dist/assets/css/main/app-dark.css')}}">

    <!-- Template Mantis bootstrap -->
    <!-- [Favicon] icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/fonts/material.css') }}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{asset ('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/css/style-preset.css') }}">

    <!-- js -->
    <script src="{{asset ('dashboard/dist/assets/js/myjs/dashboard.js')}}"></script>


</head>

<body>
    <div id="app">
        <!-- sidebar -->
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.html"><img src="{{asset('dashboard/dist/assets/images/logo/logoSMK_.png')}}" alt="Logo" srcset="" style="width: 50px; height: auto; max-width: 100%;"></a>
                            <h1 style="font-size: 1rem; margin-top: 10px;">TABUNGAN SMKN 1 BINONG</h1>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li
                            class="sidebar-item active">
                            <a href="{{route('admin')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item">
                            <a href="{{route('profil')}}" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Profil</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item">
                            <a href="{{route('dataanggota')}}" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Daftar Anggota</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Tabungan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{route('kelasmin')}}">Data Tabungan Siswa</a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="sidebar-item  ">
                            <a href="{{route('riwayatadmin')}}" class='sidebar-link'>
                                <i class="bi bi-clock-history"></i>
                                <span>Riwayat Transaksi</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item  ">
                            <a href="{{route('permintaan-transaksi')}}" class='sidebar-link'>
                                <i class="bi bi-receipt"></i>
                                <span>Permintaan transaksi</span>
                                @if($pendingTransactions > 0)
                                <span class="badge-dot"></span>
                                @endif

                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('pesan') }}" class="sidebar-link">
                                <i class="bi bi-envelope-fill"></i>
                                <span>Pesan Masuk</span>
                                @if (isset($unreadLaporanCount) && $unreadLaporanCount > 0)
                                <span class="badge-notif">
                                    <h2>{{ $unreadLaporanCount }}</h2>
                                </span>
                                @endif
                            </a>
                        </li>

                        <li
                            class="sidebar-item  ">
                            <a href="{{route('seturl')}}" class='sidebar-link'>
                                <i class="bi bi-gear-fill"></i>
                                <span>Pengaturan</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                                @csrf
                                <button type="submit" class="sidebar-link btn-logout">
                                    <i class="bi bi-door-open-fill"></i>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>

                @if (session('error'))
                <div style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 10px;">
                    {{ session('error') }}
                </div>
                @endif

                <body>
                    <!-- Profil singkat -->
                    <div class="profil-container">
                        <div class="profil">
                            <div class="profil-picture">
                                <img src="{{ asset('picture/accounts/' . Auth::user()->gambar) }}" alt="Foto profil">
                            </div>
                            <div class="profil-detail"> <!-- Tambahkan div pembungkus -->
                                <h2 class="username">{{ Auth::user()->namalengkap }}</h2>
                                <p class="role">Role : <strong style="font-size: 16px; text-transform: capitalize;">{{ Auth::user()->role }}</strong></p>
                            </div>
                        </div>

                        <div class="profile-info">
                            <p><strong>Kelas:</strong> {{Auth::user() -> kelas}}</p>
                        </div>

                        <!-- Total Saldo dan Tabungan yang masuk -->

                        <div class="total-container">
                            <div class="total-box">
                                <h5 class="card-title" style="color: white;"><strong>Total Saldo Masuk</strong></h5>
                                <h3 style="color: white;">Rp {{ number_format($totalSaldoMasuk, 0, ',', '.') }}</h3>
                            </div>
                            <div class="total-box">
                                <h5 class="card-title" style="color: white;">Total Tabungan Masuk</strong></h5>
                                <h3 style="color: white;">Rp {{ number_format($totalTabunganMasuk, 0, ',', '.') }}</h3>
                            </div>
                        </div>
                    </div>

                    <p><!-- Content -->
                    <div class="content" style="margin-left: 30px;">
                        <h3>Informasi Pengguna</h3>

                        <!-- Kartu Informasi -->
                        <div class="row">
                            <!-- Card Total pengguna -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 f-w-400">Total Pengguna</h6>
                                        <h4 class="mb-3">
                                            {{ $totalUsers }}
                                            <span class="badge {{ $badgeClass }}">
                                                <i class="{{ $iconClass }}"></i> {{ $percentageChange }}%
                                            </span>
                                        </h4>
                                        <p class="mb-0 text-sm">
                                            Total Pengguna yang mendaftar {{ $trendStatus === 'naik' ? 'lebih' : 'kurang' }}
                                            <span class="{{ $textClass }}">{{ $selisihAbs }}</span> Tahun ini
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card total saldo -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 f-w-400">Total Saldo Masuk</h6>
                                        <h4 class="mb-3">
                                            {{ number_format($saldoTahunIni, 0, ',', '.') }}
                                            <span class="badge {{ $saldoBadgeClass }}">
                                                <i class="{{ $saldoIconClass }}"></i> {{ $saldoPersen }}%
                                            </span>
                                        </h4>
                                        <p class="mb-0 text-sm">
                                            Total Saldo yang masuk
                                            {{ $saldoStatus === 'naik' ? 'lebih' : 'kurang' }}
                                            <span class="{{ $saldoTextClass }}">{{ number_format($saldoSelisih, 0, ',', '.') }}</span> Tahun ini
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card total tabungan -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 f-w-400">Total Tabungan </h6>
                                        <h4 class="mb-3">
                                            {{ number_format($tabunganTahunIni, 0, ',', '.') }}
                                            <span class="badge {{ $tabunganBadgeClass }}">
                                                <i class="{{ $tabunganIconClass }}"></i>
                                                {{ $tabunganPersen }}%
                                            </span>
                                        </h4>
                                        <p class="mb-0 text-sm">
                                            Total Tabungan Masuk
                                            @if($tabunganStatus === 'naik')
                                            lebih besar
                                            <span class="{{ $tabunganTextClass }}">{{ number_format($tabunganSelisih, 0, ',', '.') }}</span>
                                            @else
                                            lebih kecil
                                            <span class="{{ $tabunganTextClass }}">{{ number_format($tabunganSelisih, 0, ',', '.') }}</span>
                                            @endif
                                            Tahun ini
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 f-w-400">Total Penarikan</h6>
                                        <h4 class="mb-3">
                                            {{ number_format($totalDitarikTahunIni, 0, ',', '.') }}
                                            <span class="badge {{ $penarikanBadgeClass }}">
                                                <i class="{{ $penarikanIconClass }}"></i>
                                                {{ $penarikanPersen }}%
                                            </span>
                                        </h4>
                                        <p class="mb-0 text-sm">
                                            Total Tabungan ditarik lebih
                                            <span class="{{ $penarikanTextClass }}">
                                                {{ number_format($penarikanSelisih, 0, ',', '.') }}
                                            </span>
                                            Tahun ini
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Grafik Perkembangan transaksi -->
                        <div class="row">
                            <!-- Bar Chart -->
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Data jumlah transaksi Tahun {{ $tahunSekarang }} </h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="bar-chart-1"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pie Chart Donut -->
                            <div class="col-md-5">
                                <div class="card ">
                                    <div class="card-header">
                                        <h5>Persentase data transaksi bulan {{ $bulanTerbaru }}</h5>
                                    </div>
                                    <div class="card-body">
                                        @php
                                        $totalDonut = $dataDonut['topup'] + $dataDonut['menabung'] + $dataDonut['penarikan'];
                                        @endphp

                                        @if ($totalDonut == 0)
                                        <div class="text-center">
                                            <strong>Tidak ada data transaksi</strong>
                                            <div class="mt-2 display-6">0%</div>
                                        </div>
                                        @else
                                        <div id="pie-chart-2" style="width: 100%"></div>
                                        @endif
                                    </div>
                                </div>
                                <h4 class="display-6 text-center mb-0">Data transaksi</h4>
                            </div>
                        </div>

                        <!-- Data untuk grafik -->
                        <script>
                            window.chartData = {
                                bulan: @json($bulan),
                                topup: @json($dataTopup),
                                menabung: @json($dataMenabung),
                                penarikan: @json($dataPenarikan)
                            };
                            // pie-chart
                            window.donutData = @json($dataDonut);

                            // chart data nominal transaksi
                            const labels = @json($bulanNominal);

                            const grafikTopup = @json($grafikTopup);
                            const grafikMenabung = @json($grafikMenabung);
                            const grafikPenarikan = @json($grafikPenarikan);
                        </script>

                        <!-- Grafik Tabungan -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Data perkembangan jumlah nominal transaksi masuk</h5>
                                <canvas id="tabunganChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </body>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2025 &copy;XI RPL, SMKN1 BINONG SUBANG</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted by
                                <a href="https://napwapp.github.io/Revisi-Portofolio-Mnawaf/" target="_blank">Nawaf</a>,
                                <a href="https://by-hp.github.io/Portofolio-Bayu/" target="_blank">Bayu</a>,
                                <a href="https://samuel1234-pp.github.io/revisi-portofoliosamuel/" target="_blank">Samuel</a>
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- chart js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('dashboard_admin/dist/assets/js/plugins/apexcharts.min.js') }}"></script>
        <script src="{{ asset('dashboard_admin/dist/assets/js/pages/chart-apex.js') }}"></script>

        <script src="{{asset ('dashboard/dist/assets/js/bootstrap.js')}}"></script>
        <script src="{{asset ('dashboard/dist/assets/js/app.js')}}"></script>

        <!-- js untuk grafik -->
        <script src="{{ asset('dashboard/dist/assets/js/chart/bar-chart.js') }}"></script>
        <script src="{{ asset('dashboard/dist/assets/js/chart/pie-chart.js') }}"></script>
        <script src="{{ asset('dashboard/dist/assets/js/chart/custom-chart.js') }}"></script>


        <!-- Template dashboard mastin -->
        <script src="{{ asset('dashboard_admin/dist/assets/js/plugins/popper.min.js') }}"></script>
        <script src="{{ asset('dashboard_admin/dist/assets/js/plugins/simplebar.min.js') }}"></script>
        <script src="{{ asset('dashboard_admin/dist/assets/js/plugins/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dashboard_admin/dist/assets/js/fonts/custom-font.js') }}"></script>
        <script src="{{ asset('dashboard_admin/dist/assets/js/pcoded.js') }}"></script>
        <script src="{{ asset('dashboard_admin/dist/assets/js/plugins/feather.min.js') }}"></script>

</body>

</html>