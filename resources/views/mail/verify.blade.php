<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun anda</title>
</head>
<body>
    <p>
        Halo <b>{{ $details ['name']}}</b> !
    </p>
    <br>
    <p>
        Berikut Ini Adalah Data anda :
    </p>

    <table>
        <tr>
            <td>Nama lengkap</td>
            <td>:</td>
            <td> {{ $details['nama']}} </td>
        </tr>
        <tr>
            <td>Role</td>
            <td>:</td>
            <td> {{ $details['role']}} </td>
        </tr>
        <tr>
            <td>Website</td>
            <td>:</td>
            <td> {{ $details['website']}} </td>
        </tr>
        <tr>
            <td>Tanggal Register</td>
            <td>:</td>
            <td> {{ $details['datetime']}} </td>
        </tr>
        <br><br><br>

        <center>
            <h3>Klik dibawah ini untuk Verifikasi Akun : </h3>
            <a href="{{ $details['url']}}" style="text-decoration: none; color: white; padding: 9px; background-color: blue; font: bold; border-radius: 20%;"> Verifikasi </a>
            <br><br><br>
            <p>
                Copyright @ 2025 | M.Nawaf Abduh
            </p>
        </center>
    </table>
</body>
</html>