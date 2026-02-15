// ==== Konfigurasi Toastr ====
function showToast(text, type = 'info') {
    const colors = {
        success: '#28a745',
        error: '#dc3545',
        info: '#17a2b8',
        warning: '#ffc107'
    };

    Toastify({
        text,
        duration: 5000,
        close: true,
        gravity: 'top',
        position: 'center',
        stopOnFocus: true,
        style: {
            background: colors[type.toLowerCase()] || '#343a40'
        }
    }).showToast();
}

// ==== Cegah Refresh Jika Form Berubah ====
let formChanged = false;

window.addEventListener('beforeunload', function (e) {
    const currentPage = localStorage.getItem('currentPage');
    if (formChanged && (currentPage === 'forgot-password' || currentPage === 'set-new-password')) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// ==== Fungsi Deteksi Perubahan Input ====
function monitorFormChanges(selector) {
    const inputs = document.querySelectorAll(selector);
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            formChanged = true;
        });
    });
}

function goToPage(page) {
    const pages = ['forgot-password', 'set-new-password', 'password-reset'];
    pages.forEach(p => {
        document.getElementById(p).classList.remove('active');
    });

    document.getElementById(page).classList.add('active');
    localStorage.setItem('currentPage', page);

    // === Tangani tampilan tombol keluar ===
    const exitButton = document.querySelector('.exit-button');
    if (exitButton) {
        if (page === 'password-reset') {
            exitButton.style.display = 'none';
        } else {
            exitButton.style.display = 'flex'; 
        }
    }

    // === Halaman forgot-password ===
    if (page === 'forgot-password') {
        monitorFormChanges('#email');
    }

    // === Halaman set-new-password ===
    if (page === 'set-new-password') {
        monitorFormChanges('#password, #confirm-password');

        const resetEmail = localStorage.getItem('resetEmail');
        const emailInfo = document.getElementById('reset-email-info');
        if (resetEmail && emailInfo) {
            emailInfo.innerHTML = `Atur password baru pada email kamu <strong>${resetEmail}</strong>`;
        }
    }
}


// ==== Inisialisasi Setelah DOM Siap ====
document.addEventListener('DOMContentLoaded', () => {
    const savedPage = localStorage.getItem('currentPage') || 'forgot-password';
    goToPage(savedPage);

    const forgotForm = document.getElementById('form-forgot-password');
    if (forgotForm) {
        forgotForm.addEventListener('submit', handleForgotPassword);
    }

    // Tombol kembali
    const backLinks = document.querySelectorAll('.back-link');
    backLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            if (formChanged) {
                const confirmBack = confirm("Yakin ingin kembali ke Halaman sebelumnya?? Perubahan mungkin tidak akan disimpan dan perlu untuk mengisi ulang formulir");
                if (!confirmBack) return;
                formChanged = false;
            }            

            const currentPage = localStorage.getItem('currentPage');
            if (currentPage === 'set-new-password') {
                goToPage('forgot-password');
            } else if (currentPage === 'password-reset') {
                goToPage('set-new-password');
            } else {
                window.location.href = '/sesi';
            }
        });
    });

    // ==== Tombol keluar ====
    const exitButton = document.querySelector('.exit-button');

    if (exitButton) {
        exitButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Jika ada perubahan, tampilkan konfirmasi
            if (formChanged) {
                const confirmExit = confirm("Yakin ingin keluar dari halaman ini? Perubahan mungkin tidak akan disimpan dan perlu untuk mengisi ulang formulir");
                if (!confirmExit) return;
            }

            localStorage.clear(); // Bersihkan localstorage

            // Redirect ke halaman login atau sesi
            window.location.href = '/sesi';
        });
    }

    // Hapus storage ketika klik tombol "Continue to Login" dan arahkan ke halaman login
    const continueBtn = document.getElementById('continue-to-login');
    if (continueBtn) {
        continueBtn.addEventListener('click', () => {
            localStorage.clear();
            window.location.href = '/sesi'; // ← Arahkan ke halaman login
        });
    }
});

// ==== Fungsi Proses Email Forgot Password ====
function handleForgotPassword(e) {
    e.preventDefault();

    const emailInput = document.getElementById('email');
    const email = emailInput.value.trim();

    if (!email) return showToast('Email tidak boleh kosong.', 'error');

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        return showToast('Masukkan format email dengan benar', 'error');
    }

    fetch('/cek-email-reset-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ email })
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showToast('Email Berhasil Ditemukan. Kamu bisa mengatur ulang passwordmu sekarang!', 'success');
                localStorage.setItem('resetEmail', email);
                formChanged = false;
                goToPage('set-new-password');
            } else {
                showToast('Email tidak dapat ditemukan didalam database kami.', 'error');
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
            showToast('Terjadi kesalahan saat mengirim permintaan', 'error');
        });
}

// ==== Fungsi Update Password Baru ====
async function showPasswordReset(e) {
    e.preventDefault();

    const email = localStorage.getItem('resetEmail');
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirm-password').value.trim();

    if (!password) return showToast("Tolong isi input password", 'error');
    if (password.length < 8) return showToast("Password setidaknya berisi 8 karakter", 'error');
    if (!/\d/.test(password)) return showToast("Password setidaknya memiliki 1 angka", 'error');
    if (confirmPassword !== password) return showToast("Konfirmasi password tidak sama dengan password baru", 'error');

    try {
        const checkRes = await fetch(`/cek-password-lama`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email, password_baru: password })
        });

        const checkData = await checkRes.json();
        if (!checkRes.ok || checkData.same) {
            const msg = checkData.message || (checkData.same ? "Password baru tidak boleh sama dengan password lama" : "Terjadi kesalahan saat memeriksa password lama");
            return showToast(msg, 'error');
        }

        const updateRes = await fetch(`/update-password`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email, password_baru: password })
        });

        const updateData = await updateRes.json();
        if (!updateRes.ok) {
            return showToast(updateData.message || 'Gagal mengupdate password', 'error');
        }

        showToast("Berhasil mengganti password!", 'success');
        formChanged = false;
        setTimeout(() => goToPage('password-reset'), 1000);

    } catch (err) {
        console.error(err);
        showToast("Terjadi kesalahan server", 'error');
    }
}

// ==== Toggle Visibility Password ====
document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', () => {
        const targetId = icon.getAttribute('data-target');
        const input = document.getElementById(targetId);

        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        icon.classList.toggle('bi-eye', isPassword);
        icon.classList.toggle('bi-eye-slash', !isPassword);
    });
});
