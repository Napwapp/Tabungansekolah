<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Email Application - Mazer Admin Dashboard</title>

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app-dark.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/pages/email.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/mycss/emailcustom.css') }}">

</head>

<body>
    <div id="app">
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
                            class="sidebar-item ">
                            <a href="{{route('riwayat')}}" class='sidebar-link'>
                                <i class="bi bi-chat-dots-fill"></i>
                                <span>Riwayat Transaksi</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item active">
                            <a href="{{route('contact')}}" class='sidebar-link'>
                                <i class="bi bi-envelope-fill"></i>
                                <span>Pesan</span>
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
                                class="btn btn-primary"
                                style="display: none;">
                                Tandai Semua Dibaca
                            </button>

                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                        </div>
                    </div>
                </div>

                <section class="section content-area-wrapper">
                    <div class="sidebar-left">
                        <div class="sidebar">
                            <div class="sidebar-content email-app-sidebar d-flex">
                                <!-- sidebar close icon -->
                                <span class="sidebar-close-icon">
                                    <i class="bi bi-x"></i>
                                </span>
                                <!-- sidebar close icon -->
                                <div class="email-app-menu">

                                    <div class="sidebar-menu-list ps" style="margin-top: 70px;">
                                        <!-- sidebar menu  -->
                                        <div class="list-group list-group-messages">
                                            <ul class="sidebar-filter">
                                                <li data-filter="all" class="list-group-item pt-0 active" id="inbox-menu">
                                                    <div class="fonticon-wrap d-inline me-3">

                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#envelope')}}" />
                                                        </svg>
                                                    </div>
                                                    Semua Pesan
                                                    <span
                                                        class="badge bg-light-primary badge-pill badge-round float-right mt-50">5</span> <!-- akan dengan backend menghitung berapa jumlah pesan yg masuk -->
                                                </li>
                                                <li data-filter="unread" class="list-group-item pt-0" id="inbox-menu">
                                                    <div class="fonticon-wrap d-inline me-3">

                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#envelope')}}" />
                                                        </svg>
                                                    </div>
                                                    Belum dibaca
                                                    <span
                                                        class="badge bg-light-primary badge-pill badge-round float-right mt-50">5</span> <!-- akan dengan backend menghitung berapa jumlah pesan yg masuk -->
                                                </li>
                                                <li data-filter="transaksi" class="list-group-item">
                                                    <div class="fonticon-wrap d-inline me-3">

                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#cash')}}" />
                                                        </svg>
                                                    </div>
                                                    Transaksi
                                                </li>
                                                <li data-filter="pengingat" class="list-group-item">
                                                    <div class="fonticon-wrap d-inline me-3">

                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#stopwatch')}}" />
                                                        </svg>
                                                    </div>
                                                    Pesan Pengingat
                                                </li>
                                                <li data-filter="sent" class="list-group-item">
                                                    <div class="fonticon-wrap d-inline me-3">

                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#send')}}" />
                                                        </svg>
                                                    </div>
                                                    Pesan Terkirim
                                                </li>
                                                <li data-filter="deleted" class="list-group-item">
                                                    <div class="fonticon-wrap d-inline me-3">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#trash')}}" />
                                                        </svg>
                                                    </div>
                                                    Terhapus
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- sidebar menu  end-->

                                        <!-- sidebar label start -->

                                        <div class="list-group list-group-labels">
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="bullet bullet-success bullet-sm"></span>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="bullet bullet-primary bullet-sm"></span>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="bullet bullet-warning bullet-sm"></span>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="bullet bullet-danger bullet-sm"></span>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="bullet bullet-info bullet-sm"></span>
                                            </div>
                                        </div>
                                        <!-- sidebar label end -->
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ User Chat profile right area -->
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
                                    <dxiv class="email-app-list-wrapper">
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
                                                    <!-- search bar  -->
                                                    <div class="email-fixed-search flex-grow-1">

                                                        <div class="form-group position-relative  mb-0 has-icon-left">
                                                            <input type="text" class="form-control" placeholder="Search email..">
                                                            <div class="form-control-icon">
                                                                <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                                    <use
                                                                        xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#search')}}" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- pagination and page count -->
                                                    <span class="d-none d-sm-block">-</span>
                                                    <button class="btn btn-icon email-pagination-prev action-button d-none d-sm-block">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#chevron-left')}}" />
                                                        </svg>
                                                    </button>
                                                    <button class="btn btn-icon email-pagination-next action-button d-none d-sm-block">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#chevron-right')}}" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- / action right -->

                                            <!-- email user list start -->
                                            <div class="email-user-list list-group ps ps--active-y">
                                                <ul class="users-list-wrapper media-list">
                                                    @foreach($notifikasi as $pesan)
                                                    <li class="media {{ $pesan->status === 'Belum Dibaca' ? '' : 'mail-read' }}" onclick="openMessageOverlay({{ $pesan->id }})">
                                                        <div class="pr-50">
                                                            <div class="avatar">
                                                                @if($pesan->foto_pengirim)
                                                                <img src="{{ asset('storage/' . $pesan->foto_pengirim) }}" alt="avatar">
                                                                @else
                                                                <img src="{{ asset('dashboard/dist/assets/images/logo/logoSMK_.png') }}" alt="avatar">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="user-details">
                                                                <div class="wrapper-name-mail">
                                                                    <div class="sender-name">
                                                                        <strong>{{ $pesan->nama_pengirim ?? 'Sistem' }}</strong>
                                                                    </div>
                                                                    <div class="mail-items">
                                                                        <span class="list-group-item-text text-truncate">{{ $pesan->judul }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="mail-meta-item">
                                                                    <span class="mail-meta-content float-right">
                                                                        <span class="mail-date">{{ \Carbon\Carbon::parse($pesan->created_at)->format('d M') }}</span>
                                                                        <span class="status-icon">{!! $pesan->status_icon ?? '<i class="bi bi-exclamation-circle text-danger"></i> Data Kosong' !!}</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mail-message">
                                                                <p class="list-group-item-text truncate mb-0">
                                                                    {{ Str::limit($pesan->isi_pesan, 60) }}
                                                                </p>
                                                                <div class="mail-meta-item" data-id="{{ $pesan->id }}">
                                                                    <span>
                                                                        @if($pesan->status === 'Belum Dibaca')
                                                                        <span class="bullet-unread" id="bullet-{{ $pesan->id }}"></span>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
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
                                                            <!-- Judul Pesan -->
                                                            <h3 id="overlay-title" class="message-title"></h3>

                                                            <!-- Container Profil Pengirim -->
                                                            <div class="sender-profile">
                                                                <div class="sender-image">
                                                                    <img id="overlay-foto" src="{{ asset('dashboard/dist/assets/images/logo/logoSMK_.png') }}" alt="Foto Profil Pengirim">
                                                                </div>
                                                                <div class="sender-info">
                                                                    <div class="wrapper-left-right">
                                                                        <span id="overlay-nama-pengirim" class="sender-name"></span>
                                                                        <span id="overlay-tanggal" class="message-date"></span>
                                                                    </div>
                                                                    <span class="to-me">Kepada saya</span>
                                                                </div>
                                                            </div>

                                                            <!-- Status Transaksi -->
                                                            <div id="overlay-status" class="transaction-status">
                                                                <!-- Ikon Status akan diisi dengan JavaScript -->
                                                            </div>

                                                            <!-- Isi Pesan Lengkap -->
                                                            <div id="overlay-content" class="message-content" style="background-color: rgb(210, 210, 210); padding: 15px;"></div>
                                                        </div>

                                                        <!-- Footer: Input untuk membalas pesan -->
                                                        <div class="overlay-footer">
                                                            <input type="text" class="reply-input" placeholder="Balas pesan...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- email user list end -->

                                                <!-- no result when nothing to show on list -->
                                                <div class="no-results">
                                                    <i class="bi bi-error-circle font-large-2"></i>
                                                    <h5>No Items Found</h5>
                                                </div>
                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                </div>
                                                <div class="ps__rail-y" style="top: 0px; height: 733px; right: 0px;">
                                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 567px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <!--/ Email list Area -->
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2021 &copy; Mazer</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                        href="https://saugi.me">Saugi</a></p>
            </div>
        </div>
    </footer>
    </div>
    </div>
    <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>

    <script src="{{ asset('dashboard/dist/assets/js/myjs/emailcustom.js') }}"></script>

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
        function openMessageOverlay(id) {
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

                    // Menampilkan Foto Pengirim
                    let fotoPengirim = data.foto_pengirim ? `/storage/${data.foto_pengirim}` : `{{ asset('dashboard/dist/assets/images/logo/logoSMK_.png') }}`;
                    document.getElementById("overlay-foto").src = fotoPengirim;

                    // Menampilkan Ikon Status Transaksi
                    document.getElementById("overlay-status").innerHTML = data.status_icon ?? "-";
                })
                .catch(error => console.error("Error:", error));

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
                    console.log("Status notifikasi diperbarui:", data);

                    // Mengubah status bullet dan elemen lainnya
                    const bullet = document.getElementById('bullet-' + id);
                    const messageItem = document.querySelector(`.media[onclick="openMessageOverlay(${id})"]`);

                    // Hapus bullet merah
                    if (bullet) {
                        bullet.style.display = 'none'; // Sembunyikan bullet merah
                    }

                    // Tambahkan kelas 'mail-read' pada elemen li untuk menandakan bahwa pesan telah dibaca
                    if (messageItem) {
                        messageItem.classList.add('mail-read');
                    }

                    // Jika ingin juga update status di tempat lain (misalnya sidebar), bisa lakukan perubahan lain di sini
                })
                .catch(error => console.error("Error updating status:", error));
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
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    </script>

</body>

</html>