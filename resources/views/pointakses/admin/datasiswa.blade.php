<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabungan Siswa</title>
    
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/tabungan/assets/images/logo/logoSMK_.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/tabungan/assets/images/logo/logoSMK_.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/pages/data-siswa.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/tabungan/assets/css/tabungansiswa.css')}}"> 
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
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" >
                                <label class="form-check-label" ></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path></svg>
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
                        class="sidebar-item ">
                        <a href="{{route('dataanggota')}}" class='sidebar-link'>
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>Daftar Anggota</span>
                        </a>
                        </li>
                        
                        <li
                            class="sidebar-item  has-sub active">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Tabungan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{route('kelasmin')}}">Data Tabungan Kelas</a>
                                </li>
                                <li class="submenu-item active">
                                    <a href="{{route('datasiswa')}}">Data Tabungan Siswa</a>
                                </li>
                            </ul>
                        </li>

                        <li
                        class="sidebar-item  ">
                        <a href="{{route('pesan')}}" class='sidebar-link'>
                            <i class="bi bi-chat-dots-fill"></i>
                            <span>Riwayat Transaksi</span>
                        </a>
                        </li>

                                    
                        <li
                            class="sidebar-item  ">
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
                            </ul>
                        </li> -->
                    
                        <form action="{{route('logout')}}" method="post" type="submit" class="sidebar-item" style="margin-left: 15px; color:rgb(124, 141, 181)">
                            @csrf
                            <i class="bi bi-x-octagon-fill"></i>
                            <button style="border: none; padding: 10px; background-color: white;">Log Out</button>               
                    </ul>
                </div>
            </div>
        <div id="main">
            <p><!-- Content -->
                <div class="content" style="margin-left: 30px;">
                    <h2 class="mb-4">Informasi Tabungan Siswa</h2>
    
                    <!-- Kartu Informasi -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: white;">Total Saldo Tabungan</h5>
                                    <h3 style="color: white;">Rp 0</h3>
                                    <p>Semua Siswa.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body btn-green" style="border-radius: 10px;">
                                    <h5 class="card-title" style="color: white;">Jumlah Transaksi</h5>
                                    <h3 style="color: white;">Rp 0</h3>
                                    <p>Hari Ini.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body btn-blue" style="border-radius: 10px;">
                                    <h5 class="card-title " style="color: white;">Jumlah Siswa</h5>
                                    <h3 style="color: white;">Rp 0</h3>
                                    <p>Yang Menabung </p>
                                </div>
                            </div>
                        </div>
                    </div>
    
                   
    
                    <!-- Grafik Tabungan -->
                    <!-- akan menghitung data total tabungan Pengguna setiap bulannya -->
                    <div class="card bg-light text-dark mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Data Tabungan Siswa</h5>
                            <canvas id="tabunganChart" height="100"></canvas>
                        </div>
                    </div>
            </div>
            <!-- UNTUK GRAFIK TABUNGAN -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('tabunganChart').getContext('2d');
                const tabunganChart = new Chart(ctx, {
                    type: 'line', // Pilih tipe grafik: line, bar, dll.
                        data: {
                            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Aug', 'Sept', 'Nov', 'Des'], // Ubah sesuai data Anda
                            datasets: [{
                                label: 'Jumlah Tabungan',
                                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], // Data grafik
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
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
            </script>
            <div class="container">
    <h1>Data Siswa</h1>
    <div class="search">
        <input type="text" id="searchInput" placeholder="Cari anggota berdasarkan nama atau kelas...">
        <button onclick="filterTable()">Cari</button>
    </div>
    <div class="add-member">
        <button onclick="addMember()">Tambah Anggota</button>
    </div>
    <table id="membersTable">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Total Saldo</th>
                <th>Jumlah Setoran</th>
                <th>Jumlah Penarikan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datasiswa as $siswa)
            <tr>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->kelas }}</td>
                <td>{{ $siswa->jurusan }}</td>
                <td>{{ number_format($siswa->total_saldo, 0, ',', '.') }}</td>
                <td>{{ number_format($siswa->setoran, 0, ',', '.') }}</td>
                <td>{{ number_format($siswa->penarikan, 0, ',', '.') }}</td>
                <td>
                    <button onclick="editMember('{{ $siswa->id }}')">Edit</button>
                    <button onclick="deleteMember('{{ $siswa->id }}')">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2025 &copy; SMKN 1 BINONG</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                href="https://smkn1binong.sch.id/home">SMKN 1 BINONG</a></p>
            </div>
        </div>
    </footer>
             
    <script src="{{asset('dashboard/dist/tabungan/assets/js/tabungansiswa.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>
</body>
</html>