<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- toastr css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- mycss -->
    <link rel="stylesheet" href="{{ asset('landingpage/Halamanlogin/css/mycss/resetpass.css') }}">
</head>

<body>
    <!-- Tombol keluar -->
    <a href="#" class="exit-button">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="rgb(223, 102, 102)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M13 12H3"></path>
        </svg>
        Keluar
    </a>

    <!-- Page 1 -->
    <div class="container page active" id="forgot-password">
        <div class="icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="rgb(223, 102, 102)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
            </svg>

        </div>
        <h1>Lupa password?</h1>
        <p class="subtitle">Jangan Khawatir. Kamu dapat mengubah nya dengan mudah.</p>

        <form onsubmit="handleForgotPassword(event)">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Masukan Email Kamu" required>
            </div>
            <button type="submit">Reset password</button>
        </form>

        <a href="{{ route('auth') }}" class="back-link">
            <span class="back-icon">←</span> Kembali ke halaman Login
        </a>
    </div>

    <!-- Page 2 -->
    <div class="container page" id="set-new-password">
        <div class="icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="rgb(223, 102, 102)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
        </div>
        <h1>Atur Password Baru</h1>
        <p class="subtitle" id="reset-email-info">Atur password baru pada email kamu ... .</p>

        <form onsubmit="showPasswordReset(event)">
            <div class="form-group password-group">
                <label for="password">Password</label>
                <div class="input-with-icon">
                    <input type="password" id="password" class="input-password" placeholder="Masukan password baru" required>
                    <i class="bi bi-eye-slash toggle-password" data-target="password"></i>
                </div>
                <small>Harus diisi setidaknya 8 Karakter.</small>
            </div>

            <div class="form-group password-group">
                <label for="confirm-password">Confirm password</label>
                <div class="input-with-icon">
                    <input type="password" id="confirm-password" class="input-password" placeholder="Konfirmasi password" required>
                    <i class="bi bi-eye-slash toggle-password" data-target="confirm-password"></i>
                </div>
            </div>
            <button type="submit">Reset password</button>
        </form>

        <a href="#" class="back-link">
            <span class="back-icon">←</span> Kembali
        </a>
    </div>

    <!-- Page 3 -->
    <div class="container page" id="password-reset">
        <div class="icon success-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="rgb(25, 135, 84)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5"></path>
            </svg>
        </div>
        <h1>Password Berhasil direset</h1>
        <p class="subtitle">Password kamu telah sukses di Atur kembali.<br> Click lanjutkan di Bawah ini untuk kembali ke halaman Login.</p>
        <button id="continue-to-login">Lanjutkan</button>
    </div>

    <!-- toastr -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- myjs -->
    <script src="{{ asset('landingpage/Halamanlogin/js/myjs/resetpass.js') }}"></script>

</body>

</html>