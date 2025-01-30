<?php
// Menetapkan informasi halaman
$title = "Homepage";
$schoolName = "SMKN 1 BINONG";
$logo = "logosmk.png";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logocon">
            <img src="<?php echo $logo; ?>" alt="LogoSekolah" class="logo">
            <h3><?php echo $schoolName; ?></h3>
        </div>
        <h1>Beranda Tabungan Sekolah</h1>
    </header>

    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="Profil/registrasiprofil.php">Profil</a></li>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="Kelas/kelas.php">Kelas</a></li>
                <li><a href="#">Siswa</a></li>
                <li><a href="#">Riwayat</a></li>
                <li><a href="#">Keluar</a></li>
            </ul>
        </div>
        
        <div class="content">
            <h1>Kenapa Harus Menabung?</h1>
            <h2>Website ini dapat memberi informasi tentang Tabungan siswa yang dapat dilihat oleh Orang Tua siswa dan guru - guru</h2>
            <p>Menabung adalah langkah penting untuk mempersiapkan masa depan yang lebih baik. Dengan menabung, kita bisa memiliki cadangan dana untuk kebutuhan darurat, biaya pendidikan, atau mewujudkan impian tertentu.</p>
            <h1>Pentingnya disiplin dalam menabung!!</h1>
            <p>Disiplin dalam menabung dapat membantu membangun kebiasaan finansial secara rutin, seperti kita dapat menghindari pemborosan dan memastikan stabilitas keuangan.</p>
            <h1>Meraih Tujuan Keuangan</h1>
            <p>Menetapkan tujuan keuangan yang jelas memudahkan kita untuk tetap termotivasi dalam menabung, baik membeli rumah, memulai bisnis, atau liburan yang diimpikan, semua dapat dicapai dengan perencanaan dan konsistensi.</p>
        </div>
    </div>
</body>
</html>
