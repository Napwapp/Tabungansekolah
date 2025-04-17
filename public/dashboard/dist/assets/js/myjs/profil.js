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

const btnEdit = document.getElementById('edit-profile-btn');
const btnSimpan = document.getElementById('btn-simpan-edit');
const btnBatal = document.getElementById('btn-batal-edit');

const profileSection = document.querySelector('.profile-section'); // Simpan HTML awal dari profile-section (tampilan span yang dirender Blade)
const originalHTML = profileSection.innerHTML;

const namaLengkapDisplay = document.querySelector('.profile-basic-info h1'); // Simpan referensi info utama yang juga perlu diupdate setelah simpan
const emailDisplay = document.querySelector('.profile-basic-info p');

// Simpan data awal untuk pembatalan
let originalData = {};
function enterEditMode() {
    const values = document.querySelectorAll('.profile-value');
    btnSimpan.disabled = true;
    btnSimpan.style.display = 'inline-block';
    btnBatal.style.display = 'inline-block';
    btnEdit.style.display = 'none';

    originalData = {};

    values.forEach(span => {
        const key = span.dataset.key;
        const value = span.textContent.trim();
        originalData[key] = value;

        const input = document.createElement('input');
        input.className = 'profile-value form-control';
        input.name = key;
        input.value = value;
        input.dataset.key = key;
        input.defaultValue = value;

        // Validasi HTML
        if (key === 'namalengkap') {
            input.required = true;
            input.minLength = 5;
            input.maxLength = 50;
        }
        if (key === 'username') {
            input.required = true;
            input.minLength = 5;
            input.maxLength = 18;
        }
        if (key === 'email') {
            input.required = true;
            input.type = 'email';
        }
        if (key === 'kelas') {
            input.required = true;
        }
        if (key === 'id_tabungan' || key === 'created_at') {
            input.disabled = true;
            input.style.color = '#888';
        }

        // Deteksi perubahan
        input.addEventListener('input', () => {
            const isChanged = [...document.querySelectorAll('.profile-value.form-control')]
                .some(inp => inp.value !== inp.defaultValue);
            btnSimpan.disabled = !isChanged;
        });

        span.replaceWith(input);
    });
}

function cancelEditMode() {
    const inputs = document.querySelectorAll('.profile-value.form-control');
    btnSimpan.style.display = 'none';
    btnBatal.style.display = 'none';
    btnEdit.style.display = 'inline-block';

    inputs.forEach(input => {
        const key = input.name;
        const span = document.createElement('span');
        span.className = 'profile-value';
        span.dataset.key = key;
        span.textContent = originalData[key] || '';
        input.replaceWith(span);
    });
}

btnEdit.addEventListener('click', () => {
    enterEditMode();
});


btnSimpan.addEventListener('click', function (e) {
    e.preventDefault();

    const inputs = document.querySelectorAll('.profile-value.form-control');
    let data = {};
    let errorMessages = [];

    inputs.forEach(input => {
        const key = input.name;
        const value = input.value.trim();
        data[key] = value;

        if (key === 'namalengkap' && (value.length < 5 || value.length > 50)) {
            errorMessages.push('Nama lengkap harus antara 5–50 karakter.');
        }

        if (key === 'username' && (value.length < 5 || value.length > 18)) {
            errorMessages.push('Username harus antara 5–18 karakter.');
        }

        if (key === 'email') {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            if (!emailPattern.test(value)) {
                errorMessages.push('Masukan format email yang valid');
            }
        }

        if (key === 'kelas' && value === '') {
            errorMessages.push('Kelas wajib diisi.');
        }
    });

    if (errorMessages.length > 0) {
        errorMessages.forEach(msg => showToast('error', msg));
        return;
    }

    // Cek apakah email berubah
    if (data.email !== originalData.email) {
        // Kirim request POST untuk pengecekan email
        fetch('/cek-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ambil csrf token
            },
            body: JSON.stringify({ email: data.email }) // Kirim email yang baru
        })
            .then(response => response.json())
            .then(result => {
                if (result.exists) {
                    showToast('error', 'Email sudah digunakan oleh pengguna lain.');
                } else {
                    // Email tidak ada, lanjutkan dengan submit profil
                    submitProfil(data);
                }
            })
            .catch(() => showToast('error', 'Terjadi kesalahan saat validasi email.'));
    } else {
        // Email tidak berubah, lanjutkan dengan submit profil
        submitProfil(data);
    }

});

