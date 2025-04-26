// konfigurasi toastify
const colors = {
    success: '#28a745',
    error: '#dc3545',
    info: '#17a2b8',
    warning: '#ffc107'
};

function showToast(type, text) {
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

// Loading Box
function showLoading() {
    const loadingBox = document.createElement('div');
    loadingBox.id = 'loadingBox';
    loadingBox.style.position = 'fixed';
    loadingBox.style.top = '50%';
    loadingBox.style.left = '50%';
    loadingBox.style.transform = 'translate(-50%, -50%)';
    loadingBox.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    loadingBox.style.color = 'white';
    loadingBox.style.padding = '20px';
    loadingBox.style.borderRadius = '5px';
    loadingBox.style.zIndex = '9999';
    loadingBox.style.display = 'flex';
    loadingBox.style.alignItems = 'center';
    loadingBox.style.gap = '15px';

    const spinner = document.createElement('div');
    spinner.style.width = '40px';
    spinner.style.height = '40px';
    spinner.style.border = '3px solid rgba(255, 255, 255, 0.3)';
    spinner.style.borderTop = '3px solid white';
    spinner.style.borderRadius = '50%';
    spinner.style.animation = 'spin 1s linear infinite';

    const text = document.createElement('div');
    text.textContent = 'Mengirim data...';

    loadingBox.appendChild(spinner);
    loadingBox.appendChild(text);
    document.body.appendChild(loadingBox);
}

function hideLoading() {
    const loadingBox = document.getElementById('loadingBox');
    if (loadingBox) loadingBox.remove();
}

// Logika input kelas
const select = document.getElementById('kelas');

const jurusanMap = {
    X: ['RPL', 'TBSM 1', 'TBSM 2', 'AKL', 'MPLB', 'ATPH', 'TEI'],
    XI: ['RPL', 'TBSM 1', 'TBSM 2', 'AKL', 'MPLB', 'ATPH', 'TEI'],
    XII: ['RPL', 'TBSM 1', 'TBSM 2', 'AKL', 'MPLB', 'ATPH', 'TEI']
};

let selectedKelas = null;

function tampilkanKelasAwal() {
    select.innerHTML = `
        <option value="" disabled selected>Pilih Kelas</option>
        <option value="X">X</option>
        <option value="XI">XI</option>
        <option value="XII">XII</option>
    `;
}

select.addEventListener('change', function () {
    const value = this.value;

    if (value === '__back__') {
        // Kembali ke daftar kelas awal
        tampilkanKelasAwal();
        selectedKelas = null;
        return;
    }

    if (['X', 'XI', 'XII'].includes(value)) {
        selectedKelas = value;

        // Ubah ke daftar jurusan
        select.innerHTML = `
            <option value="__back__" class="back-option">⟵ Kembali memilih kelas</option>
            <option value="" disabled selected>Pilih jurusan untuk kelas ${value}</option>
        `;
        jurusanMap[value].forEach(jurusan => {
            const option = document.createElement('option');
            option.value = `${value} ${jurusan}`;
            option.textContent = `${value} - ${jurusan}`;
            select.appendChild(option);
        });
    }
});

// Logika toggle password untuk menampilkan teks input type password
document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', () => {
        const targetInput = document.getElementById(icon.getAttribute('data-target'));
        const isPassword = targetInput.type === 'password';

        targetInput.type = isPassword ? 'text' : 'password';
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });
});

// Logika disabled button


