<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Isi Saldo</title>
  <link rel="stylesheet" href="{{asset('dashboard/dist/transaksi/assets/csstransaksi/tambahsaldo.css')}}">
</head>
<body>
  <div class="container">
    <header class="header">
      <a href="{{route('user')}}"><button class="back-btn">&#8592;</button></a>
      <h1>Isi Saldo</h1>
    </header>

    <section class="info-section">
      <h2>Informasi</h2>
      <p>
        Pengisian saldo ini hanya dapat dibayarkan <strong>SECARA TUNAI!</strong>. 
        Mohon lakukan pembayaran kepada staff / Kepada guru yang ditugaskan
      </p>
    </section>
      <p class="contact-info">
        Jika Anda memiliki pertanyaan, silakan hubungi staff kami ditempat atau melalui <a href="../kontak-kami.html"><strong>tautan ini</strong></a> .
      </p>
    
    <main class="main-content">
      <section id="virtual-account" class="tab-content">
        <h2>Pilih Nominal</h2>
        <div class="nominal-options">
          <div class="nominal-card" tabindex="0">
            <span class="amount">100.000</span> 
            <p>Harga</p>
            <span class="price">Rp100.000</span>
          </div>
          <div class="nominal-card" tabindex="0">
            <span class="amount">250.000</span> 
            <p>Harga</p>
            <span class="price">Rp250.000</span>
          </div>
          <div class="nominal-card" tabindex="0">
            <span class="amount">500.000</span> 
            <p>Harga</p>
            <span class="price">Rp500.000</span>
          </div>
          <div class="nominal-card" tabindex="0">
            <span class="amount">1.000.000</span> 
            <p>Harga</p>
            <span class="price">Rp1.000.000</span>
          </div>
        </div>
        <div class="divider">atau</div>
        <div class="custom-nominal">
          <label for="customAmount">
            <p>Isi Nominal Sendiri</p>
          </label>
          <div class="input-wrapper">
            <span>Rp</span>
            <input type="text" id="customAmount" class="customAmount" placeholder="0" style="font-size: 17px;">
          </div>
          <p class="min-info">Minimal pengisian saldo adalah sebesar Rp10.000.</p>
        </div>
      </section>

      <section id="minimarket" class="tab-content" style="display: none;">
        <h2>Bayar di Minimarket</h2>
        <p>Panduan untuk melakukan pembayaran di minimarket akan ditampilkan di sini.</p>
      </section>
    </main>

    <footer class="footer">
      <button class="pay-btn">Bayar Sekarang</button>
      <div id="loading-indicator" style="display: none;">Sedang memproses...</div>
    </footer>
  </div>
  <script src="{{asset('dashboard/dist/transaksi/assets/jstransaksi/tambah_saldo.js')}}"></script>
</body>
</html>