document.addEventListener('DOMContentLoaded', function () {
    const targetInfo = document.querySelector('.target-info'); // Informasi target
    const progressCircle = document.querySelector('.ring-progress'); // Progress lingkaran
    const progressPercentage = document.querySelector('.progress-percentage'); // Persentase progress
    const modal = document.getElementById('modalTarget'); // Modal (sesuaikan dengan ID modal jika ada)
    const saveTargetButton = document.querySelector('.save-btn'); // Tombol simpan berdasarkan kelas
    const closeModalButton = document.getElementById('closeModal'); // Tombol tutup modal
    const aturTargetButton = document.querySelector('.atur-target-btn'); // Tombol Atur Target
    const targetAmountInput = document.getElementById('targetAmount'); // Input target tabungan
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF Token Laravel

    // Ambil data total_tabungan dan target_tabungan dari elemen tersembunyi di halaman
    let totalTabungan = parseInt(document.getElementById('total-tabungan')?.dataset.total) || 0;  // Ambil total tabungan
    let targetTabungan = parseInt(document.getElementById('target-tabungan')?.dataset.target) || 0; // Default jika null

    // Fungsi menghitung progress tabungan
    function calculateProgress() {
        const percentage = Math.min((totalTabungan / targetTabungan) * 100, 100).toFixed(1);
        progressPercentage.textContent = `${percentage}%`;

        // Update progress lingkaran
        const circleCircumference = 339.29; // Keliling lingkaran (2 * π * r)
        const offset = circleCircumference - (circleCircumference * percentage / 100);
        progressCircle.style.strokeDashoffset = offset;
    }
    
    // Format angka dengan titik otomatis saat mengetik
    targetAmountInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ""); // Hapus semua karakter non-angka
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Tambahkan titik setiap 3 angka
        e.target.value = value;
    });

    // Validasi dan kirim data saat klik tombol simpan
    if (saveTargetButton && targetAmountInput) {
        saveTargetButton.addEventListener('click', function (e) {
            e.preventDefault(); // Mencegah form untuk submit secara otomatis dan refresh halaman

            let newTarget = targetAmountInput.value.replace(/\./g, ''); // Hapus titik pemisah ribuan
            newTarget = parseInt(newTarget); // Konversi ke angka

            // Validasi frontend (minimal Rp 10.000 dan kelipatan 500)
            if (!newTarget || isNaN(newTarget) || newTarget < 20000) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Atur target minimal 20.000!',
                });
                return;
            }

            if (newTarget % 500 !== 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Atur target dengan kelipatan angka yang valid untuk menghindari kesalahan perhitungan! Kelipatan 500.',
                });
                return;
            }

            targetTabungan = newTarget;
            localStorage.setItem('targetTabungan', targetTabungan); // Simpan ke localStorage

            // Kirim data ke server menggunakan fetch()
            fetch('/target-tabungan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken, // Laravel membutuhkan CSRF Token
                },
                body: JSON.stringify({ target_amount: newTarget }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                    }).then(() => {
                        // Setelah SweetAlert ditutup, arahkan kembali ke halaman yang sesuai
                        location.reload();
                    });
                    calculateProgress(); // Perbarui progress
                    modal.style.display = 'none'; // Tutup modal
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal menghubungi server.',
                });
            });
        });
    }

    // Fungsi untuk membuka modal
    if (aturTargetButton) {
        aturTargetButton.addEventListener('click', function () {
            modal.style.display = 'flex';
        });
    }

    // Fungsi untuk menutup modal
    if (closeModalButton) {
        closeModalButton.addEventListener('click', function () {
            modal.style.display = 'none';
        });
    }

    // Inisialisasi progress saat halaman dimuat
    calculateProgress();
});


// Notifikasi Penarikan
document.addEventListener("DOMContentLoaded", function () {
    if (sessionStorage.getItem("withdrawalSuccess")) {
        // Tampilkan notifikasi
        const notification = document.createElement("div");
        notification.innerHTML = `
            <div class="notif-container">
                <div class="notif-icon">✔</div>
                <div class="notif-text">
                    <strong>Permintaan Berhasil!</strong>
                    <p>Penarikan telah diajukan dan sedang menunggu persetujuan admin.</p>
                </div>
                <button class="notif-close">&times;</button>
            </div>
        `;
        document.body.appendChild(notification);

        // Hapus item dari sessionStorage agar tidak muncul lagi setelah reload
        sessionStorage.removeItem("withdrawalSuccess");

        // Event untuk menutup notifikasi
        document.querySelector(".notif-close").addEventListener("click", function () {
            notification.classList.add("fade-out");
            setTimeout(() => {
                notification.remove();
            }, 500);
        });

        // Otomatis menghilangkan notifikasi dengan fade-out dalam 5 detik
        setTimeout(() => {
            notification.classList.add("fade-out");
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 4000);
    }
});

// Notifiki menabung
document.addEventListener("DOMContentLoaded", function () {
    if (sessionStorage.getItem("savingSuccess")) {
        // Tampilkan notifikasi khusus penabungan
        const notification = document.createElement("div");
        notification.innerHTML = `
            <div class="notif-container">
                <div class="notif-icon">✔</div>
                <div class="notif-text">
                    <strong>Berhasil Menabung!</strong>
                    <p>Tabungan berhasil ditambahkan</p>
                </div>
                <button class="notif-close">&times;</button>
            </div>
        `;
        document.body.appendChild(notification);

        // Hapus item dari sessionStorage
        sessionStorage.removeItem("savingSuccess");

        // Fungsi penutupan notifikasi
        const closeNotification = () => {
            notification.classList.add("fade-out");
            setTimeout(() => {
                notification.remove();
            }, 500);
        };

        // Handler tombol close
        document.querySelector(".notif-close").addEventListener("click", closeNotification);

        // Auto-close setelah 4 detik
        setTimeout(closeNotification, 4000);
    }
});

// Notifikasi Berhasil Topup
document.addEventListener("DOMContentLoaded", function () {
    if (sessionStorage.getItem("topupSuccess")) {
        const notification = document.createElement("div");
        notification.innerHTML = `
            <div class="notif-container">
                <div class="notif-icon">✔</div>
                <div class="notif-text">
                    <strong>Topup Berhasil!</strong>
                    <p>Saldo berhasil ditambahkan ke akun Anda.</p>
                </div>
                <button class="notif-close">&times;</button>
            </div>
        `;
        document.body.appendChild(notification);

        sessionStorage.removeItem("topupSuccess");

        const closeNotification = () => {
            notification.classList.add("fade-out");
            setTimeout(() => notification.remove(), 500);
        };

        document.querySelector(".notif-close").addEventListener("click", closeNotification);
        setTimeout(closeNotification, 4000);
    }
});