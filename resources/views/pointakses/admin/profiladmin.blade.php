<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/logoSMK_.png')}}" type="image/png">

    <!-- mycss -->
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/profil.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/profiladmin.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/default.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app-dark.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/shared/iconly.css')}}">
    <script src="{{asset('dashboard/dist/assets/js/myjs/profil.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            <a href="{{route('admin')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item active">
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
                            class="sidebar-item  ">
                            <a href="{{route('kelasmin')}}" class='sidebar-link'>
                                <i class="bi bi-wallet-fill"></i>
                                <span>Data tabungan siswa</span>
                            </a>
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
                        <img src="{{ asset('picture/accounts/' . Auth::user()->gambar) }}" alt="">
                    </div>
                </div>
                <div class="profile-basic-info">
                    <h1>{{Auth::user()->username}}</h1>
                    <p>{{Auth::user()->email}}</p>
                </div>
            </div>

            <div class="profile-details">
                <div class="profile-section">
                    <h2>Informasi Akun</h2>

                    <div class="profile-item">
                        <span>Nama Lengkap :</span>
                        <span>{{Auth::user() -> namalengkap}}</span>
                    </div>
                    <div class="profile-item">
                        <span>Username :</span>
                        <span>{{Auth::user() -> username}}</span>
                    </div>
                    <div class="profile-item">
                        <span>Role :</span>
                        <span>{{Auth::user() -> role}}</span>
                    </div>
                    <div class="profile-item">
                        <span>Email :</span>
                        <span>{{Auth::user() -> email}}</span>
                    </div>

                    <div class="profile-details">
                        <div class="profile-section">
                            <!-- Tombol Edit -->
                            <button id="edit-profile-btn" class="btn btn-primary">Edit Profil</button>

                            <!-- Form Edit (Tersembunyi Awalnya) -->
                            <form id="edit-profile-form" style="display: none; margin-top: 10px;">
                                @csrf
                                <div class="profile-item ">
                                    <span>Nama Lengkap :</span>
                                    <input type="text" id="namalengkap" name="namalengkap" value="{{ $admin->namalengkap }}" class="form-control">
                                </div>
                                <div class="profile-item ">
                                    <span>Username :</span>
                                    <input type="text" id="username" name="username" value="{{ $admin->username }}" class="form-control">
                                </div>
                                <div class="profile-item ">
                                    <span>Email :</span>
                                    <input type="text" id="email" name="email" value="{{ $admin->email }}" class="form-control">
                                </div>
                                <div class="profile-item ">
                                    <span>Foto :</span>
                                    <input type="file" id="gambar" name="gambar" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" id="cancel-edit" class="btn btn-secondary">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
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


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let editBtn = document.getElementById("edit-profile-btn");
                let cancelBtn = document.getElementById("cancel-edit");
                let editForm = document.getElementById("edit-profile-form");

                // Saat tombol edit diklik, tampilkan form
                editBtn.addEventListener("click", function() {
                    editForm.style.display = "block";
                    editBtn.style.display = "none"; // Sembunyikan tombol Edit
                });

                // Saat tombol batal diklik, sembunyikan form dan tampilkan tombol Edit
                cancelBtn.addEventListener("click", function() {
                    editForm.style.display = "none";
                    editBtn.style.display = "block";
                });

                // Tangani submit form dengan AJAX
                document.getElementById("edit-profile-form").addEventListener("submit", function(event) {
                    event.preventDefault(); // Mencegah reload halaman

                    let formData = new FormData(this);

                    fetch("{{ route('profil.update') }}", {
                            method: "POST",
                            body: formData,
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: "Profil berhasil diperbarui.",
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload(); // Reload halaman untuk menampilkan data baru
                                });
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Terjadi kesalahan saat memperbarui profil.",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire({
                                title: "Error!",
                                text: "Terjadi kesalahan! Silakan coba lagi.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        });
                });
            });
        </script>

        <script>
            document.getElementById("gambar").addEventListener("change", function(event) {
                let reader = new FileReader();
                reader.onload = function() {
                    let previewImage = document.getElementById("preview-image");
                    previewImage.src = reader.result; // Menampilkan preview gambar sebelum upload
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        </script>
    </div>

    <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/pages/dashboard.js')}}"></script>
</body>

</html>