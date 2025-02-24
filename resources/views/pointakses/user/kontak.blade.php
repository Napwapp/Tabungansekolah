<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <h3>Email Application</h3>
                            <p class="text-subtitle text-muted">A full inbox-ui for you to implement messaging</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Email Application</li>
                                </ol>
                            </nav>
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
                                                    <li class="media mail-read" onclick="openMessageOverlay()">
                                                        <div class="user-action">
                                                            <div class="checkbox-con me-3">
                                                                <div class="checkbox checkbox-shadow checkbox-sm">
                                                                    <input type="checkbox" id="checkboxsmall1" class="form-check-input">
                                                                    <label for="checkboxsmall1"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pr-50">
                                                            <div class="avatar">
                                                                <img src="{{asset('dashboard/dist/assets/images/faces/1.jpg')}}" alt="avatar img holder">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="user-details">
                                                                <div class="wrapper-name-mail">
                                                                    <div class="sender-name">
                                                                        <strong>Nama Pengirim</strong> <!-- Gantilah nanti dengan data dari database -->
                                                                    </div>
                                                                    <div class="mail-items">
                                                                        <span class="list-group-item-text text-truncate">Open source project public release 👍</span>
                                                                    </div>
                                                                </div>
                                                                <div class="mail-meta-item">
                                                                    <span class="float-right">
                                                                        <span class="mail-date">4:14 AM</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mail-message">
                                                                <p class="list-group-item-text truncate mb-0">
                                                                    Hey John, bah kivu decrete epanorthotic unnotched Argyroneta nonius veratrine preimaginary
                                                                </p>
                                                                <div class="mail-meta-item">
                                                                    <span class="float-right">
                                                                        <span class="bullet bullet-success bullet-sm"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="media" onclick="openMessageOverlay()">
                                                        <div class="user-action">
                                                            <div class="checkbox-con me-3">
                                                                <div class="checkbox checkbox-shadow checkbox-sm">
                                                                    <input type="checkbox" id="checkboxsmall3"
                                                                        class='form-check-input'>
                                                                    <label for="checkboxsmall3"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pr-50">
                                                            <div class="avatar">
                                                                <img class="rounded-circle" src="{{asset('dashboard/dist/assets/images/faces/7.jpg')}}"
                                                                    alt="Generic placeholder image">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="user-details">
                                                                <div class="wrapper-name-mail">
                                                                    <div class="sender-name">
                                                                        <strong>Nama Pengirim</strong> <!-- Gantilah nanti dengan data dari database -->
                                                                    </div>
                                                                    <div class="mail-items">
                                                                        <span class="list-group-item-text text-truncate">Open source
                                                                            project public release 👍</span>
                                                                    </div>
                                                                </div>
                                                                <div class="mail-meta-item">
                                                                    <span class="float-right">
                                                                        <span class="mail-date">2:15 AM</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mail-message">
                                                                <p class="list-group-item-text mb-0 truncate">
                                                                    I will provide you more details after this Saturday. Hope
                                                                    that will be fine for you..
                                                                </p>
                                                                <div class="mail-meta-item">
                                                                    <span class="float-right d-flex align-items-center">
                                                                        <i class="bi bi-paperclip me-3"></i>
                                                                        <span class="bullet bullet-success bullet-sm"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <!-- Overlay Detail Pesan -->
                                                    <div id="messageOverlay" class="overlay">
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
                                                                <h3 class="message-title">Judul Pesan</h3>

                                                                <!-- Container Profil Pengirim -->
                                                                <div class="sender-profile">
                                                                    <div class="sender-image">
                                                                        <img src="{{asset('dashboard/dist/assets/images/faces/1.jpg')}}" alt="Foto Profil Pengirim" >
                                                                    </div>
                                                                    <div class="sender-info">
                                                                        <div class="wrapper-left-right">
                                                                            <span class="sender-name">Nama Pengirim</span>
                                                                            <span class="message-date">12 Mar</span>
                                                                        </div>
                                                                        <span class="to-me">Kepada saya</span>
                                                                    </div>
                                                                </div>

                                                                <!-- Isi Pesan Lengkap -->
                                                                <div class="message-content">
                                                                    <p>
                                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dapibus, orci non tristique
                                                                        mollis, augue magna facilisis nisi, in vestibulum sapien enim a nulla. Curabitur vitae
                                                                        justo non turpis convallis tincidunt.
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <!-- Footer: Input untuk membalas pesan -->
                                                            <div class="overlay-footer">
                                                                <input type="text" class="reply-input" placeholder="Balas pesan...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
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

                                    <!-- Detailed Email View -->

                                    <!--/ Detailed Email View -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
<<<<<<< HEAD

        <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
        <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>
=======
    </div>
    <script src="{{asset('dashboard/dist/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard/dist/assets/js/app.js')}}"></script>

    <script src="{{ asset('dashboard/dist/assets/js/myjs/emailcustom.js') }}"></script>

    <script>
        document.querySelector('.sidebar-toggle').addEventListener('click', () => {
            document.querySelector('.email-app-sidebar').classList.toggle('show')
        })
        document.querySelector('.sidebar-close-icon').addEventListener('click', () => {
            document.querySelector('.email-app-sidebar').classList.remove('show')
        })
    </script>

>>>>>>> profile
</body>

</html>