// Fungsi untuk submit data
function submitProfil(data) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/profil/user/edit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(data)
    })
        .then(res => res.json())
        .then(resData => {
            if (resData.success) {
                showToast('success', 'Profil berhasil diperbarui!');

                // Ganti kembali ke elemen span
                const formElements = document.querySelectorAll('.profile-value.form-control');
                formElements.forEach(input => {
                    const span = document.createElement('span');
                    span.className = 'profile-value';
                    span.dataset.key = input.name;
                    span.innerText = input.value;
                    input.replaceWith(span);
                });

                // Update tampilan luar
                if (data.namalengkap && namaLengkapDisplay) {
                    namaLengkapDisplay.textContent = data.namalengkap;
                }
                if (data.email && emailDisplay) {
                    emailDisplay.textContent = data.email;
                }

                btnSimpan.style.display = 'none';
                btnBatal.style.display = 'none';
                btnEdit.style.display = 'inline-block';
            } else {
                for (const key in resData.errors) {
                    resData.errors[key].forEach(msg => showToast('error', msg));
                }
            }
        })
        .catch(() => showToast('error', 'Terjadi kesalahan. Silakan coba lagi.'));
}

// Tombol Batal
btnBatal.addEventListener('click', (e) => {
    e.preventDefault();
    cancelEditMode();
});

function bindEditButton() {
    const btnEdit = document.getElementById('edit-profile-btn'); // Ambil ulang dari DOM baru

    if (!btnEdit) return;

    btnEdit.addEventListener('click', function () {
        const values = document.querySelectorAll('.profile-value');
        const btnSimpan = document.getElementById('btn-simpan-edit');
        const btnBatal = document.getElementById('btn-batal-edit');

        btnSimpan.disabled = true;
        btnSimpan.style.display = 'inline-block';
        btnBatal.style.display = 'inline-block';
        btnEdit.style.display = 'none';

        originalData = {}; // Reset originalData

        values.forEach(span => {
            const key = span.dataset.key;
            const value = span.textContent.trim();
            originalData[key] = value;

            const input = document.createElement('input');
            input.className = 'profile-value form-control';
            input.name = key;
            input.value = value;
            input.dataset.key = key;
            input.defaultValue = value;

            // Validasi HTML
            if (key === 'namalengkap') {
                input.required = true;
                input.minLength = 5;
                input.maxLength = 50;
            }
            if (key === 'username') {
                input.required = true;
                input.minLength = 5;
                input.maxLength = 18;
            }
            if (key === 'email') {
                input.required = true;
                input.type = 'email';
            }
            if (key === 'kelas') {
                input.required = true;
            }
            if (key === 'id_tabungan' || key === 'created_at') {
                input.disabled = true;
                input.style.color = '#888';
            }

            input.addEventListener('input', () => {
                const isChanged = [...document.querySelectorAll('.profile-value.form-control')]
                    .some(inp => inp.value !== inp.defaultValue);
                btnSimpan.disabled = !isChanged;
            });

            span.replaceWith(input);
        });

        // Rebind tombol simpan setelah tombol diganti
        btnSimpan.addEventListener('click', function (e) {
            e.preventDefault();

            const inputs = document.querySelectorAll('.profile-value.form-control');
            let data = {};
            let errorMessages = [];

            inputs.forEach(input => {
                const key = input.name;
                const value = input.value.trim();
                data[key] = value;

                if (key === 'namalengkap' && (value.length < 5 || value.length > 50)) {
                    errorMessages.push('Nama lengkap harus antara 5–50 karakter.');
                }

                if (key === 'username' && (value.length < 5 || value.length > 18)) {
                    errorMessages.push('Username harus antara 5–18 karakter.');
                }

                if (key === 'email') {
                    const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
                    if (!emailPattern.test(value)) {
                        errorMessages.push('Masukan format email yang valid');
                    }
                }

                if (key === 'kelas' && value === '') {
                    errorMessages.push('Kelas wajib diisi.');
                }
            });

            if (errorMessages.length > 0) {
                errorMessages.forEach(msg => showToast('error', msg));
                return;
            }

            if (data.email !== originalData.email) {
                fetch('/cek-email', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: data.email })
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.exists) {
                            showToast('error', 'Email sudah digunakan oleh pengguna lain.');
                        } else {
                            submitProfil(data);
                        }
                    })
                    .catch(() => showToast('error', 'Terjadi kesalahan saat validasi email.'));
            } else {
                submitProfil(data);
            }
        });

        // Rebind tombol batal juga
        btnBatal.addEventListener('click', (e) => {
            e.preventDefault();
            profileSection.innerHTML = originalHTML;
            bindEditButton();
        });
    });
}
