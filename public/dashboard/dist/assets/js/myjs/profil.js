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

const profileSection = document.querySelector('.profile-section');
const originalHTML = profileSection.innerHTML;

const namaLengkapDisplay = document.querySelector('.profile-basic-info h1');
const emailDisplay = document.querySelector('.profile-basic-info p');

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

            // Konversi otomatis ke huruf kapital saat mengetik
            input.addEventListener('input', () => {
                input.value = input.value.toUpperCase();
            });
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

btnEdit.addEventListener('click', enterEditMode);

btnSimpan.addEventListener('click', async function (e) {
    e.preventDefault();

    const inputs = document.querySelectorAll('.profile-value.form-control');
    let data = {};
    let errorMessages = [];

    inputs.forEach(input => {
        const key = input.name;
        const value = input.value.trim();
        data[key] = value;

        if (key === 'namalengkap') {
            if (value.length < 5) {
                errorMessages.push('Nama lengkap minimal 5 karakter.');
            }
            if (value.length > 50) {
                errorMessages.push('Nama lengkap maksimal 50 karakter.');
            }
        }

        if (key === 'username') {
            if (value.length < 5) {
                errorMessages.push('Username minimal 5 karakter.');
            }
            if (value.length > 18) {
                errorMessages.push('Username maksimal 18 karakter.');
            }
        }

        if (key === 'email') {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            if (!emailPattern.test(value)) {
                errorMessages.push('Masukkan email yang valid, contoh: nama@email.com');
            }
        }

        if (key === 'kelas') {
            const kelasPattern = /^(X|XI|XII)\s(TBSM 1|TBSM 2|RPL|AKL|OTKP|ATPH|TEI)$/;
            if (!kelasPattern.test(value)) {
                errorMessages.push('Kelas harus dalam format yang valid, contoh: XI RPL atau XII TBSM 2.');
            }
        }
    });

    if (errorMessages.length > 0) {
        errorMessages.forEach(msg => showToast('error', msg));
        return;
    }

    try {
        // Cek email jika berubah
        if (data.email !== originalData.email) {
            const res = await fetch('/cek-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: data.email })
            });

            const result = await res.json();
            if (result.exists) {
                showToast('error', 'Email sudah digunakan oleh pengguna lain.');
                return;
            }
        }

        // Submit data ke server
        const resSubmit = await fetch('/profil/user/edit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });

        const resData = await resSubmit.json();
        if (resData.success) {
            showToast('success', 'Profil berhasil diperbarui!');

            // Ganti input kembali ke span
            const formElements = document.querySelectorAll('.profile-value.form-control');
            formElements.forEach(input => {
                const span = document.createElement('span');
                span.className = 'profile-value';
                span.dataset.key = input.name;
                span.innerText = input.value;
                input.replaceWith(span);
            });

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
    } catch (err) {
        console.error(err);
        showToast('error', 'Terjadi kesalahan jaringan. Silakan coba lagi.');
    }
});

btnBatal.addEventListener('click', function (e) {
    e.preventDefault();
    cancelEditMode();
});
