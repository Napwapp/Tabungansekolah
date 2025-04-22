<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabungan Sekolah</title>

    <link rel="stylesheet" href="{{asset ('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="shortcut icon" href="{{asset ('dashboard/dist/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset ('dashboard/dist/assets/images/logo/logosekolah.png')}}" type="image/png">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/pages/riwayatadmin.css') }}">

    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/mycss/default.css') }}">
    <link rel="stylesheet" href="{{asset ('dashboard/dist/assets/css/main/app-dark.css')}}">
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
                            class="sidebar-item ">
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
                            class="sidebar-item active">
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
            <h1>Riwayat transaksi</h1>
            <!-- Filter dan Pencarian -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <select class="form-control" id="transactionType" style="cursor: pointer;">
                        <option value="">Semua Transaksi</option>
                        <option value="TopUp">TopUp</option>
                        <option value="Menabung">Menabung</option>
                        <option value="Penarikan">Penarikan</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="text" id="searchInput" placeholder="Cari Nama..." class="form-control">
                </div>

                <div id="rowsPerPageContainer">
                    <select id="rowsPerPage" style="cursor: pointer;">
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="all">All</option>
                    </select>
                    <span style="margin-left: 10px;">Data per halaman</span>
                </div>
            </div>

            <!-- Tabel Riwayat Transaksi -->
            <table id="riwayatTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Tipe</th>
                        <th>Nomor Tabungan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="transaksiBody">
                    @forelse($riwayatadmin as $transaksi)
                    <tr class="transaksi-row {{ $transaksi->tipe }}">
                        <td>{{ $transaksi->namalengkap }}</td>
                        <td>{{ $transaksi->created_at }}</td>
                        <td>{{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $transaksi->tipe }}</td>
                        <td>{{ $transaksi->id_tabungan }}</td>
                        <td>{{ $transaksi->status }}</td>
                    </tr>
                    @empty
                    <tr id="noDataRow">
                        <td colspan="6" class="text-center">Belum ada data</td>
                    </tr>
                    @endforelse
                    <tr id="notFoundRow" style="display: none;">
                        <td colspan="6" class="text-center">Tidak dapat menemukan data</td>
                    </tr>
                </tbody>
            </table>

            <!-- Perhitungan data -->
            <div id="dataCountText" class="mt-2 text-muted small"></div>

            <div class="pagination-controls d-flex justify-content-end align-items-center gap-2 mt-3" id="paginationControls">
                <button id="firstPage" class="btn btn-outline-secondary btn-sm">&laquo;</button>
                <button id="prevPage" class="btn btn-outline-secondary btn-sm">&lsaquo;</button>
                <span id="currentPage" class="mx-2">Page 1</span>
                <button id="nextPage" class="btn btn-outline-secondary btn-sm">&rsaquo;</button>
                <button id="lastPage" class="btn btn-outline-secondary btn-sm">&raquo;</button>
            </div>


            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <!-- bila perlu -->
                </div>
            </footer>
        </div>
    </div>

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('riwayatTable');
            const rows = table.getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function() {
                const filter = searchInput.value.toLowerCase();

                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');

                    const nis = cells[0]?.textContent.toLowerCase() || '';
                    const nama = cells[1]?.textContent.toLowerCase() || '';

                    const match = nis.includes(filter) || nama.includes(filter);

                    row.style.display = match ? '' : 'none';
                }
            });
        });
    </script> -->

    <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>

    <script src="{{asset('dashboard/dist/assets/js/myjs/riwayatadmin.js')}}"></script>

</body>

</html>