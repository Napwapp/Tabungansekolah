<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menabung</title>
  <link rel="stylesheet" href="{{asset('dashboard/dist/transaksi/assets/csstransaksi/penarikan.css')}}">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header-balance-container">
            <div class="header-container">
                <!-- Tombol Kembali -->
                <a href="{{route('user')}}"><button class="back-button">&#8592;</button></a>
                <div class="header-title">Tarik Tabunganmu</div>
            </div>
            
            <!-- Kontainer Saldo -->
            <div class="balance-container">
                <div>
                  <div class="balance-info">Tabungan yang dapat ditarik</div>
                  <div class="balance-amount">-</div>
                </div>
                <button class="button-tabung-semua">Tarik Semua</button>
            </div>
            <p class="note">Kamu bebas untuk menarik berapapun dari Tabunganmu tanpa ada batasan</p>

        </div>
        
        <div class="parent-container">
            <!-- Formulir Menabung -->
            <div class="deposit-section">
              <p class="section-title">Uang yang ingin ditarik</p> <!-- Tambahan teks baru -->
              <!-- Container untuk teks dan ikon -->
              <div class="info-text-container">
                <!-- Ikon Informasi -->
                <svg
                  data-v-2470b354=""
                  width="24"
                  height="24"
                  class="info-icon"
                  aria-hidden="true"
                  type="image/svg+xml"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12ZM11.97 8.73764C12.7266 8.73764 13.34 8.1248 13.34 7.36882C13.34 6.61284 12.7266 6 11.97 6C11.2134 6 10.6 6.61284 10.6 7.36882C10.6 8.1248 11.2134 8.73764 11.97 8.73764ZM11.4999 10.1064H12.4499C12.8499 10.1064 13.1799 10.4362 13.1799 10.8358V17.2703C13.1799 17.6699 12.8499 17.9996 12.4499 17.9996H11.4999C11.0999 17.9996 10.7699 17.6699 10.7699 17.2703V10.8358C10.7699 10.4362 11.0999 10.1064 11.4999 10.1064Z"
                  ></path>
                </svg>
                <!-- Teks Informasi -->
                <p class="info-text">
                    Jika sudah selesai mengajukan penarikan,Silahkan datangi staff di <strong>'Ruang guru rpl'</strong> atau bisa datangi <strong>'AKL'</strong> untuk mengambil uangnya. Disana, diharapkan agar menunjukan bukti Penarikannya kepada Staff
                </p>
              </div>
            </div>
          
            <form class="deposit-form">
              <div class="input-wrapper">
                <span class="input-label">Rp</span>
                <input id="amount" type="text" placeholder="Jumlah Tabungan yang akan ditarik">
                <!-- <div class="input-buttons">
                    <button id="decrease-amount">-</button>
                    <button id="increase-amount">+</button>
                </div> -->
              </div>
            </form>
          
            <!-- Pembungkus tombol -->
            <div class="button-wrapper">
              <button class="deposit-button">Ajukan penarikan</button>
            </div>
        </div>          
  </div>
  <script src="{{asset('dashboard/dist/transaksi/assets/jstransaksi/penarikan.js')}}"></script>
</body>
</html>
