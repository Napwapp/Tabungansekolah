<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabungan Siswa</title>

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/tabungan/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/tabungan/assets/images/logo/logosekolah.png')}}" type="image/png">

    <link rel="stylesheet" href="{{asset('dashboard/dist/tabungan/assets/css/tabungansiswa.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/default.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app-dark.css')}}">

</head>

<body>
    <div id="app">
        <!-- sidebar -->
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <img src="{{asset('dashboard/dist/assets/images/logo/logoSMK_.png')}}" alt="Logo" srcset="" style="width: 50px; height: auto; max-width: 100%;">
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
                            class="sidebar-item">
                            <a href="{{route('user')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Beranda</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item ">
                            <a href="{{route('profile')}}" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Profil</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item active">
                            <a href="{{route('tabungan')}}" class='sidebar-link'>
                                <i class="bi bi-wallet-fill"></i>
                                <span>Tabungan</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item  ">
                            <a href="{{route('riwayat')}}" class='sidebar-link'>
                                <i class="bi bi-clock-fill"></i>
                                <span>Riwayat Transaksi</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a href="{{ route('contact') }}" class="sidebar-link">
                                <i class="bi bi-envelope-fill"></i>
                                <span>Pesan</span>
                                @if (!Request::is('contact') && isset($unreadCount) && $unreadCount > 0)
                                <span class="badge-notif">
                                    <h2>{{ $unreadCount }}</h2>
                                </span>
                                @endif
                            </a>
                        </li>

                        <li
                            class="sidebar-item  ">
                            <a href="{{route('sendmassage')}}" class='sidebar-link'>
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <span>Laporkan & Saran</span>
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
        </div>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <p><!-- Content -->
            <div class="content" style="margin-left: 30px;">
                <h2 class="mb-4">Informasi Tabungan Anda</h2>

                <!-- Kartu Informasi -->
                <div class="row card-btn-row">
                    <!-- Saldo Tersisa Card and Button -->
                    <div class="col-md-4 card-btn-column">
                        <div class="card bg-warning text-white mb-2 equal-height-card">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-white">Saldo Tersisa</h5>
                                <h3 class="text-white mb-2">Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
                                <p class="card-footer-text">Saldo yang anda miliki</p>
                            </div>
                        </div>
                        <a href="{{route('plus')}}" class="btn-link mt-2 mb-4">
                            <button class="btn-action btn-yellow equal-height-btn" type="button">
                                <img class="icon-btn" src="{{asset ('dashboard/dist/assets/images/icons/icons8-plus-50.png')}}" alt="">
                                <span class="btn-text">Tambah Saldo</span>
                            </button>
                        </a>
                    </div>

                    <!-- Total Tabungan Card and Button -->
                    <div class="col-md-4 card-btn-column">
                        <div class="card bg-primary text-white mb-2 equal-height-card">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-white">Total Tabungan Anda</h5>
                                <h3 class="text-white mb-2">Rp {{ number_format($totalTabungan, 0, ',', '.') }}</h3>
                                <p class="card-footer-text">Tabungan hingga saat ini.</p>
                            </div>
                        </div>
                        <a href="{{route('menabung')}}" class="btn-link mt-2 mb-4">
                            <button class="btn-action btn-blue equal-height-btn" type="button">
                                <img class="icon-btn" src="{{asset ('dashboard/dist/assets/images/icons/icons8-money-32.png')}}" alt="">
                                <span class="btn-text">Menabung</span>
                            </button>
                        </a>
                    </div>

                    <!-- Penarikan Card and Button -->
                    <div class="col-md-4 card-btn-column">
                        <div class="card bg-success text-white mb-2 equal-height-card">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-white">Penarikan Bulan Ini</h5>
                                <h3 class="text-white mb-2">Rp {{ number_format($penarikanDisetujuiBulanIni, 0, ',', '.') }}</h3>
                                <p class="card-footer-text">Total Penarikan Anda bulan ini.</p>
                            </div>
                        </div>
                        <a href="{{route('menarik')}}" class="btn-link mt-2 mb-4">
                            <button class="btn-action btn-green equal-height-btn" type="button">
                                <img class="icon-btn" src="{{asset ('dashboard/dist/assets/images/icons/icons8-withdraw-money-32.png')}}" alt="">
                                <span class="btn-text">Tarik Tabungan</span>
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Target Tabungan -->
                <h2 class="target-tabungan-title" style="margin-top: 80px;">Selesaikan targetmu, Amankan masa depanmu</h2>
                <p class="target-tabungan-desc">Kamu dapat melihat progres tabunganmu disini. Sesuai dari target yg kamu atur sebelumnya.</p>

                <div class="target-tabungan" style="margin-bottom: 50px;">
                    <div class="target-circle">
                        <svg class="progress-ring" width="120" height="120">
                            <circle class="ring-bg" cx="60" cy="60" r="54"></circle>
                            <circle class="ring-progress" cx="60" cy="60" r="54" stroke-linecap="round"></circle>
                        </svg>
                        <p class="progress-percentage">0%</p>
                    </div>
                    <p class="target-info">
                        <strong>Target Tabungan:</strong>
                        @if ($targetTabungan > 0)
                        Rp {{ number_format($targetTabungan, 0, ',', '.') }}
                        @else
                        <span>Belum memiliki target</span>
                        @endif
                        <i id="icon-target-tercapai" class="bi bi-check-circle-fill text-success" style="display: none;"></i>
                    </p>
                    <!-- Menyembunyikan total tabungan dan target tabungan untuk diakses JS -->
                    <p id="total-tabungan" data-total="{{ $totalTabungan ?? 0 }}" style="display: none;"></p>
                    <p id="target-tabungan" data-target="{{ $targetTabungan ?? 0 }}" style="display: none;"></p>
                </div>

                <!-- Grafik Tabungan -->
                <!-- akan menghitung data total tabungan Pengguna setiap bulannya -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Perkembangan Tabungan Anda</h5>
                        <canvas id="tabunganChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            <!-- Pastikan Chart.js sudah dimuat -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            @vite(['resources/js/app.js'])


            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    fetch('/tabungan/bulanan') // Panggil API dari Laravel
                        .then(response => response.json())
                        .then(data => {
                            const bulanLabels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            const tabunganData = data.map(item => item.total_tabungan); // Ambil total tabungan sesuai bulan

                            // Buat Chart.js
                            const ctx = document.getElementById('tabunganChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: bulanLabels,
                                    datasets: [{
                                        label: 'Jumlah Tabungan',
                                        data: tabunganData,
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 2,
                                        fill: true
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        })
                        .catch(error => console.error('Error:', error));
                });
            </script>

            <footer style="margin-top: 15px;">
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2025 XI RPL, SMKN1 BINONG SUBANG</p>
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

        <script src="{{asset('dashboard/dist/tabungan/assets/js/tabungansiswa.js')}}"></script>
        <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
        <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>

        <!-- myjs -->
        <script src="{{asset('dashboard/dist/assets/js/myjs/target-tabungan.js')}}"></script>
    </div>
</body>

</html>