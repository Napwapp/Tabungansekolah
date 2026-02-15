document.addEventListener('DOMContentLoaded', function () {
    const emailInputs = document.querySelectorAll('.email-input');
    const newEmailInput = document.getElementById('new-email');
    const saveButtons = document.querySelectorAll('.save-button-email');
    const addButtons = document.querySelectorAll('.add-button-email');
    const formTambahEmail = document.getElementById('form-tambah-email'); // Pastikan form ini didefinisikan

    // Fungsi menyembunyikan semua tombol
    function hideAllButtons() {
        saveButtons.forEach(btn => btn.style.display = 'none');
        addButtons.forEach(btn => btn.style.display = 'none');
    }

    // Menyembunyikan tombol saat halaman dimuat
    hideAllButtons();

    // Tombol muncul saat input fokus
    emailInputs.forEach(input => {
        input.addEventListener('focus', function () {
            hideAllButtons();
            const slot = this.getAttribute('data-slot');
            const value = this.value.trim();
            const saveButton = document.querySelector(`.save-button-email[data-slot="${slot}"]`);
            const addButton = document.querySelector(`.add-button-email[data-slot="${slot}"]`);

            // Pastikan tombol simpan tampil jika ada nilai dan tombol tambah tampil jika kosong
            if (value) {
                saveButton.style.display = 'block';
            } else {
                addButton.style.display = 'block';
            }
        });
    });

    // Event Listener untuk mengosongkan input dan menyembunyikan tombol saat klik di luar
    document.addEventListener('click', function (e) {
        const inputElements = document.querySelectorAll('.email-input');
        const buttonElements = document.querySelectorAll('.add-button-email, .save-button-email'); // Tombol yang akan disembunyikan

        inputElements.forEach(input => {
            if (input !== e.target) {
                // Kosongkan input jika klik di luar input
                input.value = '';
                const slot = input.getAttribute('data-slot');
                const emailData = input.getAttribute('value');

                // Tampilkan kembali emailData jika ada
                if (emailData) {
                    input.value = emailData;
                } else {
                    input.placeholder = 'Belum ada data';
                }

                // Sembunyikan tombol jika klik di luar input
                buttonElements.forEach(button => {
                    const slot = button.getAttribute('data-slot');
                    if (slot === input.getAttribute('data-slot')) {
                        button.style.display = 'none'; // Sembunyikan tombol
                    }
                });
            }
        });
    });


    // Event Listener untuk tombol tambah email
    addButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const slot = this.getAttribute('data-slot');
            const emailInput = document.querySelector(`.email-input[data-slot="${slot}"]`);
            const email = emailInput.value.trim();
            const errors = [];

            // Validasi format email harus @gmail.com
            if (email && !/^[\w.-]+@gmail\.com$/.test(email)) {
                errors.push('Email harus dalam format @gmail.com');
            }

            // Validasi minimal karakter
            if (email && email.length < 15) {
                errors.push('Email harus memiliki minimal 15 karakter.');
            }

            // Validasi maksimal karakter
            if (email && email.length > 100) {
                errors.push('Email tidak boleh lebih dari 100 karakter.');
            }

            if (errors.length > 0) {
                // Menampilkan pesan error jika ada
                Swal.fire('Gagal', errors.join('<br>'), 'error');
                return;
            }

            // Cek apakah email sudah ada sebelum memanggil addEmail
            checkEmail(email).then(exists => {
                if (exists) {
                    Swal.fire('Gagal', 'Email sudah terdaftar!', 'error');
                } else {
                    // Lanjutkan ke fetch penambahan email jika email tidak terdaftar
                    addEmail(slot, email);
                }
            }).catch(err => {
                Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
            });
        });
    });


    // Event Listener untuk tombol simpan email
    saveButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const slot = this.getAttribute('data-slot');
            const email = document.querySelector(`.email-input[data-slot="${slot}"]`).value.trim();

            // Validasi email untuk memastikan format @gmail.com
            if (email && !/^[\w.-]+@gmail\.com$/.test(email)) {
                Swal.fire('Gagal', 'Email harus dalam format @gmail.com', 'error');
                return;
            }

            if (email) {
                updateEmail(slot, email);
            }
        });
    });

    // Fungsi untuk mengecek apakah email sudah terdaftar
    function checkEmail(email) {
        return fetch('/admin/landing/email/cek-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email })
        })
            .then(response => response.json())
            .then(data => data.exists) // Kembalikan nilai true/false
            .catch(err => {
                console.error('Error:', err);
                throw err;
            });
    }

    // Fungsi untuk menambah email
    function addEmail(slot, email) {
        // Tampilkan konfirmasi untuk menambahkan email
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Tambahkan email?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tambahkan!',
            cancelButtonText: 'Batal',
        }).then(result => {
            if (result.isConfirmed) {
                fetch('/admin/landing/email/tambah', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: email, id_informasi_email: slot })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const emailInput = document.querySelector(`.email-input[data-slot="${slot}"]`);

                            // Update nilai input dan atribut HTML
                            if (emailInput) {
                                emailInput.value = data.email;
                                emailInput.setAttribute('value', data.email);
                            }
                            Swal.fire('Berhasil', data.message, 'success');
                            hideAllButtons(); // Menyembunyikan tombol-tombol
                        } else {
                            Swal.fire('Gagal', data.error || 'Terjadi kesalahan!', 'error');
                        }
                    })
                    .catch(err => Swal.fire('Error', 'Terjadi Kesalahan!', 'error'));
            }
        });
    }

    // Fungsi untuk memperbarui email
    function updateEmail(slot, email) {
        // Tampilkan konfirmasi untuk memperbarui email
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Perbarui email?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Perbarui!',
            cancelButtonText: 'Batal',
        }).then(result => {
            if (result.isConfirmed) {
                fetch('/admin/landing/email/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: email, id_informasi_email: slot })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Cek respon dari server
                        if (data.status === 'success') {
                            const emailInput = document.querySelector(`.email-input[data-slot="${slot}"]`);
                            if (emailInput) {
                                emailInput.value = email;
                                emailInput.setAttribute('value', email); // Perbarui atribut HTML
                            }
                            Swal.fire('Berhasil', 'Email berhasil diperbarui!', 'success');
                            hideAllButtons();
                        } else {
                            Swal.fire('Gagal', data.message, 'error');
                        }
                    })
                    .catch(err => Swal.fire('Error', 'Terjadi Kesalahan!', 'error'));
            }
        });
    }

    // Fungsi untuk menangani klik di luar input dan reset input
    document.addEventListener('click', function (e) {
        // Cek jika klik di luar form atau tombol submit
        if (!e.target.closest('#form-tambah-email') && !e.target.closest('#new-email')) {
            // Reset form jika klik di luar
            formTambahEmail.reset(); // Reset seluruh form
            newEmailInput.value = ''; // Mengosongkan input email secara eksplisit
        }
    });

    formTambahEmail.addEventListener('submit', function (e) {
        e.preventDefault(); // Mencegah reload halaman
        const email = newEmailInput.value.trim();
        let errors = [];

        // **Validasi Format Email (@gmail.com)**
        if (email && !/^[\w.-]+@gmail\.com$/.test(email)) {
            errors.push('Email harus dalam format @gmail.com');
        }

        // **Validasi Minimal Karakter (15)**
        if (email && email.length < 15) {
            errors.push('Email harus memiliki minimal 15 karakter.');
        }

        // **Validasi Maksimal Karakter (100)**
        if (email && email.length > 100) {
            errors.push('Email tidak boleh lebih dari 100 karakter.');
        }

        // **Jika ada error, tampilkan swal**
        if (errors.length > 0) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: errors.join('<br>'),
            });
            return; // Hentikan eksekusi jika ada error
        }

        // **Pengecekan Duplikat Email**
        fetch('/admin/landing/email/cek-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ email }), // Kirim email ke server
        })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Gagal!',
                        text: 'Email telah terdaftar.',
                    });
                    return; // Hentikan proses jika email duplikat
                }

                // **Konfirmasi Penambahan Email**
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda akan menambahkan email ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Tambahkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // **Proses Penambahan Email**
                        fetch('/admin/landing/email/tambah', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({ email }),
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // **Masukkan Email ke Slot Input yang Kosong**
                                    const emptyInputs = document.querySelectorAll('.email-input');
                                    let isFilled = false;

                                    emptyInputs.forEach(input => {
                                        if (input.value === '' && !isFilled) {
                                            // **Masukkan Email ke Input Slot Kosong Pertama**
                                            input.value = email;
                                            input.setAttribute('value', email); // Persistensi

                                            isFilled = true; // Tandai bahwa slot sudah diisi
                                        }
                                    });

                                    if (isFilled) {
                                        Swal.fire('Berhasil', data.message, 'success');
                                    } else {
                                        Swal.fire('Info', 'Semua slot sudah terisi.', 'info');
                                    }

                                    formTambahEmail.reset(); // Reset input setelah proses
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: data.error || 'Terjadi kesalahan!',
                                    });
                                }
                            })
                            .catch(err => {
                                console.error('Error:', err);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan pada jaringan atau server.',
                                });
                            });
                    }
                });
            });
    });
})