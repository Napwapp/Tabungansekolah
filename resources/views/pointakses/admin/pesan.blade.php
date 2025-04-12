<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pesan User</title>

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/main/app-dark.css') }}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/pages/email.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.png')}}" type="image/png">

    <!-- mycss -->
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/mycss/default.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/mycss/emailcustom.css') }}">
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
                                    <a href="{{route('kelasmin')}}">Data Tabungan Kelas</a>
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

                        <li
                            class="sidebar-item  active">
                            <a href="{{route('pesan')}}" class='sidebar-link'>
                                <i class="bi bi-envelope-fill"></i>
                                <span>Pesan</span>
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
                            @if($terkirimCount > 0)
                            <button id="markAllReadBtn" class="btn btn-danger btn-hover" onclick="markAllAsRead()">
                                Tandai Semua Dibaca
                            </button>
                            @endif
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first"></div>
                    </div>
                </div>


                <section class="section content-area-wrapper">
                    <div class="sidebar-left">
                        <div class="sidebar">
                            <div class="sidebar-content email-app-sidebar d-flex"> {{-- Navigasi filter pesan --}}
                                <!-- Sidebar close icon -->
                                <span class="sidebar-close-icon">
                                    <i class="bi bi-x"></i>
                                </span>
                                <!-- Sidebar menu -->
                                <div class="email-app-menu">
                                    <div class="sidebar-menu-list ps" style="margin-top: 70px;">
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
                                                </li>
                                                <li data-filter="unread" class="list-group-item pt-0" id="inbox-menu">
                                                    <div class="fonticon-wrap d-inline me-3">

                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#envelope')}}" />
                                                        </svg>
                                                    </div>
                                                    Belum dibaca
                                                    <span id="badge-laporan-admin"
                                                        class="badge bg-light-primary badge-pill badge-round float-right mt-50"
                                                        style="{{ $unreadLaporanCount > 0 ? '' : 'display: none;' }}">
                                                        {{ $unreadLaporanCount }}
                                                    </span>
                                                </li>
                                                <li data-filter="unreply" class="list-group-item">
                                                    <div class="fonticon-wrap d-inline me-3">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#envelope')}}" />
                                                        </svg>
                                                    </div>
                                                    Belum Dibalas
                                                </li>
                                                <li data-filter="report" class="list-group-item">
                                                    <div class="fonticon-wrap d-inline me-3">

                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#exclamation-triangle')}}" />
                                                        </svg>
                                                    </div>
                                                    Laporan
                                                </li>
                                                <li data-filter="advice" class="list-group-item">
                                                    <div class="fonticon-wrap d-inline me-3">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#lightbulb')}}" />
                                                        </svg>
                                                    </div>
                                                    Saran
                                                </li>
                                                <li data-filter="sent-reply" class="list-group-item">
                                                    <div class="fonticon-wrap d-inline me-3">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use
                                                                xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#send')}}" />
                                                        </svg>
                                                    </div>
                                                    Balasan Terkirim
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- sidebar menu  end-->
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
                                                    <!-- search bar  -->
                                                    <div class="email-fixed-search flex-grow-1">
                                                        <div class="form-group position-relative  mb-0 has-icon-left">
                                                            <input type="text" id="searchInput" class="form-control" placeholder="Search email..">
                                                            <div class="form-control-icon">
                                                                <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                                    <use
                                                                        xlink:href="{{asset('dashboard/dist/assets/images/bootstrap-icons.svg#search')}}" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- pagination and page count -->
                                                </div>
                                            </div>
                                            <!-- / action right -->

                                            <!-- email user list start -->
                                            <div class="email-user-list list-group ps ps--active-y">
                                                <ul class="users-list-wrapper media-list">
                                                    @forelse ($laporan as $data)
                                                    <li class="media {{ $data->status_laporan === 'Terkirim' ? '' : 'mail-read' }}" data-id="{{ $data->id }}" onclick="openMessageOverlay({{ $data->id }})" id="notification-{{ $data->id }}">
                                                        <div class="pr-50">
                                                            <div class="avatar">
                                                                <img src="{{ asset('picture/accounts/' . ($data->user->gambar ?? 'default.png')) }}" alt="avatar">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="user-details">
                                                                <div class="wrapper-name-mail">
                                                                    <div class="sender-name">
                                                                        <strong>{{ $data->user->namalengkap ?? 'User Tidak Diketahui' }}</strong>
                                                                        <span class="mail-date-mobile">{{ \Carbon\Carbon::parse($data->created_at)->format('d M') }}</span>
                                                                    </div>
                                                                    <div class="mail-items">
                                                                        <span class="list-group-item-text"><strong>{{ $data->email }}</strong></span>
                                                                    </div>
                                                                    <div class="mail-items">
                                                                        <span class="list-group-item-text text-truncate">{{ $data->tipe }}</span>
                                                                    </div>
                                                                    <div class="mail-items">
                                                                        <span class="list-group-item-text text-truncate">{{Str::limit($data->judul, 30)  }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="mail-meta-item desktop-only">
                                                                    <span class="mail-meta-content float-right">
                                                                        <span class="mail-date">{{ \Carbon\Carbon::parse($data->created_at)->format('d M') }}</span>
                                                                        <span id="status-laporan-{{ $data->id }}" class="status-icon">
                                                                            {!! $data->status_laporan_icon ?? 'Belum Ada' !!}
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mail-message">
                                                                <p class="list-group-item-text truncate mb-0">
                                                                    {{Str::limit($data->isi_pesan ?? 'Tidak ada isi pesan', 50)  }}
                                                                    <!-- Status icon akan muncul di sini pada layar kecil -->
                                                                    <span id="status-laporan-{{ $data->id }}" class="status-icon-mobile">
                                                                        {!! $data->status_laporan_icon ?? 'Belum Ada' !!}
                                                                    </span>
                                                                </p>
                                                                <div class="mail-meta-item desktop-only">
                                                                    <span>
                                                                        @if($data->status_laporan === 'Terkirim')
                                                                        <span class="bullet-unread" id="bullet-{{ $data->id }}"></span>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @empty
                                                    <li class="media">
                                                        <p class="text-center w-100">Tidak ada laporan masuk.</p>
                                                    </li>
                                                    @endforelse
                                                </ul>

                                                <!-- Overlay detail pesan -->
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
                                                            <!-- Container Profil Pengirim -->
                                                            <div class="sender-profile">
                                                                <div class="sender-image">
                                                                    <img id="overlay-foto" src="" alt="Foto Profil Pengirim" onerror="this.onerror=null;this.src='{{ asset('dashboard/dist/assets/images/logo/logoSMK_.png') }}'">
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
                                                            <div class="message-header">
                                                                <!-- Judul Pesan -->
                                                                <h3 id="overlay-title" class="message-title"></h3>
                                                            </div>

                                                            <!-- Status laporan -->
                                                            <div id="overlay-status" class="transaction-status">
                                                                <!-- Isi dengan JavaScript -->
                                                            </div>


                                                            <!-- Balasan admin -->
                                                            <div id="overlay-reply" class="reply-container" style="display: none;">
                                                                <!-- Balasan akan diisi dengan JavaScript -->
                                                            </div>

                                                            <!-- Isi Pesan Lengkap -->
                                                            <div id="overlay-content" class="message-content" style="background-color: rgb(210, 210, 210); padding: 15px;"></div>
                                                        </div>

                                                        <!-- Footer: Input untuk membalas pesan -->
                                                        <div id="overlay-footer" class="overlay-footer">
                                                            <input type="text" id="reply-input" class="reply-input" placeholder="Balas pesan..." data-laporan-id="{{ $data->id }}">
                                                            <button class="send-reply" onclick="sendReply()">
                                                                <img src="{{ asset('dashboard/dist/assets/images/icons/icons8-send-30.png') }}" alt="">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Email list Area -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- footer -->
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
    <script src="{{ asset('dashboard/dist/assets/js/myjs/pesanadmin.js') }}"></script>

    <!-- untuk buka tutup sidebar -->
    <script>
        document.querySelector('.sidebar-toggle').addEventListener('click', () => {
            document.querySelector('.email-app-sidebar').classList.toggle('show')
        })
        document.querySelector('.sidebar-close-icon').addEventListener('click', () => {
            document.querySelector('.email-app-sidebar').classList.remove('show')
        })
    </script>

    <!-- untuk menampilkan detail pesan dan function2 lainnya -->
    <script>
        let currentMessageId = null; // Simpan ID laporan yang sedang dibuka

        function openMessageOverlay(id) {
            currentMessageId = id; // Pastikan ID diperbarui
            document.getElementById('messageOverlay').style.display = 'flex';

            fetch(`/admin/laporan/${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Data dari API:", data);
                    document.getElementById("overlay-title").textContent = data.judul ?? "Tanpa Judul";
                    document.getElementById("overlay-nama-pengirim").textContent = data.nama_pengirim ?? "Tidak diketahui";
                    document.getElementById("overlay-content").innerHTML = `<p>${data.isi_pesan ?? "Tidak ada isi pesan"}</p>`;

                    // Pastikan attribute data-laporan-id di-update dengan nilai id yang diteruskan
                    document.getElementById("reply-input").setAttribute("data-laporan-id", id);

                    if (data.tanggal) {
                        let tanggal = new Date(data.tanggal);
                        let formattedTanggal = tanggal.getDate() + ' ' + tanggal.toLocaleString('id-ID', {
                            month: 'short'
                        });
                        document.getElementById("overlay-tanggal").textContent = formattedTanggal;
                    } else {
                        document.getElementById("overlay-tanggal").textContent = "-";
                    }

                    let fotoPengirim = data.foto_pengirim ? data.foto_pengirim : "/dashboard/dist/assets/images/logo/logoSMK_.png";
                    document.getElementById("overlay-foto").src = fotoPengirim;


                    // Menampilkan balasan admin apabila sudah dibalas
                    let balasanContainer = document.getElementById("overlay-reply");
                    let overlayFooter = document.getElementById("overlay-footer");
                    if (data.balasan && data.balasan.trim() !== "" && data.balasan.trim().toLowerCase() !== "belum ada balasan") {
                        balasanContainer.innerHTML = `<strong>Balasan Admin:</strong> <p>${data.balasan}</p>`;
                        balasanContainer.style.display = "block";
                        if (overlayFooter) overlayFooter.style.display = "none";
                    } else {
                        balasanContainer.style.display = "none";
                        if (overlayFooter) overlayFooter.style.display = "flex";
                    }

                    // Update status laporan + refresh badge
                    updateStatusLaporan(id);

                })
                .catch(error => console.error("Error:", error));

            document.getElementById('messageOverlay').addEventListener('click', function(event) {
                if (event.target === this) {
                    closeOverlay();
                }
            });
        }

        function updateStatusLaporan(id, callback = null) {
            fetch(`/admin/laporan/update-status/${id}`, {
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
                    const badge = document.getElementById('badge-laporan-admin');

                    // Update status icon di detail pesan berdasarkan data.status_laporan_icon
                    let statusElement = document.getElementById('overlay-status');
                    if (statusElement) {
                        statusElement.innerHTML = data.status_icon ?? '<i class="bi bi-question-circle text-secondary"></i> -'; // Menggunakan icon default jika tidak ada icon
                    }

                    // Update status icon di detail pesan berdasarkan data.status_laporan_icon
                    let statusIcon = document.getElementById('status-laporan-' + id);
                    if (statusIcon) {
                        statusIcon.innerHTML = data.status_icon ?? '<i class="bi bi-question-circle text-secondary"></i> -'; // Menggunakan icon default jika tidak ada icon
                    }

                    // Hapus bullet merah
                    if (bullet) bullet.style.display = 'none';

                    // Tambahkan kelas 'mail-read' pada pesan
                    if (messageItem) messageItem.classList.add('mail-read');

                    // Perbarui badge jumlah laporan belum dibaca
                    fetch('/laporan/count-unread')
                        .then(response => response.json())
                        .then(data => {
                            if (badge) {
                                if (data.unreadCount > 0) {
                                    badge.textContent = data.unreadCount;
                                    badge.style.display = 'inline-block';
                                } else {
                                    badge.style.display = 'none';
                                }
                            }

                            // Hilangkan tombol tandai semua dibaca apabila tidak ada lagi yg Belum Dibaca
                            const markAllReadButton = document.getElementById("markAllReadBtn");
                            if (markAllReadButton) {
                                markAllReadButton.style.display = data.unreadCount > 0 ? "block" : "none";
                            }
                        })
                        .catch(err => console.error('Gagal memperbarui badge:', err));
                })

                .catch(error => {
                    console.error("Error updating status:", error);
                    alert("Terjadi kesalahan dalam memperbarui status laporan.");
                });
        }

        function sendReply() {
            let replyInput = document.getElementById("reply-input");
            let replyText = replyInput.value.trim();

            // Validasi input kosong dan panjang minimal
            if (replyText === "") {
                Swal.fire({
                    icon: "warning",
                    title: "Input Kosong!",
                    text: "Balasan tidak boleh kosong.",
                    confirmButtonText: "OK"
                });
                return;
            }
            if (replyText.length < 10) {
                Swal.fire({
                    icon: "warning",
                    title: "Balasan Terlalu Pendek!",
                    text: "Balasan minimal berisi 10 karakter.",
                    confirmButtonText: "OK"
                });
                return;
            }

            Swal.fire({
                title: "Kirim Balasan?",
                text: "Pastikan kamu memberikan jawaban dengan jelas dan informatif!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Kirim",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    let laporanId = replyInput.getAttribute("data-laporan-id"); // Ambil ID laporan
                    console.log("Mengirim balasan untuk laporan ID:", laporanId);

                    fetch(`/admin/laporan/${laporanId}/balas`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                            },
                            body: JSON.stringify({
                                balasan: replyText
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                let replyContainer = document.getElementById("overlay-reply");
                                replyContainer.innerHTML = `<strong>Balasan Admin:</strong> <p>${data.balasan}</p>`;
                                replyContainer.style.display = "block";

                                // Sembunyikan input balasan
                                let replyForm = document.getElementById("overlay-footer");
                                if (replyForm) replyForm.style.display = "none";

                                Swal.fire({
                                    icon: "success",
                                    title: "Balasan Terkirim!",
                                    text: "Berhasil mengirimkan balasan.",
                                    confirmButtonText: "OK"
                                }).then(() => {
                                    // Refresh halaman setelah swal sukses ditutup
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal Mengirim!",
                                    text: "Terjadi kesalahan, silakan coba lagi.",
                                    confirmButtonText: "OK"
                                });
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire({
                                icon: "error",
                                title: "Terjadi Kesalahan!",
                                text: "Tidak dapat mengirim balasan.",
                                confirmButtonText: "OK"
                            });
                        });
                }
            });
        }

        function closeOverlay() {
            document.getElementById('messageOverlay').style.display = 'none';
        }
    </script>

    <!-- Logika tandai semua dibaca -->
    <script>
        function markAllAsRead() {
            fetch('{{ route("admin.markAllRead") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Sembunyikan tombol setelah semua pesan ditandai dibaca
                        document.getElementById('markAllReadBtn').style.display = 'none';

                        // Sembunyikan badge notifikasi karena semua sudah dibaca
                        const badge = document.getElementById('badge-laporan-admin');
                        if (badge) badge.style.display = 'none';

                        // Perbarui tampilan setiap pesan yang masih "Terkirim"
                        document.querySelectorAll('.media').forEach(el => {
                            if (!el.classList.contains('mail-read')) {
                                el.classList.add('mail-read');

                                let bullet = el.querySelector('.bullet-unread');
                                if (bullet) bullet.remove();

                                let statusIcon = el.querySelector('.status-icon');
                                if (statusIcon) {
                                    const laporanId = el.getAttribute('data-id'); // pastikan ada data-id di elemen .media
                                    if (data.status_icon && data.status_icon[laporanId]) {
                                        statusIcon.innerHTML = data.status_icon[laporanId];
                                    }
                                }
                            }
                        });
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Terjadi kesalahan:', error));
        }
    </script>
</body>

</html>