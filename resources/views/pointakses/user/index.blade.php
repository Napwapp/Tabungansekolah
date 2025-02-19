<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tabungan Sekolah</title>

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/logo/favicon.png')}}" type="image/png">

    <link rel="stylesheet" href="{{asset ('dashboard/dist/assets/css/mycss/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/riwayat.css')}}">
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
                            <a href="{{route('user')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
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
                            class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Tabungan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{route('kelas')}}">Tabungan Kelas</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route('tabungan')}}">Tabunganku</a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="sidebar-item  ">
                            <a href="{{route('riwayat')}}" class='sidebar-link'>
                                <i class="bi bi-chat-dots-fill"></i>
                                <span>Riwayat Transaksi</span>
                            </a>
                        </li>


                        <li
                            class="sidebar-item  ">
                            <a href="{{route('contact')}}" class='sidebar-link'>
                                <i class="bi bi-envelope-fill"></i>
                                <span>Kontak Kami</span>
                            </a>
                        </li>

                        <!-- saya nonaktifkan (sementara) karna siapa tau penting suatu saat -->
                        <!-- <li
                            class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Layouts</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="layout-default.html">Default Layout</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-vertical-1-column.html">1 Column</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-vertical-navbar.html">Vertical Navbar</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-rtl.html">RTL Layout</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-horizontal.html">Horizontal Menu</a>
                                </li>
                            </ul>
                        </li>
                        -->

                        <!-- <li class="sidebar-title">Forms &amp; Tables</li>
                        
                        <li
                            class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-hexagon-fill"></i>
                                <span>Form Elements</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item ">
                                    <a href="form-element-input.html">Input</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-input-group.html">Input Group</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-select.html">Select</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-radio.html">Radio</a>
                                </li>
                                <li class="submenu-item active">
                                    <a href="form-element-checkbox.html">Checkbox</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-textarea.html">Textarea</a>
                                </li>
                                </li>
                            </ul>
                        </li> -->
                        <form action="{{route('logout')}}" method="post" type="submit" class="sidebar-item" style="margin-left: 15px; color:rgb(124, 141, 181)">
                            @csrf
                            <i class="bi bi-x-octagon-fill"></i>
                            <button style="border: none; padding: 10px; background-color: white;">Log Out</button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">

            @if (session('error'))
            <div style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
            @endif

            <!-- flash massage target tabungan -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <!-- end -->

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
                        <p><strong>ID Tabungan:</strong> {{ $idTabungan }}</p>
                        <p><strong>Kelas:</strong> {{Auth::user() -> kelas}}</p>
                    </div>

                    <!-- Target Tabungan -->
                    <div class="target-tabungan">
                        <div class="target-circle">
                            <svg class="progress-ring" width="120" height="120">
                                <circle class="ring-bg" cx="60" cy="60" r="54"></circle>
                                <circle class="ring-progress" cx="60" cy="60" r="54"></circle>
                            </svg>
                            <p class="progress-percentage">0%</p>
                        </div>
                        <p class="target-info"><strong>Target Tabungan:</strong> Rp {{ number_format($targetTabungan, 0, ',', '.') }}</p>
                        <button class="atur-target-btn">Atur Target</button>
                    </div>

                    <!-- Menyembunyikan total tabungan dengan menggunakan data-atribut untuk JS -->
                    <p id="total-tabungan" data-total="{{ $totalTabungan ?? 0 }}" style="display: none;"></p>
                    <p id="target-tabungan" data-target="{{ $targetTabungan ?? 0 }}" style="display: none;"></p>

                </div>

                <div class="modal" id="modalTarget">
                    <div class="modal-content">
                        <h2>Atur Target Tabungan</h2>

                        <form id="targetTabunganForm" action="{{ route('simpanTarget') }}" method="POST">
                            @csrf
                            <label for="targetAmount">Target Tabungan (Rp):</label>
                            <input
                                type="text"
                                name="target_amount"
                                id="targetAmount"
                                class="form-control"
                                placeholder="Masukkan target tabungan Anda"
                                min="1000"
                                step="1000"
                                required>

                            <button type="submit" class="save-btn">Simpan</button>
                            <button type="button" id="closeModal" class="close-btn">Tutup</button>
                        </form>



                    </div>
                </div>



                <p><!-- Content -->
                <div class="content" style="margin-left: 30px;">
                    <p>Selamat datang di dashboard dist/tabungan sekolah SMKN 1 BINONG</p>
                    <h2 class="mb-4">Informasi Tabungan Anda</h2>

                    <!-- Kartu Informasi -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: white;">Saldo Tersisa</h5> <!-- indeckend -->
                                    <h3 style="color: white;">Rp {{ number_format($saldo, 0, ',', '.') }}</h3> <!-- backend -->
                                    <p>Saldo yang anda miliki</p> <!-- backend -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body btn-green" style="border-radius: 10px;">
                                    <h5 class="card-title" style="color: white;">Total Tabungan Anda</h5> <!-- backend -->
                                    <h3 style="color: white;">Rp{{ number_format($totalTabungan, 0, ',', '.') }}</h3> <!-- backend -->
                                    <p>Tabungan hingga saat ini.</p> <!-- backend -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body btn-blue" style="border-radius: 10px;">
                                    <h5 class="card-title " style="color: white;">Penarikan Bulan Ini</h5> <!-- backend -->
                                    <h3 style="color: white;">Rp 0</h3> <!-- backend -->
                                    <p>Total Penarikan Anda bulan ini.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="row my-4">
                        <div class="col-md-4 text-center">
                            <a href="{{route('plus')}}">
                                <button class="btn-action btn-yellow" type="button">
                                    <img class="icon-btn" src="{{asset ('dashboard/dist/assets/images/icons/icons8-plus-50.png')}}" alt="">Tambah Saldo</button>
                            </a>
                        </div>
                        <div class="col-md-4 text-center">
                            <a href="{{route('menabung')}}">
                                <button class="btn-action btn-green" type="button">
                                    <img class="icon-btn" src="{{asset ('dashboard/dist/assets/images/icons/icons8-money-32.png')}}" alt="">Menabung</button>
                            </a>
                        </div>
                        <div class="col-md-4 text-center">
                            <a href="{{route('menarik')}}">
                                <button class="btn-action btn-blue" type="button">
                                    <img class="icon-btn" src="{{asset ('dashboard/dist/assets/images/icons/icons8-withdraw-money-32.png')}}" alt="">Tarik Tabungan</button>
                            </a>
                        </div>
                    </div>
                    <!-- Tombol setoran untuk memudahkan pengguna -->



                    <!-- Grafik Tabungan -->
                    <!-- akan menghitung data total tabungan Pengguna setiap bulannya -->
                    <div class="card bg-light text-dark mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Grafik Perkembangan Tabungan Anda</h5> <!-- backend -->
                            <canvas id="tabunganChart" height="100"></canvas>
                        </div>
                    </div>

                    <!-- Tabel Riwayat Transaksi -->
                    <section class="section">
                        <div class="row" id="table-contexual">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Riwayat Transaksi</h4>
                                    </div>
                                    <div class="card-content" style="padding-left: 20px; padding-right: 20px; padding-bottom: 20px;">
                                        <div class="table-responsive">
                                            <table class="table mb-0" id="riwayatTable">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Tanggal</th>
                                                        <th>Jumlah</th>
                                                        <th>Tipe</th>
                                                        <th>Nomor Tabungan</th>
                                                        <th style="text-align: center;">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($semuaTransaksiKosong)
                                                    <tr>
                                                        <td colspan="7" class="text-center">Belum ada transaksi.</td>
                                                    </tr>

                                                    @else
                                                    @foreach ($riwayatTransaksi as $transaksi)
                                                    <tr>
                                                        <td>{{ $transaksi->nama ?? '-' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d-m-Y H:i') }}</td>
                                                        <td>Rp{{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                                                        <td>{{ ucfirst($transaksi->tipe) }}</td>
                                                        <td>{{ $transaksi->id_tabungan ?? '-' }}</td>
                                                        <td style="text-align: center;">
                                                            @php
                                                            // Mapping status ke kelas CSS yang sesuai
                                                            $statusClass = [
                                                            'Sukses' => 'sukses',
                                                            'Menunggu Persetujuan' => 'diproses',
                                                            'Gagal' => 'gagal'
                                                            ];

                                                            // Pastikan status yang ada cocok dengan daftar status yang valid
                                                            $status = ucfirst(strtolower($transaksi->status));
                                                            $badgeClass = $statusClass[$status] ?? 'diproses';
                                                            @endphp

                                                            <span class="status-badge {{ $badgeClass }}">
                                                                {{ $status }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                    <!-- Baris khusus untuk menampilkan pesan jika filter tidak menemukan hasil -->
                                                    <tr id="noResultsRow" style="display: none;">
                                                        <td colspan="7" class="text-center">
                                                            Tidak dapat ditemukan
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>

                    </p>

                    <!-- Pastikan Chart.js sudah dimuat -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    @vite(['../../js/app.js'])

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

            </body>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2025 &copy; SMKN 1 BINONG</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="#">SMKN 1 BINONG</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{asset ('dashboard/dist/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset ('dashboard/dist/assets/js/app.js')}}"></script>

    <script src="{{asset ('dashboard/dist/assets/js/myjs/target-tabungan.js')}}"></script>
    <script src="{{asset ('dashboard/dist/assets/js/myjs/dashboard.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/myjs/riwayat.js')}}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>