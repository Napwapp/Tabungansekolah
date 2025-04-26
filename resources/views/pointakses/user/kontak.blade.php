<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pesan Masuk</title>

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app-dark.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/pages/email.css')}}">

    <!-- mycss -->
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/mycss/emailcustom.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/mycss/default.css') }}">
</head>

<body>
    <div id="app">
        <!-- sidebar -->
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active ">
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
                            class="sidebar-item  ">
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

                        <li
                            class="sidebar-item  active">
                            <a href="{{route('contact')}}" class='sidebar-link'>
                                <i class="bi bi-envelope-fill"></i>
                                <span>Pesan</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item  ">
                            <a href="{{route('sendmassage')}}" class='sidebar-link'>
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <span>Laporkan & Saran</span>
                            </a>
                        </li>

                        <lclass="sidebar-item">
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

            <div class="page-heading email-application">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Pesan Masuk</h3>
                            <p class="text-subtitle text-muted">Pesan-pesan yg masuk ke akun mu</p>
                            <!-- Tombol Tandai Semua Dibaca -->
                            <button id="markAllReadBtn"
                                onclick="markAllAsRead()"
                                class="btn btn-danger btn-hover"
                                style="display: none;">
                                Tandai Semua Dibaca
                            </button>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first"></div>
                    </div>
                </div>

                <section class="section content-area-wrapper">
                    <div class="sidebar-left">
                        <div class="sidebar">
                            <div class="sidebar-content email-app-sidebar d-flex">
                                <!-- Sidebar close icon -->
                                <span class="sidebar-close-icon">
                                    <i class="bi bi-x"></i>
                                </span>
                                <!-- Sidebar menu -->
                                <div class="email-app-menu">
                                    <div class="sidebar-menu-list ps" style="margin-top: 70px;">
                                        <div class="list-group list-group-messages">
                                            <ul class="sidebar-filter">
                                                <!-- Semua Pesan -->
                                                <li data-filter="all" class="list-group-item pt-0 active">
                                                    <div class="fonticon-wrap d-inline me-3">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#envelope')}}" />
                                                        </svg>
                                                    </div>
                                                    Semua Pesan
                                                </li>
                                                <!-- Belum Dibaca -->
                                                <li data-filter="unread" class="list-group-item pt-0">
                                                    <div class="fonticon-wrap d-inline me-3">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#envelope')}}" />
                                                        </svg>
                                                    </div>
                                                    Belum Dibaca
                                                    @if (!Request::is('contact') && isset($unreadCount) && $unreadCount > 0)
                                                    <span class="badge bg-light-danger badge-pill badge-round float-right mt-50" id="sidebar-unread-count">{{ $unreadCount }}</span>
                                                    @endif
                                                </li>
                                                <!-- Dropdown Transaksi -->
                                                <li class="list-group-item has-dropdown" role="button" aria-expanded="false">
                                                    <div class="d-flex justify-content-between align-items-center toggle-dropdown">
                                                        <div>
                                                            <div class="fonticon-wrap d-inline me-3">
                                                                <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                                    <use xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#cash')}}" />
                                                                </svg>
                                                            </div>
                                                            Transaksi
                                                        </div>
                                                        <i class="bi bi-chevron-down"></i>
                                                    </div>
                                                    <ul class="dropdown-content">
                                                        <li data-filter="transaksi-sukses" class="list-group-item">Berhasil</li>
                                                        <li data-filter="transaksi-diproses" class="list-group-item">Diproses</li>
                                                        <li data-filter="transaksi-gagal" class="list-group-item">Dibatalkan</li>
                                                    </ul>
                                                </li>
                                                <!-- Pesan Pengingat -->
                                                <li data-filter="pengingat" class="list-group-item">
                                                    <div class="fonticon-wrap d-inline me-3">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#stopwatch')}}" />
                                                        </svg>
                                                    </div>
                                                    Pesan Pengingat
                                                </li>
                                                <!-- Pesan Pengingat -->
                                                <li data-filter="target-tabungan" class="list-group-item">
                                                    <div class="fonticon-wrap d-inline me-3">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#trophy')}}" />
                                                        </svg>
                                                    </div>
                                                    Pencapaian
                                                </li>
                                                <!-- Dropdown Pesan Terkirim -->
                                                <li class="list-group-item has-dropdown" role="button" aria-expanded="false">
                                                    <div class="d-flex justify-content-between align-items-center toggle-dropdown">
                                                        <div>
                                                            <div class="fonticon-wrap d-inline me-3">
                                                                <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                                    <use xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#send')}}" />
                                                                </svg>
                                                            </div>
                                                            Pesan Terkirim
                                                        </div>
                                                        <i class="bi bi-chevron-down"></i>
                                                    </div>
                                                    <ul class="dropdown-content">
                                                        <li data-filter="sent-laporan" class="list-group-item">Laporan</li>
                                                        <li data-filter="sent-saran" class="list-group-item">Saran</li>
                                                        <li data-filter="sent-terkirim" class="list-group-item">Terkirim</li>
                                                        <li data-filter="sent-dibaca" class="list-group-item">Telah Dibaca</li>
                                                        <li data-filter="sent-dibalas" class="list-group-item">Dibalas</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-right">
                        <div class="content-overlay"></div>
                        <div class="content-wrapper">
                            <div class="content-header row">
                            </div>
                            <div class="content-body">
                                <!-- email app overlay -->
                                <div class="app-content-overlay"></div>
                                <div class="email-app-area">
                                    <!-- Email list Area -->
                                    <div class="email-app-list-wrapper">
                                        <div class="email-app-list">
                                            <div class="email-action">
                                                <!-- action left start here -->
                                                <div class="action-left d-flex align-items-center">
                                                    <!-- select All checkbox -->
                                                    <div class="checkbox checkbox-shadow checkbox-sm selectAll me-3">

                                                        <label for="checkboxsmall"></label>
                                                    </div>
                                                </div>
                                                <!-- action left end here -->

                                                <!-- action right start here -->
                                                <div
                                                    class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                                                    <div class="sidebar-toggle d-block d-lg-none">
                                                        <button class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-list fs-5"></i>
                                                        </button>
                                                    </div>

                                                    <!-- search bar -->
                                                    <div class="email-fixed-search flex-grow-1">
                                                        <div class="form-group position-relative mb-0 has-icon-left">
                                                            <input type="text" id="searchInput" class="form-control" placeholder="Search email..">
                                                            <div class="form-control-icon">
                                                                <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                                    <use xlink:href="{{ asset('dashboard/dist/assets/images/bootstrap-icons.svg#search') }}" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- pagination and page count -->

                                                    <!-- Tombol Hapus Semua Notifikasi -->
                                                    <button class="btn btn-danger btn-sm" onclick="hapusSemuaPesanDibaca()">
                                                        <span class="text-label d-none d-md-inline">Hapus Semua Pesan yang Dibaca</span>
                                                        <span class="text-label d-none d-sm-inline d-md-none">Hapus Dibaca</span>
                                                        <span class="text-label d-inline d-sm-none">Hapus</span>
                                                        <span class="icon-only" style="display:none;"><i class="bi bi-trash"></i></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- / action right -->

                                            <!-- email user list start -->
                                            <div class="email-user-list list-group ps ps--active-y">
                                                <ul class="users-list-wrapper media-list notification-list">
                                                    @forelse($notifikasi as $pesan)
                                                    <li class="media {{ $pesan->status === 'Belum Dibaca' ? '' : 'mail-read' }}" onclick="openMessageOverlay({{ $pesan->id }})" id="notification-{{ $pesan->id }}">
                                                        @if($pesan->status === 'Belum Dibaca')
                                                        <span class="bullet-unread" id="bullet-{{ $pesan->id }}"></span>
                                                        @endif
                                                        <div class="pr-50">
                                                            <div class="avatar">
                                                                @if($pesan->tipe == 'Laporan' || $pesan->tipe == 'Saran')
                                                                @php
                                                                // Ambil gambar user dari kolom 'gambar' di tabel users
                                                                $user = App\Models\User::find($pesan->user_id);
                                                                $fotoProfil = $user ? $user->gambar : null; // Kolom gambar di tabel users

                                                                // Tentukan path gambar
                                                                $fotoPath = public_path('picture/accounts/' . $fotoProfil);
                                                                @endphp

                                                                @if ($fotoProfil && file_exists($fotoPath))
                                                                <img src="{{ asset('picture/accounts/' . $fotoProfil) }}" alt="avatar">
                                                                @else
                                                                <img src="{{ asset('dashboard/dist/assets/images/logo/logoSMK_.png') }}" alt="avatar">
                                                                @endif
                                                                @else
                                                                <!-- Tampilkan logo sekolah jika bukan tipe Laporan atau Saran -->
                                                                <img src="{{ asset('dashboard/dist/assets/images/logo/logoSMK_.png') }}" alt="avatar">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="user-details">
                                                                <div class="wrapper-name-mail">
                                                                    <div class="sender-name">
                                                                        <strong>{{ $pesan->nama_pengirim ?? 'Sistem' }}</strong>
                                                                        <!-- Tanggal akan muncul di sini pada layar kecil -->
                                                                        <span class="mail-date-mobile">{{ \Carbon\Carbon::parse($pesan->created_at)->format('d M') }}</span>
                                                                    </div>
                                                                    <div class="mail-items">
                                                                        <span class="list-group-item-text text-truncate">{{Str::limit($pesan->judul, 30) }}</span>
                                                                    </div>
                                                                    @if($pesan->balasan)
                                                                    <div class="reply-container-user">
                                                                        <div class="reply-list {{ $pesan->status === 'Belum Dibaca' ? 'unread' : 'read' }}">
                                                                            <span>Ada balasan dari admin</span>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="mail-meta-item desktop-only">
                                                                    <span class="mail-meta-content float-right">
                                                                        <span class="mail-date">{{ \Carbon\Carbon::parse($pesan->created_at)->format('d M') }}</span>
                                                                        <span class="status-icon">{!! $pesan->status_icon ?? '<i class="bi bi-exclamation-circle text-danger"></i> Data Kosong' !!}</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mail-message">
                                                                <p class="list-group-item-text truncate mb-0">
                                                                    {{ Str::limit($pesan->isi_pesan, 50) }}
                                                                    <!-- Status icon akan muncul di sini pada layar kecil -->
                                                                    <span class="status-icon-mobile">{!! $pesan->status_icon ?? '<i class="bi bi-exclamation-circle text-danger"></i> Data Kosong' !!}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    @empty
                                                    <li class="text-center p-3">Tidak ada notifikasi</li>

                                                    @endforelse
                                                    <!-- Tombol Kirim Pesan -->
                                                </ul>

                                                <!-- Overlay Detail Pesan -->
                                                <div id="messageOverlay" class="overlay" style="display: none; justify-content: center; ">
                                                    <div class="overlay-content">
                                                        <!-- Header: Tombol kembali di pojok kiri -->
                                                        <div class="overlay-header">
                                                            <button class="back-button" onclick="closeOverlay()">
                                                                &larr; Kembali
                                                            </button>
                                                        </div>

                                                        <!-- Konten Utama Pesan -->
                                                        <div class="overlay-body">
                                                            <div class="message-header">
                                                                <div class="sender-profile">
                                                                    <div class="sender-image">
                                                                        <img id="overlay-foto" src="{{ asset('dashboard/dist/assets/images/logo/logoSMK_.png') }}" alt="Foto Profil Pengirim">
                                                                    </div>
                                                                    <div class="sender-info">
                                                                        <div class="wrapper-left-right">
                                                                            <span id="overlay-nama-pengirim" class="sender-name"></span>
                                                                            <span id="overlay-tanggal" class="message-date"></span>
                                                                        </div>
                                                                        <span class="to-me">
                                                                            Kepada saya
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <!-- Icon Hapus di Pojok Kanan Atas -->
                                                                <button class="btn-hapus" onclick="konfirmasiHapus()">
                                                                    <i class="bi bi-trash"></i> <!-- Menggunakan Bootstrap icon -->
                                                                </button>
                                                            </div>
                                                            <div class="message-header">
                                                                <!-- Judul Pesan -->
                                                                <h3 id="overlay-title" class="message-title" style="color: black;"></h3>
                                                            </div>

                                                            <!-- Status Transaksi -->
                                                            <div id="overlay-status" class="transaction-status">
                                                                <!-- Ikon Status akan diisi dengan JavaScript -->
                                                            </div>

                                                            <!-- Balasan admin -->
                                                            <div id="overlay-reply" class="reply-container" style="display: none;">
                                                                <!-- Balasan akan diisi dengan JavaScript -->
                                                            </div>

                                                            <!-- Isi Pesan Lengkap -->
                                                            <div id="overlay-content" class="message-content" style="background-color: rgb(210, 210, 210); padding: 15px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- email user list end -->
                                            </div>
                                        </div>

                                        <!-- Floating button -->
                                        <div id="floating-button" class="floating-btn" onclick="window.location.href='{{ route('sendmassage') }}'">
                                            <i class="bi bi-pencil"></i>
                                            <span class="btn-text">Tulis</span>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Email list Area -->
                            </div>
                        </div>
                    </div>
                </section>
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
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>

    <!-- myjs -->
    <script src="{{ asset('dashboard/dist/assets/js/myjs/emailcustom.js') }}"></script>
    <script src="{{ asset('dashboard/dist/assets/js/myjs/pesanuser.js') }}"></script>


    <!-- untuk buka tutup sidebar -->
    <script>
        document.querySelector('.sidebar-toggle').addEventListener('click', () => {
            document.querySelector('.email-app-sidebar').classList.toggle('show')
        })
        document.querySelector('.sidebar-close-icon').addEventListener('click', () => {
            document.querySelector('.email-app-sidebar').classList.remove('show')
        })
    </script>

    <!-- untuk menampilkan overlay dan mengupdate status notifikasi -->
    <script>
        let currentMessageId = null; // Simpan ID notifikasi yang sedang dibuka

        function openMessageOverlay(id) {
            // Update currentMessageId sesuai dengan notifikasi yang diklik
            currentMessageId = id;

            // Menampilkan overlay
            document.getElementById('messageOverlay').style.display = 'flex';

            // Ambil detail pesan
            fetch(`/pesan/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    console.log("Data dari API:", data); // Debugging
                    document.getElementById("overlay-title").textContent = data.judul ?? "Tanpa Judul";
                    document.getElementById("overlay-content").innerHTML = `<p>${data.isi_pesan ?? "Tidak ada isi pesan"}</p>`;
                    document.getElementById("overlay-nama-pengirim").textContent = data.nama_pengirim ?? "Sistem";

                    // Menampilkan "Kepada admin" atau "Kepada saya" berdasarkan tipe
                    const toMeText = data.tipe === 'Laporan' || data.tipe === 'Saran' ? 'Kepada admin' : 'Kepada saya';
                    document.querySelector(".to-me").textContent = toMeText;

                    // Format Tanggal
                    if (data.created_at) {
                        let tanggal = new Date(data.created_at);
                        let formattedTanggal = tanggal.getDate() + ' ' + tanggal.toLocaleString('id-ID', {
                            month: 'short'
                        });
                        document.getElementById("overlay-tanggal").textContent = formattedTanggal;
                    } else {
                        document.getElementById("overlay-tanggal").textContent = "-";
                    }

                    // Menampilkan Foto Pengirim hanya jika tipe 'Laporan' atau 'Saran'
                    if (data.tipe === 'Laporan' || data.tipe === 'Saran') {
                        let fotoPengirim = data.foto_pengirim ?
                            data.foto_pengirim :
                            `{{ asset('dashboard/dist/assets/images/logo/logoSMK_.png') }}`;
                        document.getElementById("overlay-foto").src = fotoPengirim;
                    } else {
                        document.getElementById("overlay-foto").src = `{{ asset('dashboard/dist/assets/images/logo/logoSMK_.png') }}`;
                    }

                    // Menampilkan Ikon Status Transaksi
                    document.getElementById("overlay-status").innerHTML = data.status_icon ?? "-";

                    // Menampilkan balasan jika ada
                    let balasanContainer = document.getElementById("overlay-reply");
                    if (data.balasan) {
                        balasanContainer.innerHTML = `<strong>Balasan Admin:</strong> <p>${data.balasan}</p>`;
                        balasanContainer.style.display = "block";
                    } else {
                        balasanContainer.style.display = "none";
                    }
                })
                .catch(error => console.error("Error:", error));

            // Menutup overlay ketika mengklik di luar area konten overlay
            document.getElementById('messageOverlay').addEventListener('click', function(event) {
                if (event.target === this) {
                    document.getElementById('messageOverlay').style.display = 'none';
                }
            });

            // Kirim AJAX untuk update status menjadi "Dibaca"
            fetch(`/pesan/${id}/update-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    const bullet = document.getElementById('bullet-' + id);
                    const messageItem = document.querySelector(`.media[onclick="openMessageOverlay(${id})"]`);
                    const replyList = document.querySelector('.reply-list');

                    // Hapus bullet merah
                    if (bullet) {
                        bullet.style.display = 'none';
                    }

                    // Tambahkan kelas 'mail-read' pada elemen li
                    if (messageItem) {
                        messageItem.classList.add('mail-read');
                    }

                    // Perbarui tampilan reply-list jika ada
                    if (replyList) {
                        replyList.classList.remove('unread');
                        replyList.classList.add('read');
                        replyList.innerHTML = "<span>ada balasan dari admin</span>";
                    }

                    // 🔄 Fetch jumlah unread terbaru dari backend dan update badge sidebar-filter
                    fetch('/notifikasi/count-unread')
                        .then(response => response.json())
                        .then(countData => {
                            const sidebarUnreadBadge = document.getElementById('sidebar-unread-count');
                            if (sidebarUnreadBadge) {
                                if (countData.unreadCount > 0) {
                                    sidebarUnreadBadge.textContent = countData.unreadCount;
                                    sidebarUnreadBadge.style.display = 'inline-block';
                                } else {
                                    sidebarUnreadBadge.style.display = 'none';
                                }
                            }

                            // Hilangkan tombol tandai semua dibaca apabila tidak ada lagi yg Belum Dibaca
                            const markAllReadButton = document.getElementById("markAllReadBtn");
                            if (markAllReadButton) {
                                markAllReadButton.style.display = countData.unreadCount > 0 ? "block" : "none";
                            }

                        })
                        .catch(error => console.error("Error fetching unread count:", error));

                })
                .catch(error => console.error("Error updating status:", error));
        }


        function konfirmasiHapus() {
            if (!currentMessageId) {
                console.error("ID pesan tidak ditemukan!");
                return;
            }

            Swal.fire({
                title: "Yakin Menghapus Notifikasi?",
                text: "Notifikasi akan hilang sepenuhnya.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/pesan/hapus/${currentMessageId}`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Hilangkan notifikasi dari daftar pesan
                                document.getElementById(`notification-${currentMessageId}`).remove();
                                // Tampilkan swal success, lalu tutup overlay setelah konfirmasi alert
                                Swal.fire("Berhasil!", "Notifikasi berhasil dihapus.", "success")
                                    .then(() => {
                                        closeOverlay();
                                    });
                            } else {
                                Swal.fire("Error", "Gagal menghapus notifikasi", "error");
                            }
                        })
                        .catch(error => console.error("Error:", error));
                }
            });
        }


        function closeOverlay() {
            document.getElementById('messageOverlay').style.display = 'none';

            document.getElementById('messageOverlay').addEventListener('click', function(event) {
                if (event.target === this) {
                    closeOverlay();
                }
            });
        }
    </script>

    <!-- Script Konfirmasi Hapus Semua -->
    <script>
        function hapusSemuaPesanDibaca() {
            // Cek dulu apakah ada pesan 'Dibaca'
            fetch('/cek-pesan-dibaca')
                .then(response => response.json())
                .then(data => {
                    if (!data.ada) {
                        Swal.fire('Gagal', 'Tidak dapat menemukan pesan yg sudah dibaca', 'error');
                        return;
                    }

                    // Jika ada, baru tampilkan konfirmasi
                    Swal.fire({
                        title: 'Yakin ingin menghapus semua pesan yang sudah dibaca?',
                        text: "Pesan yang telah dibaca akan dihapus.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Hapus Semua',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim request hapus
                            fetch('/pesan/hapus-semua-dibaca', {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({})
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.fire('Dihapus!', 'Semua pesan yang telah dibaca telah dihapus.', 'success')
                                        .then(() => location.reload());
                                })
                                .catch(error => {
                                    Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus pesan.', 'error');
                                });
                        }
                    });
                });
        }
    </script>

    <!-- script untuk tombol tanda semua dibaca -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            checkUnreadNotifications();
        });

        function checkUnreadNotifications() {
            fetch("{{ route('notifikasi.countUnread') }}")
                .then(response => response.json())
                .then(data => {
                    let button = document.getElementById("markAllReadBtn");
                    if (data.unreadCount > 0) {
                        button.style.display = "block";
                    } else {
                        button.style.display = "none";
                    }

                    // Update badge angka notifikasi di sidebar
                    let badge = document.getElementById("notificationBadge");
                    if (badge) {
                        badge.innerText = data.unreadCount;
                        badge.style.display = data.unreadCount > 0 ? "block" : "none";
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function markAllAsRead() {
            fetch("{{ route('notifikasi.markAllRead') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Loop semua notifikasi dan update tampilannya
                        document.querySelectorAll(".media").forEach(item => {
                            item.classList.add("mail-read"); // Tambah class mail-read
                        });

                        // Hilangkan indikator merah dari semua notifikasi yang belum dibaca
                        document.querySelectorAll(".bullet-unread").forEach(dot => {
                            dot.style.display = "none";
                        });

                        // Perbarui angka notifikasi di sidebar
                        let badge = document.getElementById("notificationBadge");
                        if (badge) {
                            badge.innerText = "0"; // Set badge ke 0
                            badge.style.display = "none"; // Sembunyikan badge jika sudah 0
                        }

                        // Sembunyikan tombol "Tandai Semua Dibaca"
                        let button = document.getElementById("markAllReadBtn");
                        if (button) {
                            button.style.display = "none";
                        }

                        // Perbarui tampilan reply-list jika ada
                        const replyList = document.querySelector('.reply-list');
                        if (replyList) {
                            replyList.classList.remove('unread');
                            replyList.classList.add('read');
                            replyList.innerHTML = "<span>ada balasan dari admin</span>";
                        }

                        // Perbarui sidebar filter (sidebar-unread-count)
                        fetch('/notifikasi/count-unread')
                            .then(response => response.json())
                            .then(countData => {
                                const sidebarUnreadBadge = document.getElementById('sidebar-unread-count');
                                if (sidebarUnreadBadge) {
                                    if (countData.unreadCount > 0) {
                                        sidebarUnreadBadge.textContent = countData.unreadCount;
                                        sidebarUnreadBadge.style.display = 'inline-block';
                                    } else {
                                        sidebarUnreadBadge.style.display = 'none';
                                    }
                                }
                            })
                            .catch(error => console.error("Error fetching unread count:", error));
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    </script>
</body>

</html>