document.addEventListener('DOMContentLoaded', function () {
    if (typeof toastr !== 'undefined') {
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-center',
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
    }

    // Mengatur event listener untuk perubahan input
    ['github', 'instagram', 'linkedin'].forEach(field => {
        ['anggota_1', 'anggota_2', 'anggota_3'].forEach(anggotaId => {
            const input = document.getElementById(`${anggotaId}-${field}`);
            if (input) {
                input.addEventListener('input', () => {
                    checkFormChanges(`form-sosmed-${anggotaId}`, `btn-simpan-${anggotaId}`);
                    if (input.value !== input.defaultValue) {
                        input.classList.add('changed');
                        input.setAttribute('data-changed', 'true');
                    } else {
                        input.classList.remove('changed');
                        input.removeAttribute('data-changed');
                    }
                });
            }
        });
    });

    function checkFormChanges(formId, btnId) {
        const form = document.getElementById(formId);
        const btn = document.getElementById(btnId);
        let isChanged = false;
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            if (input.value !== input.defaultValue) {
                isChanged = true;
            }
        });
        btn.disabled = !isChanged;
    }

    // Event listener untuk klik di luar form
    ['anggota_1', 'anggota_2', 'anggota_3'].forEach(anggotaId => {
        document.addEventListener('click', function (event) {
            const form = document.getElementById(`form-sosmed-${anggotaId}`);
            if (!form.contains(event.target)) {
                const inputs = form.querySelectorAll('input');
                inputs.forEach(input => {
                    input.value = input.defaultValue;
                    input.classList.remove('changed');
                    input.removeAttribute('data-changed');
                });
                const btn = document.getElementById(`btn-simpan-${anggotaId}`);
                btn.disabled = true;
            }
        });
    });

    // Fungsi untuk validasi URL sebelum submit
    function validateUrls(formData) {
        const github = formData.get('github');
        const instagram = formData.get('instagram');
        const linkedin = formData.get('linkedin');
        let valid = true;
        if (github && !/^https?:\/\/(www\.)?github\.com\/.+/i.test(github)) {
            toastr.error("URL GitHub tidak valid. URL harus dari domain github.com.", 'Error');
            valid = false;
        }
        if (instagram && !/^https?:\/\/(www\.)?instagram\.com\/.+/i.test(instagram)) {
            toastr.error("URL Instagram tidak valid. URL harus dari domain instagram.com.", 'Error');
            valid = false;
        }
        if (linkedin && !/^https?:\/\/(www\.)?linkedin\.com\/in\/.+/i.test(linkedin)) {
            toastr.error("URL LinkedIn tidak valid. URL harus dari domain linkedin.com/in/.", 'Error');
            valid = false;
        }
        return valid;
    }

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
        if (loadingBox) {
            loadingBox.remove();
        }
    }

    // Function untuk menampilkan modal konfirmasi sebelum submit
    function showConfirmDialog() {
        return new Promise((resolve, reject) => {
            const modal = document.getElementById('confirmModal');
            const btnYes = document.getElementById('confirmYes');
            const btnNo = document.getElementById('confirmNo');
            modal.style.display = 'flex';
            const handleYes = () => {
                modal.style.display = 'none';
                btnYes.removeEventListener('click', handleYes);
                btnNo.removeEventListener('click', handleNo);
                resolve(true);
            };
            const handleNo = () => {
                modal.style.display = 'none';
                btnYes.removeEventListener('click', handleYes);
                btnNo.removeEventListener('click', handleNo);
                reject("Pengiriman dibatalkan.");
            };
            btnYes.addEventListener('click', handleYes);
            btnNo.addEventListener('click', handleNo);
        });
    }

    // Fungsi pengecekan unik terpisah untuk masing-masing sosial media
    function checkGithub(githubUrl) {
        return fetch('/check-github', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ github: githubUrl })
        })
        .then(response => response.json())
        .then(data => data.exists);
    }

    function checkInstagram(instagramUrl) {
        return fetch('/check-instagram', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ instagram: instagramUrl })
        })
        .then(response => response.json())
        .then(data => data.exists);
    }

    function checkLinkedin(linkedinUrl) {
        return fetch('/check-linkedin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ linkedin: linkedinUrl })
        })
        .then(response => response.json())
        .then(data => data.exists);
    }

    // Menambahkan event listener untuk form submit
    ['anggota_1', 'anggota_2', 'anggota_3'].forEach(anggotaId => {
        handleSubmitForm(anggotaId);
    });

    function handleSubmitForm(anggotaId) {
        document.getElementById(`form-sosmed-${anggotaId}`).addEventListener('submit', function (event) {
            event.preventDefault();

            const form = document.getElementById(`form-sosmed-${anggotaId}`);
            const formData = new FormData(form);

            if (!validateUrls(formData)) return;

            showConfirmDialog()
                .then(() => {
                    // Deteksi input mana yang telah berubah (menggunakan data-changed)
                    const githubInput = document.getElementById(`${anggotaId}-github`);
                    const instagramInput = document.getElementById(`${anggotaId}-instagram`);
                    const linkedinInput = document.getElementById(`${anggotaId}-linkedin`);

                    const checks = [];

                    if (githubInput.hasAttribute('data-changed')) {
                        const githubUrl = formData.get('github');
                        checks.push(
                            checkGithub(githubUrl).then(exists => {
                                if (exists) {
                                    toastr.error('GitHub sudah terdaftar. Silakan pilih URL lain.', 'Error');
                                    return false;
                                }
                                return true;
                            })
                        );
                    }
                    if (instagramInput.hasAttribute('data-changed')) {
                        const instagramUrl = formData.get('instagram');
                        checks.push(
                            checkInstagram(instagramUrl).then(exists => {
                                if (exists) {
                                    toastr.error('Instagram sudah terdaftar. Silakan pilih URL lain.', 'Error');
                                    return false;
                                }
                                return true;
                            })
                        );
                    }
                    if (linkedinInput.hasAttribute('data-changed')) {
                        const linkedinUrl = formData.get('linkedin');
                        checks.push(
                            checkLinkedin(linkedinUrl).then(exists => {
                                if (exists) {
                                    toastr.error('LinkedIn sudah terdaftar. Silakan pilih URL lain.', 'Error');
                                    return false;
                                }
                                return true;
                            })
                        );
                    }

                    // Jika tidak ada input yang berubah, langsung submit
                    if (checks.length === 0) {
                        submitForm(anggotaId, formData);
                        return;
                    }

                    Promise.all(checks).then(results => {
                        // Jika semua pengecekan valid, submit form
                        if (results.every(result => result === true)) {
                            submitForm(anggotaId, formData);
                        }
                    });
                })
                .catch(message => {
                    toastr.info(message, 'Info', {
                        positionClass: 'toast-top-center',
                        timeOut: 3000
                    });
                });
        });
    }

    function submitForm(anggotaId, formData) {
        const btn = document.getElementById(`btn-simpan-${anggotaId}`);
        btn.disabled = true;
        showLoading();

        fetch(`/sosmed/${anggotaId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                toastr.success(data.message, 'Sukses');

                const form = document.getElementById(`form-sosmed-${anggotaId}`);
                for (let [key, value] of formData.entries()) {
                    const input = form.querySelector(`input[name="${key}"]`);
                    if (input) {
                        input.defaultValue = value;
                        input.value = value;
                        input.removeAttribute('data-changed'); // Reset status perubahan
                    }
                }
                btn.disabled = true;
            })
            .catch(error => {
                hideLoading();
                toastr.error('Terjadi kesalahan saat mengirim data.', 'Error');
                btn.disabled = false;
            });
    }
});
