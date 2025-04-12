<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Tabungan Sekolah</title>

  <link rel="stylesheet" href="{{asset ('dashboard/dist/assets/css/main/app.css')}}">
  <link rel="shortcut icon" href="{{asset('dashboard/dist/assets/images/logo/logoSMK_.png')}}" type="image/x-icony">
  <link rel="shortcut icon" href="{{asset ('dashboard/dist/assets/images/logo/logosekolah.png')}}" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- my style -->
  <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/default.css')}}"> <!-- default dari riwayat transaksi user -->
  <link rel="stylesheet" href="{{asset('dashboard/dist/assets/css/mycss/seturl.css')}}">

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

                <li class="submenu-item ">
                  <a href="{{route('kelasmin')}}">Data Tabungan Siswa</a>
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
              class="sidebar-item">
              <a href="{{route('permintaan-transaksi')}}" class='sidebar-link'>
                <i class="bi bi-receipt"></i>
                <span>Permintaan transaksi</span>
              </a>
            </li>


            <li class="sidebar-item">
              <a href="{{ route('pesan') }}" class="sidebar-link">
                <i class="bi bi-envelope-fill"></i>
                <span>Pesan</span>
                @if (isset($unreadLaporanCount) && $unreadLaporanCount > 0)
                <span class="badge-notif">
                  <h2>{{ $unreadLaporanCount }}</h2>
                </span>
                @endif
              </a>
            </li>

            <li
              class="sidebar-item active">
              <a href="{{route('seturl')}}" class='sidebar-link'>
                <i class="bi bi-gear-fill"></i>
                <span>Pengaturan</span>
              </a>
            </li>

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
      <div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>
      <div class="container my-4">
        <h1 class="mb-4">Pengaturan Landing Page</h1>

        <!-- Section: Informasi Kontak & Email -->
        <div class="card mb-4">
          <div class="card-header">
            <h3>Informasi Kontak & Email</h3>
          </div>
          <div class="card-body">

            <!-- Alamat Sekolah -->
            <div class="mb-4">
              <h5>Alamat Sekolah</h5>
              <form method="POST" action="{{ $alamat ? route('admin.landing.alamat.update') : route('admin.landing.alamat.store') }}">
                @csrf
                <div class="mb-3">
                  <textarea class="form-control" name="alamat" placeholder="Masukkan alamat baru" rows="4" required>{{ $alamat->alamat ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                  {{ $alamat ? 'Update Alamat' : 'Tambah Alamat' }}
                </button>
              </form>
            </div>

            <!-- Kontak Telepon -->
            <div class="mb-4">
              <h5>Kontak Telepon</h5>
              <div id="list-kontak">
                @for ($i = 1; $i <= 3; $i++)
                  @php
                  $kontakData=$kontaks->firstWhere('id_informasi_kontak', $i);
                  @endphp
                  <div class="row mb-2">
                    <div class="col-md-12">
                      <div class="input-group">
                        <span class="input-group-text">+62</span>
                        <input type="text" name="nomor" class="form-control kontak-input" data-slot="{{ $i }}" value="{{ $kontakData ? ltrim($kontakData->nomor, '+62') : '' }}" placeholder="{{ $kontakData ? '' : 'Belum ada data' }}" required>
                        <input type="hidden" name="id_informasi_kontak" value="{{ $i }}">
                        <button class="btn btn-primary save-button" data-slot="{{ $i }}" style="display: none;">Simpan</button>
                        <button class="btn btn-success add-button" data-slot="{{ $i }}" style="display: none;">Tambah</button>
                      </div>
                    </div>
                  </div>
                  @endfor
              </div>

              <!-- Form tambah kontak baru -->
              <form id="form-tambah-kontak" method="POST" action="{{ route('admin.landing.kontak.store') }}">
                @csrf
                <div class="row g-3 align-items-end">
                  <div class="col-auto">
                    <label class="visually-hidden" for="new-kontak">Kontak Baru</label>
                    <div class="input-group">
                      <span class="input-group-text">+62</span>
                      <input type="text" class="form-control" id="new-kontak" name="nomor" placeholder="Masukkan nomor" required>
                    </div>
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="btn btn-success">Tambah Kontak</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- Email -->
          <div class="mb-4" style="padding: 25px;">
            <h5>Email</h5>
            <div id="list-email">
              @for($i = 1; $i <= 3; $i++)
                @php
                $emailData=$emails->firstWhere('id_informasi_email', $i);
                @endphp
                <div class="row mb-2">
                  <div class="col-md-12">
                    <div class="input-group">
                      <input type="text" name="email" class="form-control email-input"
                        data-slot="{{ $i }}" value="{{ $emailData ? $emailData->email : '' }}" placeholder="{{ $emailData ? '' : 'Belum ada data' }}" required>
                      <input type="hidden" name="id_informasi_email" value="{{ $i }}">
                      <button class="btn btn-primary save-button-email" data-slot="{{ $i }}" style="display: none;">Simpan</button>
                      <button class="btn btn-success add-button-email" data-slot="{{ $i }}" style="display: none;">Tambah</button>
                    </div>
                  </div>
                </div>
                @endfor
            </div>

            <!-- Form tambah email baru -->
            <form id="form-tambah-email" method="POST" action="{{ route('admin.landing.email.store') }}">
              @csrf
              <div class="row g-3 align-items-end">
                <div class="col-auto">
                  <label class="visually-hidden" for="new-email">Email Baru</label>
                  <input type="email" class="form-control" id="new-email" name="email" placeholder="Masukkan email baru" required>
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-success">Tambah Email</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Section: URL Sosial Media Team -->
      <div class="card">
        <div class="card-header">
          <h3>URL Sosial Media Team</h3>
        </div>

        <!-- sosmed -->
        <div class="card-body">
          <div class="row mb-4">

            <!-- Card Team Member anggota_1 -->
            <div class="col-md-4">
              <div class="card">
                <img src="{{asset('landingpage/assets/img/team/anggota_1.jpg')}}" class="card-img-top" alt="Foto Anggota pertama">
                <div class="card-body">
                  <h5 class="card-title">Muhamad Nawaf Abduh</h5>
                  <p class="card-text">Pelajar SMKN1 BINONG Kelas 11 PPLG</p>
                  <!-- Form Update Sosial Media -->
                  <form id="form-sosmed-anggota_1" action="{{ route('sosmed.update.anggota1') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                      <label for="anggota_1-github" class="form-label">GitHub</label>
                      <div class="input-group">
                        <input type="url" class="form-control" name="github" id="anggota_1-github" placeholder="{{ $informasiSosmed->github ? $informasiSosmed->github : 'Belum ada data' }}" value="{{ $informasiSosmed->github ?? '' }}">
                      </div>
                    </div>
                    <div class="mb-2">
                      <label for="anggota_1-instagram" class="form-label">Instagram</label>
                      <div class="input-group">
                        <input type="url" class="form-control" name="instagram" id="anggota_1-instagram" placeholder="{{ $informasiSosmed->instagram ? $informasiSosmed->instagram : 'Belum ada data' }}" value="{{ $informasiSosmed->instagram ?? '' }}">
                      </div>
                    </div>
                    <div class="mb-2">
                      <label for="anggota_1-linkedin" class="form-label">LinkedIn</label>
                      <div class="input-group">
                        <input type="url" class="form-control" name="linkedin" id="anggota_1-linkedin" placeholder="{{ $informasiSosmed->linkedin ? $informasiSosmed->linkedin : 'Belum ada data' }}" value="{{ $informasiSosmed->linkedin ?? '' }}">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-simpan-anggota_1" disabled>Simpan Perubahan</button>
                  </form>
                </div>
              </div>
            </div>

            <!-- Card Team Member: anggota_2 -->
            <div class="col-md-4">
              <div class="card">
                <img src="{{ asset('landingpage/assets/img/team/anggota_2.jpg') }}" class="card-img-top" alt="Foto Anggota kedua">
                <div class="card-body">
                  <h5 class="card-title">Bayu Hanggara Putra</h5>
                  <p class="card-text">Pelajar SMKN1 BINONG Kelas 11 PPLG</p>
                  <!-- Form Update Sosial Media untuk Anggota 2 -->
                  <form id="form-sosmed-anggota_2" action="{{ route('sosmed.update.anggota2') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                      <label for="anggota_2-github" class="form-label">GitHub</label>
                      <div class="input-group">
                        <input type="url" class="form-control" name="github" id="anggota_2-github" placeholder="{{ $informasiSosmed2->github ? $informasiSosmed2->github : 'Belum ada data' }}" value="{{ $informasiSosmed2->github ?? '' }}">
                      </div>
                    </div>
                    <div class="mb-2">
                      <label for="anggota_2-instagram" class="form-label">Instagram</label>
                      <div class="input-group">
                        <input type="url" class="form-control" name="instagram" id="anggota_2-instagram" placeholder="{{ $informasiSosmed2->instagram ? $informasiSosmed2->instagram : 'Belum ada data' }}" value="{{ $informasiSosmed2->instagram ?? '' }}">
                      </div>
                    </div>
                    <div class="mb-2">
                      <label for="anggota_2-linkedin" class="form-label">LinkedIn</label>
                      <div class="input-group">
                        <input type="url" class="form-control" name="linkedin" id="anggota_2-linkedin" placeholder="{{ $informasiSosmed2->linkedin ? $informasiSosmed2->linkedin : 'Belum ada data' }}" value="{{ $informasiSosmed2->linkedin ?? '' }}">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-simpan-anggota_2" disabled>Simpan Perubahan</button>
                  </form>
                </div>
              </div>
            </div>

            <!-- Card Team Member: annggota_3 -->
            <div class="col-md-4">
              <div class="card">
                <img src="{{asset('landingpage/assets/img/team/anggota_3.jpg')}}" class="card-img-top" alt="Foto Anggota ke 3">
                <div class="card-body">
                  <h5 class="card-title">Samuel Angello Firmansyah</h5>
                  <p class="card-text">Pelajar SMKN1 BINONG Kelas 11 PPLG</p>
                  <!-- Form Update Sosial Media untuk Anggota 3 -->
                  <form id="form-sosmed-anggota_3" action="{{ route('sosmed.update.anggota3') }}" method="POST">
                    @csrf

                    <div class="mb-2">
                      <label for="anggota_3-github" class="form-label">GitHub</label>
                      <div class="input-group">
                        <input type="url" class="form-control" name="github" id="anggota_3-github" placeholder="{{ $informasiSosmed3->github ? $informasiSosmed3->github : 'Belum ada data' }}" value="{{ $informasiSosmed3->github ?? '' }}">
                      </div>
                    </div>

                    <div class="mb-2">
                      <label for="anggota_3-instagram" class="form-label">Instagram</label>
                      <div class="input-group">
                        <input type="url" class="form-control" name="instagram" id="anggota_3-instagram" placeholder="{{ $informasiSosmed3->instagram ? $informasiSosmed3->instagram : 'Belum ada data' }}" value="{{ $informasiSosmed3->instagram ?? '' }}">
                      </div>
                    </div>

                    <div class="mb-2">
                      <label for="anggota_3-linkedin" class="form-label">LinkedIn</label>
                      <div class="input-group">
                        <input type="url" class="form-control" name="linkedin" id="anggota_3-linkedin" placeholder="{{ $informasiSosmed3->linkedin ? $informasiSosmed3->linkedin : 'Belum ada data' }}" value="{{ $informasiSosmed3->linkedin ?? '' }}">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-simpan-anggota_3" disabled>Simpan Perubahan</button>
                  </form>
                </div>
              </div>
            </div>
          </div><!-- end row team -->
        </div>
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


  <!-- Bootstrap Bundle dengan Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="{{asset ('dashboard/dist/assets/js/bootstrap.js')}}"></script>
  <script src="{{asset ('dashboard/dist/assets/js/app.js')}}"></script>

  <!-- sweeetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- toastr -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- myjs -->
  <script src="{{ asset('dashboard/dist/assets/js/myjs/seturl.js') }}"></script>
  <script src="{{ asset('dashboard/dist/assets/js/myjs/setemail.js') }}"></script>
  <script src="{{ asset('dashboard/dist/assets/js/myjs/setsosmed.js') }}"></script>

  <!-- Confirm -->
  <div id="confirmModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <div class="icon-container">
          <img src="{{ asset('dashboard/dist/assets/images/icons/question.png') }}" alt="">
        </div>
        <div class="text-container">
          <h3>Apakah Anda yakin?</h3>
          <p>Lanjutkan pengiriman data? Pastikan URL yang Anda masukan sudah benar.</p>
        </div>
      </div>

      <div class="modal-footer">
        <button id="confirmYes" class="btn btn-confirm">Lanjutkan</button>
        <button id="confirmNo" class="btn-cancel">Batal</button>
      </div>
    </div>
  </div>
</body>

</html>