// Submit tambah anggota
document.querySelector('#add-member-form form').addEventListener('submit', async function (e) {
    e.preventDefault(); // tahan submit

    const form = e.target;
    const formData = new FormData(form);

    // Ambil nilai dari form
    const nama = formData.get('namalengkap')?.trim();
    const username = formData.get('username')?.trim();
    const email = formData.get('email')?.trim();
    const kelas = formData.get('kelas');
    const password = formData.get('password');
    const confirmPassword = formData.get('confirm_password');
    const gambar = document.getElementById("gambar").files[0];

    // --- Validasi Frontend Satu per Satu ---
    // Nama Lengkap
    if (!nama) {
        showToast("error", "Nama lengkap wajib diisi.");
        return;
    }

    if (nama.length < 5) {
        showToast("error", "Nama lengkap minimal 5 karakter.");
        return;
    }

    if (nama.length > 50) {
        showToast("error", "Nama lengkap maksimal 50 karakter.");
        return;
    }


    // Username
    if (!username) {
        showToast("error", "Username wajib diisi.");
        return;
    }

    if (username.length < 5) {
        showToast("error", "Username minimal 5 karakter.");
        return;
    }
    if (username.length > 18) {
        showToast("error", "Username maksimal 18 karakter.");
        return;
    }

    // Email
    if (!email) {
        showToast("error", "Email wajib diisi.");
        return;
    }
    const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    if (!gmailRegex.test(email)) {
        showToast("error", "Email harus menggunakan format @gmail.com.");
        return;
    }

    // Kelas
    if (!kelas) {
        showToast("error", "Pilih kelas terlebih dahulu.");
        return;
    }

    // Password
    if (!password) {
        showToast("error", "Password wajib diisi.");
        return;
    }
    if (password.length < 8) {
        showToast("error", "Password minimal 8 karakter.");
        return;
    }
    if (!/\d/.test(password)) {
        showToast("error", "Password harus mengandung angka.");
        return;
    }

    // Konfirmasi Password
    if (confirmPassword !== password) {
        showToast("error", "Konfirmasi password! Harus sama dengan password yg kamu atur");
        return;
    }

    // Gambar
    if (!gambar) {
        showToast("error", "Wajib mengunggah gambar.");
        return;
    }
    const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!validTypes.includes(gambar.type)) {
        showToast("error", "Gambar harus berformat JPG, JPEG, atau PNG.");
        return;
    }
    const maxSize = 2 * 1024 * 1024;
    if (gambar.size > maxSize) {
        showToast("error", "Ukuran gambar maksimal 2MB.");
        return;
    }

    // Konfirmasi sebelum submit
    const confirmResult = await Swal.fire({
        title: 'Tambah Anggota?',
        text: 'Yakin ingin menambahkan anggota ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Tambah!',
        cancelButtonText: 'Batal'
    });

    if (!confirmResult.isConfirmed) return;

    // 1. Cek email dulu sebelum submit
    const emailCheckUrl = `${window.location.origin}/admin/tambah-anggota/cek-email`;
    const baseUrl = window.location.origin;
    const tambahAnggotaUrl = `${baseUrl}/admin/tambah-anggota`;

    try {
        showLoading(); // TAMPILKAN LOADING

        const emailResponse = await fetch(emailCheckUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email })
        });

        const emailData = await emailResponse.json();

        if (emailData.exists) {
            hideLoading(); // SEMBUNYIKAN LOADING sebelum keluar
            showToast('error', 'Email sudah terdaftar. Gunakan email lain.');
            return;
        }

        const response = await fetch(tambahAnggotaUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const data = await response.json();

        hideLoading(); // SEMBUNYIKAN LOADING sebelum lanjut ke hasil

        if (response.ok && data.success) {
            await Swal.fire({
                title: 'Berhasil!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'Oke'
            });
            location.reload(); // <-- reload halaman untuk update tabel & card
        }
         else if (data.errors) {
            Object.values(data.errors).forEach(error => {
                showToast('error', error[0]);
            });
        } else {
            await Swal.fire({
                title: 'Gagal!',
                text: data.error || 'Gagal menambahkan anggota.',
                icon: 'error',
                confirmButtonText: 'Tutup'
            });
        }
    } catch (err) {
        hideLoading(); // PASTIKAN loading tetap disembunyikan kalau error
        showToast('error', 'Terjadi kesalahan jaringan.');
    }

});

