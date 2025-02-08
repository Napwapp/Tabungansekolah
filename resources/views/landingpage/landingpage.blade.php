<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabungan SMKN1 BINONG</title>
    <link rel="stylesheet" href="{{ asset('landingpage/csslandingpage/style.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/csslandingpage/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/csslandingpage/default.css') }}">
</head>
<body>
<script src="{{ asset('landingpage/script.js') }}"></script>
<div class="container">
    <header>
        <section id="header" class="header">
            <div class="logosmk">
                <img src="{{ asset('landingpage/img/smkn1_binong.png') }}" alt="Logo SMK Negeri 1 Binong Subang">
                <h1>SMK NEGERI 1 <br> BINONG SUBANG</h1>
            </div>
            <div class="navigasi">
                <a href="#beranda" aria-label="Beranda">Beranda</a>
                <a href="#tentangkami" aria-label="Tentang Kami">Tentang Kami</a>
                <a href="#pengisi" aria-label="Panduan Pengguna">Panduan Pengguna</a>
                <a href="#carakerja" aria-label="Cara Kerja">Cara Kerja</a>
                <a href="#kontak" aria-label="Kontak">Kontak</a>
                <a href="{{ route('auth')}}" class="login-button" aria-label="Login">LOGIN</a>
            </div>
        </section>  
    </header>
    
    <!-- Beranda -->
    <section id="beranda" class="beranda"> 
            <div class="foto">
                <img src="{{ asset('landingpage/img/orang menabung.jpeg') }}" alt="orangmenabung">
                <span class="text-foto scroll-element">
                    <h1>MENGAPA HARUS MENABUNG</h1>
                </span>
            </div>
            <div class="main"> 
                <img src="{{ asset ('landingpage/bg/gradient background.png') }}" alt="gradidentbg">
                <div class="red-section scroll-element">                    
                    <p>Menabung adalah langkah penting untuk mempersiapkan masa depan yang lebih baik. Dengan menabung, kita bisa memiliki cadangan dana untuk kebutuhan darurat, biaya pendidikan, atau mewujudkan impian tertentu.</p>
                    <br>
                    <h3>Pentingnya Disiplin dalam Menabung</h3>
                    <p>Disiplin menabung membantu membangun kebiasaan finansial yang sehat. Dengan menyisihkan sebagian dari pendapatan secara rutin, kita dapat menghindari pemborosan dan memastikan stabilitas keuangan.</p>
                    <br>
                    <h3>Meraih Tujuan Keuangan</h3>
                    <p>Menetapkan tujuan keuangan yang jelas memudahkan kita untuk tetap termotivasi dalam menabung. Baik untuk membeli rumah, memulai bisnis, atau liburan impian, semua dapat dicapai dengan perencanaan dan konsistensi.</p>
                    <div class="button-container">                
                        <a href="{{ route('auth') }}" class="btn">           
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg> 
                        Mulailah Menabung</a>
                    </div>
                </div>
            </div>
    </section>

    <!-- mengapa kamu harus menabung --> 
     <div class="pengisi"></div>
        <section class="alasan-menabung">
        <div class="alasanmenabung scroll-element">
            <h1>mengapa harus menabung?</h1>
        </div>
    </section>

    <section id="foto-container" class="foto-container scroll-element">
        <div class="foto1 scroll-element">
            <img src="{{ asset('landingpage/img/wallet.png') }}" alt="alasanmenabung1">
            <div class="caption scroll-element">Menabung memungkinkan kita memiliki keuangan yang terorganisir dan siap digunakan kapan saja.</div>
        </div>
        <div class="foto2">
            <img src="{{ asset('landingpage/img/salary.png') }}" alt="alasanmenabung2">
            <div class="caption scroll-element">Menabung membantu kita mengumpulkan dana cadangan untuk kebutuhan mendesak di masa depan.</div>
        </div>
        <div class="foto3">
            <img src="{{ asset('landingpage/img/jar.png') }}" alt="alasanmenabung3">
            <div class="caption scroll-element">Menabung adalah langkah kecil yang konsisten untuk mencapai tujuan keuangan yang lebih besar.
            </div>
        </div>
        <div class="foto4 scroll-element">
            <img src="{{ asset('landingpage/img/inflasion.png') }}" alt="alasanmenabung4">
            <div class="caption scroll-element">Inflasi menurunkan daya beli, sehingga menabung & investasi penting untuk menjaga nilai uang.</div>
        </div>
    </section>

    <!-- Tentang kami -->
     <div class="pengisi"></div>
     <section id="tentangkami" class="tentangkami">
        <div class="tentang-kami scroll-element">
            <h1>Tentang Kami</h1>
            <a href="https://smkn1binong.sch.id/"><img src="{{ asset('landingpage/img/smkn1_binong.png') }}" alt="smkn1_binong"></a>
        </div>
        <div class="isitentangkami scroll-element">
            <img class="bgslogan scroll-element" src="{{ asset('landingpage/bg/gradient background.png')}}" alt="bgslogan">
            <img class="slogan scroll-element" src="{{ asset('landingpage/img/slogan smk.png') }}" alt="slogan">
        </div>
            <p class="sejarahsmk scroll-element">SEJARAH BERDIRINYA SMKN1 BINONG SUBANG</p>
            
        <div class="sejarah scroll-element">            
            <div class="fotosejarah scroll-element">
                <img src="{{ asset('landingpage/img/dokumentasi smk2.jpg') }}" alt="fotosejarah">
            </div>
            <div class="fotosejarah2 scroll-element">
                <img src="{{ asset('landingpage/img/dokumentasi smk.png') }}" alt="fotosejarah2">
            </div>
            <p class="isisejarah">Sejarah SMK Negeri 1 Binong

                SMK Negeri 1 Binong, yang terletak di Jalan Raya Binong No. 64, Kabupaten Subang, Jawa Barat, adalah salah satu lembaga pendidikan vokasi yang berperan penting dalam mencetak tenaga kerja terampil di wilayah Subang dan sekitarnya. <br> <br> Sekolah ini resmi berdiri pada tanggal 23 Desember 2013, berdasarkan Surat Keputusan Pendirian Nomor 421/Kep.534-Org/2013.
                
                Pendirian SMK Negeri 1 Binong merupakan bagian dari upaya pemerintah untuk meningkatkan kualitas pendidikan kejuruan di Indonesia, khususnya di bidang-bidang yang berorientasi pada dunia kerja dan kebutuhan industri. Sebagai sekolah kejuruan negeri, SMK Negeri 1 Binong diharapkan menjadi pelopor pendidikan vokasi yang unggul, inovatif, dan relevan dengan perkembangan zaman.
                <br>
                <br>

                Prestasi dan Komitmen Sekolah
                Seiring waktu, SMK Negeri 1 Binong berhasil mendapatkan akreditasi A dari Badan Akreditasi Nasional Sekolah/Madrasah (BAN-SM). Hal ini menunjukkan pengakuan terhadap kualitas pendidikan yang diberikan. Selain itu, sekolah ini telah banyak melahirkan lulusan yang siap kerja dan berdaya saing tinggi di pasar tenaga kerja.
                <br> <br> 
                
                 <br>Perkembangan Program Studi
                Sejak awal berdiri, SMK Negeri 1 Binong menawarkan beberapa program keahlian yang dirancang untuk memenuhi kebutuhan dunia kerja. Program-program tersebut antara lain:
                <br> 
                <br>
                <br>
                
                1.Teknik dan Bisnis Sepeda Motor (TBSM) 
                <br> <br>
                2.Pengembangan Perangkat Lunak & Gim (PPlG) 
                <br> <br>
                3.Akuntansi dan Keuangan Lembaga (AKL) 
                <br> <br>
                4.Manajemen Perkantoran Lembaga Bisnis (MPLB)  
                <br> <br>
                5.Agribisnis Tanaman Pangan dan Hortikultura (ATPH) 
                <br> <br>
                6.Teknik Elektronika Industri (TEI)            
                <br> <br>
                
                Pelantikan taruna dan taruni SMK Negeri 1 Binong menjadi tradisi tahunan yang penting. Pada 26 September 2024, sekolah melantik ratusan taruna dan taruni angkatan ke-10, menandai perjalanan satu dekade sekolah dalam mencetak tenaga kerja yang kompeten.
                <br> <br>
                Komitmen terhadap Pendidikan Industri 4.0
                Dalam menghadapi tantangan era industri 4.0, SMK Negeri 1 Binong terus berinovasi dengan memperbarui kurikulum, meningkatkan fasilitas, dan menjalin kerja sama dengan dunia usaha dan dunia industri (DUDI). Fasilitas modern seperti laboratorium komputer, bengkel sepeda motor, dan rumah kaca untuk agribisnis telah dibangun untuk menunjang kegiatan belajar-mengajar.
                <br> <br>
                Sekolah ini juga aktif mengadakan program magang industri bagi siswa-siswanya, sehingga mereka dapat merasakan langsung pengalaman kerja di lapangan. Selain itu, berbagai pelatihan dan seminar diberikan kepada siswa untuk meningkatkan soft skill dan hard skill mereka.
                <br> <br>
                Masa Depan SMK Negeri 1 Binong
                Dengan semangat "Siap Kerja, Santun, Mandiri, Kreatif," SMK Negeri 1 Binong terus berkomitmen menjadi lembaga pendidikan kejuruan yang unggul dan berkontribusi pada pembangunan bangsa. Melalui penguatan budaya kerja, inovasi, dan integritas, SMK Negeri 1 Binong berharap dapat menjadi pilihan utama bagi siswa yang ingin meniti karier di dunia profesional.
                </p>
            
            <div class="clear"></div>
            <div id="pengisi" class="pengisi"></div>
        </div>
     </section>

     <!-- panduan pengguna -->
    <section id="panduanpengguna" class="panduanpengguna scroll-element">
        <h1 class="judul scroll-element">Bagaimana Sih Menggunakan Website Ini??</h1>
        
        <div class="gambar scroll-element">
            <img class="emotmikir scroll-element" src="{{ asset('landingpage/icons/icon berfikir.png') }}" alt="emotmikir">
            <img class="orangbingung scroll-element" src="{{ asset('landingpage/icons/shrugging.png') }}" alt="orangbingung">
            <img class="tandatanya scroll-element" src="{{ asset('landingpage/icons/tanda tanya.png') }}" alt="tandatanya">
            <img class="tandatanya2 scroll-element" src="{{ asset('landingpage/icons/tanda tanya.png') }}" alt="tandatanya2">
            <svg class="shapes scroll-element" xmlns="{{ asset('landingpage/http://www.w3.org/2000/svg') }}" viewBox="0 0 1440 320"><path fill="#ff0000" fill-opacity="1" d="M0,128L48,112C96,96,192,64,288,80C384,96,480,160,576,176C672,192,768,160,864,154.7C960,149,1056,171,1152,176C1248,181,1344,171,1392,165.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">   
            </path></svg>
        </div>
            
        <!-- panduan (cara kerja) -->
        <div id="carakerja" class="panduan scroll-element">
            <div class="judulpanduan scroll-element">
                <h1 class="panduan1 scroll-element">Bagaimana saya bisa menabung di tabungan StarBank? </h1>
            </div>

            <!-- judul nomer1 -->
             <div class="nomer1 scroll-element">
                <h1>1. Proses membuka website Tabungan StarBank</h1>
            </div>
            <!-- isi nomer1 -->
            <div class="isipanduan scroll-element">
                <div class="isi1 scroll-element">
                    <h1 class="content scroll-element">Registrasi & masukan data diri</h1>
                </div>
                <img class="tandapanah scroll-element" src="{{ asset('landingpage/icons/tanda panah.png') }}" alt="tandapanah">

                <div class="isi2 scroll-element">
                    <h1 class="content scroll-element">Login ke Akun yg telah anda buat</h1>
                </div>
                <img class="tandapanah scroll-element" src="{{ asset('landingpage/icons/tanda panah.png') }}" alt="tandapanah">

                <div class="isi3 scroll-element">
                    <h1 class="content scroll-element">Dan anda telah berhasil masuk</h1>
                </div>
            </div>
        </div>

        <!-- isi panduan2 -->       
        <div class="panduan2 scroll-element">
            <div class="judulpanduan2 scroll-element">
                <h1 class="judul2 scroll-element">Apa saja yg bisa dilakukan Di Website ini ??</h1>
            </div>
            <div class="pembungkus scroll-element">
                <div class="item scroll-element">
                    <div class="nomer scroll-element">
                        <h1 class="no1 scroll-element">1</h1>
                    </div>
                    <div class="konten scroll-element">
                        <h1>PASTINYA KAMU DAPAT MENABUNG, SECARA CASH</h1>
                        <div class="isikonten1 scroll-element">
                            <img src="{{ asset('landingpage/img/menabung uang digital.png') }}" alt="menabunguang">
                        </div>
                    </div>
                </div>

                <div class="item scroll-element">
                    <div class="nomer scroll-element">
                        <h1 class="no2 scroll-element">2</h1>
                    </div>
                    <div class="konten scroll-element">
                        <h1>KAMU DAPAT MENARIK TABUNGANMU</h1>
                        <div class="isikonten2 scroll-element">
                            <img src="{{ asset('landingpage/img/menarik uang.png') }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="item scroll-element">
                    <div class="nomer scroll-element">
                        <h1 class="no3 scroll-element">3</h1>
                    </div>

                    <div class="konten scroll-element">
                        <h1>DAN KAMU DAPAT MELIHAT RIWAYAT TRANSAKSIMU</h1>
                        <div class="isikonten3 scroll-element">
                            <img src="{{ asset('landingpage/img/riwayat transaksi.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
      <!-- kontak -->       
      <section id="kontak" class="kontak-section scroll-element">
        <div class="judul scroll-element">Menemukan Masalah ?</div>
        <div class="kontak-container scroll-element">
            <h2 class="kontak-title scroll-element">Hubungi Kami</h2>
            <p class="kontak-description scroll-element">Jika Anda memiliki pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi kami melalui form di bawah ini.</p>
            
            <form class="kontak-form scroll-element" action="#" method="POST">
                <div class="form-group scroll-element">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="form-group scroll-element">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                </div>

                <div class="form-group scroll-element">
                    <label for="message">Pesan</label>
                    <textarea id="message" name="message" rows="5" placeholder="Tulis pesan Anda di sini" required></textarea>
                </div>

                <button type="submit" class="submit-button scroll-element">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <!-- footer -->

    <footer>
        <section id="footer" class="footer">
                <div class="footer-container">
                    <div class="footercontent scroll-element">
                        <div class="content1">
                            <h2>About us</h2>
                            <div class="description">
                                <p>Kami merupakan pelajar dari SMKN1 BINONG</p>
                                <h2>Telepon : 081234567890</h2>
                                <h2>Nomor ID : 1234567891011</h2>
                            </div>
                        </div>
                        <div class="content2">
                            <h2>Menu</h2>
                            <ul>
                                <li><a href="#beranda">Home</a></li>
                                <br>
                                <li><a href="#tentangkami">About us</a></li>
                                <br>
                                <li><a href="#kontak">Contact</a></li>

                            </ul>
                        </div>

                        <div class="bag-socialmedia">
                            <h2>Ikuti Kami</h2>
                            <a href="#"><img src="{{ asset('landingpage/icons/facebook.png') }}" alt="facebook"></a> <!-- facebook -->
                            <a href="#"><img src="{{ asset('landingpage/icons/instagram.png') }}" alt="instagram"></a> <!-- instagram -->
                            <a href="#"><img src="{{ asset('landingpage/icons/twitter.png') }}" alt="twitter"></a> <!-- twit -->
                        </div>
                        
                        <div class="bag-school">
                            <h1>SMKN1 BINONG</h1>
                            <img src="{{ asset('landingpage/img/smkn1_binong.png') }}" alt="school">
                        </div>
                        <!-- konten dibawah garis -->

                        <div class="line"></div>
                        <div class="copyright">
                            <h2>2025 © Copyright SMKN1 BINONG.</h2>
                            <h2 class="inright">All Rights Deserved</h2>
                        </div>                        
                    </div>

                    
                </div>
        </section>
    </footer>
</div>
</body>
</html>