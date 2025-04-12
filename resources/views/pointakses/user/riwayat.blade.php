<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Riwayat Transaksi</title>

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/logo/favicon.png')}}" type="image/png">

    <!-- my style -->
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/riwayat.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/default.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

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
                            class="sidebar-item  ">
                            <a href="{{route('tabungan')}}" class='sidebar-link'>
                                <i class="bi bi-wallet-fill"></i>
                                <span>Tabungan</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item  active">
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

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Riwayat Transaksi</h3>
                            <p class="text-subtitle text-muted">Disini kamu bisa melihat riwayat transaksimu lebih lengkap dan lebih jelas </p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Table</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="filterTipe">Filter Tipe Transaksi:</label>
                        <div class="custom-dropdown">
                            <select id="filterTipe" class="form-control">
                                <option value="">Semua</option>
                                <option value="Top Up">Top Up</option>
                                <option value="Menabung">Menabung</option>
                                <option value="Penarikan">Penarikan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="filterStatus">Filter Status:</label>
                        <div class="custom-dropdown">
                            <select id="filterStatus" class="form-control">
                                <option value="">Semua</option>
                                <option value="Sukses">Sukses</option>
                                <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
                                <option value="Gagal">Gagal</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tabel Riwayat Transaksi -->
                <section class="section">
                    <div class="row" id="table-contexual">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Riwayat</h4>
                                </div>
                                <div class="card-content" style="padding-left: 20px; padding-right: 20px; padding-bottom: 20px;">
                                    <div class="table-responsive">
                                        <div class="pagination-control" style="display: flex; align-items: center; gap: 6px; ">
                                            <p style="margin: 0; font-size: 16px;">Jumlah kolom ditampilkan :</p>
                                            <select id="rowsPerPage" class="form-select" style="width: auto;">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                                <option value="40">40</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="all">All</option>
                                            </select>

                                            <div id="paginationContainer" style="display: flex; align-items: center; justify-content: center;" class="pagination-contain">
                                                <div id="paginationPrev" style="display: flex; gap: 5px;"></div>
                                                <div id="pageDropdownWrapper" style="padding: 3px 8px; font-size: 14px; background-color: white; border: 1px solid #ccc;"></div>
                                                <div id="paginationNext" style="display: flex; gap: 5px;"></div>
                                            </div>
                                        </div>

                                        <table class="table mb-0" id="riwayatTable">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Tanggal</th>
                                                    <th>Jumlah</th>
                                                    <th>Tipe</th>
                                                    <th>Kelas</th>
                                                    <th>Nomor Tabungan</th>
                                                    <th style="text-align: center;">Status</th>
                                                    <th style="text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="transaksiBody">
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
                                                    <td>{{ $transaksi->kelas ?? 'Tidak punya kelas' }}</td>
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


                                                    <!-- Kolom Aksi (Hapus) -->
                                                    <td style="text-align: center;">
                                                        <a href="#" class="delete-btn"
                                                            data-id="{{ $transaksi->id }}"
                                                            data-tipe="{{ class_basename($transaksi) }}">
                                                            <i class="bi bi-trash" style="justify-content: center;"></i>
                                                        </a>
                                                    </td>


                                                </tr>
                                                @endforeach
                                                @endif

                                                <!-- Baris khusus untuk menampilkan pesan jika filter tidak menemukan hasil -->
                                                <tr id="noResultsRow" style="display: none;">
                                                    <td colspan="8" class="text-center">
                                                        Tidak dapat ditemukan
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div id="paginationInfo" style="margin-top: 5px; font-size: 14px; text-align: center;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Contextual classes end -->

            </div>
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

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>

    <!-- my js -->
    <script src="{{asset('dashboard/dist/assets/js/myjs/riwayat.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Confirm -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-container">
                    <img src="{{ asset('dashboard/dist/assets/images/icons/question.png') }}" alt="">
                </div>
                <div class="text-container">
                    <h3>Apakah Anda yakin?</h3>
                    <p>Lanjutkan pengiriman data? Pastikan URL yang Anda masukan sudah benar.</p>
                </div>
            </div>

            <div class="modal-footer">
                <button id="confirmYes" class="btn btn-confirm">Lanjutkan</button>
                <button id="confirmNo" class="btn-cancel">Batal</button>
            </div>
        </div>
    </div>
</body>

</html>