<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data anggota</title>
    <!-- Tenmplate css -->
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/fonts/material.css') }}">

    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/logoSMK_.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/logoSMK_.png')}}" type="image/png">

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/pages/simple-datatables.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/default.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app-dark.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/data-anggota.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('dashboard_admin/dist/assets/css/style-preset.css') }}">

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
                            class="sidebar-item ">
                            <a href="{{route('profil')}}" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Profil</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item active">
                            <a href="{{route('dataanggota')}}" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Data anggota</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item ">
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
            <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>


                <h1>Pengguna</h1>

                <div class="search-bar">
                    <div class="search-container">
                        <span class="search-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </span>
                        <input type="text" id="searchInput" placeholder="Search members">
                    </div>

                    <!-- Show All Checkbox -->
                    <div id="toggle-pagination-wrapper" style="display: none;" class="form-check me-3 mb-0">
                        <input class="form-check-input" type="checkbox" value="" id="toggleShowAll">
                        <label class="form-check-label" for="toggleShowAll">
                            Show All
                        </label>
                    </div>

                    <!-- Wrapper untuk tombol -->
                    <div class="d-flex align-items-center gap-2">
                        <!-- Tombol Hapus -->
                        <button id="delete-selected" class="btn btn-outline-danger d-none d-flex align-items-center gap-1" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5.5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6zm2.5-.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                <path fill-rule="evenodd"
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h4.707a1 1 0 0 1 .707.293l.646.647.646-.647A1 1 0 0 1 10.793 2H15.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3a.5.5 0 0 0 0 1H13.5a.5.5 0 0 0 0-1H2.5z" />
                            </svg>
                            Hapus
                        </button>

                        <!-- Tombol Add Member -->
                        <a href="#add-member-form" class="add-btn d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            Add member
                        </a>
                    </div>
                </div>

                <!-- Table View for Desktop -->
                <form id="form-delete-selected">
                    @csrf
                    <div class="table-container">
                        <input type="hidden" name="_method" value="DELETE">
                        <table>
                            <thead>
                                <tr>
                                    <!-- Di header tabel (centang semua) -->
                                    <th><input type="checkbox" id="select-all-desktop" class="checkbox-master"></th>
                                    <th><span>PENGGUNA</span></th>
                                    <th><span>USERNAME</span></th>
                                    <th><span>EMAIL</span></th>
                                    <th><span>ID TABUNGAN</span></th>
                                    <th><span>KELAS</span></th>
                                    <th><span>ROLE</span></th>
                                    <th><span>TANGGAL BERGABUNG</span></th>
                                </tr>
                            </thead>
                            <tbody id="desktop-user-container">
                                @forelse ($data as $user)
                                <tr>
                                    <td><input type="checkbox" class="checkbox checkbox-item-desktop" value="{{ $user->id }}"></td>

                                    <td>
                                        <div class="user-info">
                                            <img src="{{ asset('picture/accounts/' . $user->gambar ?? '/api/placeholder/32/32') }} " alt="Avatar" class="avatar avatar-xl me3">
                                            <span class="user-name">{{ $user->namalengkap }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->tabungan->id_tabungan ?? '-' }}</td>
                                    <td>{{ $user->kelas }}</td>
                                    <td>
                                        <select class="form-control select-role"
                                            name="role"
                                            data-current-value="{{ $user->role }}"
                                            data-update-url="{{ route('updateRole', $user->id) }}">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </td>

                                    <td class="created-at position-relative">
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada pengguna.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                    <!-- Card View for Mobile -->
                    <div class="cards-container d-lg-none" id="mobile-user-container"> <!-- d-lg-none untuk sembunyikan di desktop -->
                        <header>
                            <div class="header">
                                <input type="checkbox" id="select-all-mobile" class="checkbox-master">
                                <span class="ms-2">Pilih Semua</span>
                            </div>
                        </header>
                        @forelse ($data as $user)

                        <div class="card">
                            <div class="card-header position-relative">
                                <input type="checkbox" class="checkbox checkbox-item-mobile" value="{{ $user->id }}">
                                <div class="user-info">
                                    <img src="{{ $user->gambar ? asset('picture/accounts/' . $user->gambar) : '/api/placeholder/32/32' }}" alt="Avatar" class="avatar">
                                    <span class="user-name">{{ $user->namalengkap }}</span>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="card-row">
                                    <div class="card-label">USERNAME:</div>
                                    <div class="card-value">{{ $user->username }}</div>
                                </div>
                                <div class="card-row">
                                    <div class="card-label">EMAIL:</div>
                                    <div class="card-value">{{ $user->email }}</div>
                                </div>
                                <div class="card-row">
                                    <div class="card-label">ID TABUNGAN:</div>
                                    <div class="card-value">{{ $user->tabungan->id_tabungan ?? '-' }}</div>
                                </div>
                                <div class="card-row">
                                    <div class="card-label">KELAS:</div>
                                    <div class="card-value city-text">{{ $user->kelas }}</div>
                                </div>
                                <div class="card-row">
                                    <div class="card-label">ROLE:</div>
                                    <div class="card-value w-100"> {{-- kasih w-100 biar select-nya nggak kepotong --}}
                                        <select class="form-control form-control-sm select-role"

                                            name="role"
                                            data-current-value="{{ $user->role }}"
                                            data-update-url="{{ route('updateRole', $user->id) }}">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-row">
                                    <div class="card-label">BERGABUNG:</div>
                                    <div class="card-value">
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('M d, H:i A') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center w-100">Tidak ada data pengguna.</div>
                        @endforelse
                    </div>
                </form>
                <!-- end card view mobile -->

                <div class="pagination">
                    <div>1 to 5 items of 15</div>
                    <div class="pagination-controls">
                        <!-- JS akan mengganti isinya -->
                    </div>
                </div>

                <!-- Add Member Form -->
                <div id="add-member-form" class="add-member-form">
                    <h2>Tambah Anggota Baru</h2>
                    <form id="form-tambah-anggota">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="namalengkap">Nama Lengkap</label>
                                <input type="text" id="namalengkap" name="namalengkap" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Masukkan alamat email" required>
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas / Jurusan</label>
                                <select id="kelas" name="kelas" class="select-kelas" required>
                                    <option value="" disabled selected>Pilih Kelas</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group position-relative">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan password"
                                    required>
                                <i class="bi bi-eye-slash position-absolute end-0 me-3 toggle-password"
                                    data-target="password"
                                    style="cursor: pointer; top: calc(50% + 10px); transform: translateY(-50%);">
                                </i>
                            </div>

                            <div class="form-group position-relative ">
                                <label for="confirm_password">Konfirmasi Password</label>
                                <input
                                    type="password"
                                    id="confirm_password"
                                    name="confirm_password"
                                    placeholder="Ulangi password"
                                    required>
                                <i class="bi bi-eye-slash position-absolute end-0 me-3 toggle-password"
                                    data-target="confirm_password"
                                    style="cursor: pointer; top: calc(50% + 10px); transform: translateY(-50%);">
                                </i>
                            </div>
                        </div>


                        <!-- Gambar -->
                        <label for="gambar">Gambar</label>
                        <div class="form-control">
                            <input type="file" name="gambar" id="gambar" required>
                        </div>

                        <div class="form-actions" style="margin-bottom: 30px;">
                            <button type="submit" class="submit-btn">Simpan</button>
                            <!-- <button type="button" class="cancel-btn">Batal</button> -->
                        </div>
                    </form>
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
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            const deleteBtn = document.getElementById('delete-selected');
            const form = document.getElementById('form-delete-selected');

            deleteBtn.addEventListener('click', function() {
                const checkedIds = Array.from(document.querySelectorAll('.checkbox-item-desktop:checked, .checkbox-item-mobile:checked'))
                    .map(cb => cb.value);

                if (checkedIds.length === 0) return;

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Semua data terkait akun akan ikut dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch("{{ route('datahapus.mass') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    _method: 'DELETE',
                                    ids: checkedIds
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire('Berhasil', data.message, 'success').then(() => {
                                        location.reload(); // reload halaman setelah berhasil hapus
                                    });
                                } else {
                                    Swal.fire('Gagal', data.message, 'error');
                                }
                            })
                            .catch(() => {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
                            });
                    }
                });
            });
        </script>

        <script>
            document.querySelectorAll('.select-role').forEach(select => {
                select.addEventListener('change', function(e) {
                    const selectedRole = this.value;
                    const currentRole = this.dataset.currentValue;
                    const updateUrl = this.dataset.updateUrl;

                    if (selectedRole === currentRole) return;

                    // Kembalikan dulu ke nilai sebelumnya, tunggu konfirmasi
                    this.value = currentRole;

                    Swal.fire({
                        title: 'Ubah Role?',
                        text: 'Apakah anda yakin ingin mengubah rolenya?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, ubah',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33'
                    }).then(result => {
                        if (result.isConfirmed) {
                            fetch(updateUrl, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        role: selectedRole
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        Swal.fire({
                                            title: 'Berhasil',
                                            text: data.message,
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        }).then(() => {
                                            location.reload();
                                        });
                                        // Update currentValue (biar next time gak diubah lagi)
                                        select.dataset.currentValue = selectedRole;
                                        select.value = selectedRole;
                                    } else {
                                        Swal.fire('Gagal', data.message, 'error');
                                        select.value = currentRole;
                                    }
                                })
                                .catch(() => {
                                    Swal.fire('Error', 'Terjadi kesalahan saat mengubah role.', 'error');
                                    select.value = currentRole;
                                });
                        } else {
                            // Jika dibatalkan, pastikan tetap di posisi awal
                            select.value = currentRole;
                        }
                    });
                });
            });
        </script>
        <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
        <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>

        <!-- myjs -->
        <script src="{{ asset('dashboard/dist/assets/js/myjs/data-anggota.js') }}"></script>
        <script src="{{ asset('dashboard/dist/assets/js/myjs/addmembers.js') }}"></script>

        <!-- toastr -->
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>