<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan User</title>
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/pages/pesan.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/favicon.png')}}" type="image/png">

    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/mycss/default.css') }}">
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
                <div class="container">
                    <div class="content">
                        <h1 class="text-2xl font-semibold mb-4">Pesan dari Pengguna</h1>
                        <div class="filter-search-container">
                            <div class="filter-container">
                                <label for="filter">Filter Kategori:</label>
                                <select id="filter" class="border rounded-lg px-3 py-2" onchange="filterMessages()">
                                    <option value="all">Semua</option>
                                    <option value="bug">Laporan Bug</option>
                                    <option value="saran">Saran</option>
                                    <option value="saran">Selesai</option>
                                </select>
                            </div>
                            <div class="search-container">
                                <div class="search-box">
                                    <input type="text" id="search" class="search-input" placeholder="Cari pesan..." onkeyup="searchMessages(event)">
                                    <button id="search-btn" class="search-button" onclick="searchMessages()">🔍</button>
                                </div>
                            </div>
                        </div>
                        <div id="messages" class="message-container">
                            <div class="message-card" data-category="bug" data-id="1">
                                <div class="message-header">
                                    <input type="checkbox" class="message-checkbox" onchange="saveStatus(1)">
                                    Laporan Bug
                                </div>
                                <div class="message-body">
                                    <div class="user-info">
                                        <img src="{{asset('dashboard/dist/assets/images/samples/_3.jpeg') }}" alt="Profile Mitsuki" class="profile-pic">
                                        <p><strong>Nama:</strong> Mitsuki </p>
                                        <p><strong>Email:</strong> mitsuki@gmail.com </p>
                                        <p><strong>Tanggal:</strong>15 Februari 2025</p>
                                    </div>
                                    <p><strong>Deskripsi:</strong> Tombol simpan tidak berfungsi di halaman tabungan.</p>
                                </div>
                                <button class="reply-button">Balas</button>
                            </div>

                            <div class="message-card" data-category="saran" data-id="2">
                                <div class="message-header">
                                    <input type="checkbox" class="message-checkbox" onchange="saveStatus(2)">
                                    Saran
                                </div>
                                <div class="message-body">
                                    <div class="user-info">
                                        <img src="{{asset('dashboard/dist/assets/images/samples/✧ Stelle.jpeg')  }}" alt="Profile Stelle" class="profile-pic">
                                        <p><strong>Nama:</strong> Stelle </p>
                                        <p><strong>Email:</strong> stelle@gmail.com </p>
                                        <p><strong>Tanggal:</strong> 14 Februari 2025 </p>
                                    </div>
                                    <p><strong>Deskripsi:</strong> Mohon tambahkan fitur pencarian data tabungan.</p>
                                </div>
                                <button class="reply-button">Balas</button>
                            </div>

                            <div class="message-card completed" data-category="selesai" data-id="3">
                                <div class="message-header">
                                    <input type="checkbox" class="message-checkbox" onchange="saveStatus(3)">
                                    Saran - <span class="status-tabel">Sudah Dibalas & Selesai</span>
                                </div>
                                <div class="message-body">
                                    <div class="user-info">
                                        <img src="{{asset('dashboard/dist/assets/images/samples/🥝✧﹒ danheng png ☆.jpeg')  }}" alt="Profile Dan Heng" class="profile-pic">
                                        <p><strong>Nama:</strong> Dan Heng </p>
                                        <p><strong>Email:</strong> danang@gmail.com </p>
                                        <p><strong>Tanggal:</strong> 12 Februari 2025 </p>
                                    </div>
                                    <p><strong>Deskripsi:</strong> Tolong tambahkan fitur Edit Profil agar pengguna bisa mengedit atau mengubah data pribadi kami.</p>
                                    <p class="admin-reply"><strong>Admin:</strong>Terima kasih atas saran nya! fitur nya sedang kami kerjakan dan akan selesai dalam beberapa saat.</p>
                                </div>
                                <button class="reply-button">Sudah Dibalas</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function searchMessages(event) {
            if (event && event.key === "Enter") {
                document.getElementById("search-btn").click();
            }

            let query = document.getElementById("search").value.toLowerCase();
            let messages = document.querySelectorAll(".message-card");

            messages.forEach(message => {
                let text = message.innerText.toLowerCase();
                if (text.includes(query)) {
                    message.style.display = "block";
                } else {
                    message.style.display = "none";
                }
            });
        }

        function filterMessages() {
            let filter = document.getElementById('filter').value;
            let messages = document.querySelectorAll('.message-card');

            messages.forEach(message => {
                if (filter === 'all' || message.getAttribute('data-category') === filter) {
                    message.style.display = 'block';
                } else {
                    message.style.display = 'none';
                }
            });
        }

        function saveStatus(id) {
            let checkbox = document.querySelector(`.message-card[data-id="${id}"] .message-checkbox`);
            localStorage.setItem(`message_${id}_checked`, checkbox.checked);
        }

        function loadStatus() {
            let checkboxes = document.querySelectorAll('.message-checkbox');
            checkboxes.forEach(checkbox => {
                let id = checkbox.closest('.message-card').getAttribute('data-id');
                let savedStatus = localStorage.getItem(`message_${id}_checked`);
                if (savedStatus === 'true') {
                    checkbox.checked = true;
                }
            });
        }

        // Panggil saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadStatus);
    </script>

    <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>

</body>

</html>