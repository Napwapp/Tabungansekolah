<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Profil</title>
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/shared/iconly.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/riwayat.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/profil.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/default.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app-dark.css')}}">

    <!-- toastr css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

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
                            class="sidebar-item active">
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

            <div class="profile-header">
                <div class="profile-cover">
                    <div class="profile-avatar">
                    <img id="profileImageMain" src="{{ asset('picture/accounts/' . $user->gambar) }}" alt="Foto Profil">
                        <div class="avatar-overlay">
                            <i class="camera-icon bi bi-camera"></i>
                        </div>
                    </div>
                </div>

                <!-- Modal Overlay -->
                <div class="profile-modal" id="profileModal">
                    <div class="modal-content">
                        <div class="close-button-container">
                            <button class="close-button"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="profile-card">
                            <div class="avatar-container">
                                <img id="modalImage" src="" alt="Profile Picture" class="modal-avatar">
                            </div>
                            <div class="profile-info">
                                <h3 class="profile-name">{{ $user->namalengkap }}</h3>
                                <p class="profile-role">{{ $user->role }}</p>
                                <p class="profile-bio">"Menabung bukan tentang uang yang tersisa, tapi tentang disiplin mengelola keuangan."</p>
                                <button class="edit-profile-button">Edit foto profil</button>
                                <input type="file" id="inputEditFoto" accept="image/png, image/jpeg, image/jpg" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="profile-basic-info">
                    <h1>{{Auth::user()->namalengkap}}</h1>
                    <p>{{Auth::user()->email}}</p>
                </div>
            </div>

            <!-- data keuangan -->
            <h1 style="font-size: 23px; margin: 30px 0 20px 0;">Data Keuangaan</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white;">Saldo Tersisa</h5>
                            <h3 style="color: white;">Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
                            <p>Saldo yang anda miliki.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white;">Total Tabungan Anda</h5>
                            <h3 style="color: white;">Rp{{ number_format($totalTabungan, 0, ',', '.') }}</h3>
                            <p>Tabungan hingga saat ini.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white;">Penarikan Bulan Ini</h5>
                            <h3 style="color: white;">Rp {{ number_format($penarikanDisetujuiBulanIni, 0, ',', '.') }}</h3>
                            <p>Total Penarikan Anda bulan ini.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-details">
                <div class="profile-section">
                    <h2>Informasi Akun</h2>
                    <form id="form-edit-profil" method="POST" action="{{ route('profil.user.update') }}">
                        @csrf
                        <div class="profile-item">
                            <span>Nama Lengkap :</span>
                            <span class="profile-value" data-key="namalengkap">{{ $user->namalengkap }}</span>
                        </div>
                        <div class="profile-item">
                            <span>Username :</span>
                            <span class="profile-value" data-key="username">{{ $user->username }}</span>
                        </div>
                        <div class="profile-item">
                            <span>Email :</span>
                            <span class="profile-value" data-key="email">{{ $user->email }}</span>
                        </div>
                        <div class="profile-item">
                            <span>ID Tabungan :</span>
                            <span class="profile-value" data-key="id_tabungan">{{ $user->tabungan->id_tabungan ?? 'ID tabungan tidak tersedia' }}</span>
                        </div>
                        <div class="profile-item">
                            <span>Kelas :</span>
                            <span class="profile-value" data-key="kelas">{{ $user->kelas }}</span>
                        </div>
                        <div class="profile-item">
                            <span>Tanggal Bergabung :</span>
                            <span class="profile-value" data-key="created_at">{{ $user->created_at }}</span>
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-top: 15px; display: none;" id="btn-simpan-edit">Simpan Perubahan</button>
                        <button id="btn-batal-edit" class="btn btn-danger" style="margin-top: 15px; display: none;">Batal</button>
                    </form>

                    <button id="edit-profile-btn" class="btn btn-primary" style="margin-top: 15px;">Edit Profil</button>
                </div>
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

    <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/myjs/profil.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/myjs/editpict.js')}}"></script>

    <!-- toastr -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</body>

</html>