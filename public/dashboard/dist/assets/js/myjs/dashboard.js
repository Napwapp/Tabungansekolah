document.addEventListener('DOMContentLoaded', function () {
    const targetInfo = document.querySelector('.target-info'); // Informasi target
    const progressCircle = document.querySelector('.ring-progress'); // Progress lingkaran
    const progressPercentage = document.querySelector('.progress-percentage'); // Persentase progress
    const modal = document.getElementById('modalTarget'); // Modal
    const saveTargetButton = document.getElementById('saveTarget'); // Tombol simpan
    const closeModalButton = document.getElementById('closeModal'); // Tombol tutup modal
    const aturTargetButton = document.querySelector('.atur-target-btn'); // Tombol Atur Target
    const targetAmountInput = document.getElementById('targetAmount'); // Input target tabungan

    let currentTabungan = 0; // Tabungan user saat ini
    let targetTabungan = localStorage.getItem('targetTabungan') || 2000000; // Ambil target dari localStorage

    // Fungsi untuk menghitung persentase progress
    function calculateProgress() {
        const percentage = Math.min((currentTabungan / targetTabungan) * 100, 100).toFixed(1);
        progressPercentage.textContent = `${percentage}%`;

        // Update progress lingkaran
        const circleCircumference = 339.29; // Keliling lingkaran (2 * π * r)
        const offset = circleCircumference - (circleCircumference * percentage / 100);
        progressCircle.style.strokeDashoffset = offset;

        // Update target info
        targetInfo.innerHTML = `<strong>Target Tabungan:</strong> Rp ${parseInt(targetTabungan).toLocaleString()}`;
    }

    targetAmountInput.addEventListener('input', function (e) {
        // Hapus semua pemisah ribuan (titik) untuk mendapatkan nilai mentah
        let rawValue = e.target.value.replace(/\./g, '');
    
        // Pastikan angka valid
        if (!isNaN(rawValue) && rawValue !== '') {
            // Tampilkan nilai baru tanpa titik di elemen input
            e.target.value = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan titik pemisah ribuan
        } else {
            e.target.value = ''; // Kosongkan input jika tidak valid
        }
    });
    
    saveTargetButton.addEventListener('click', function () {
        const newTarget = targetAmountInput.value.replace(/\./g, ''); // Hapus titik sebelum menyimpan
        if (newTarget && !isNaN(newTarget) && newTarget > 0) {
            targetTabungan = parseInt(newTarget);
            localStorage.setItem('targetTabungan', targetTabungan); // Simpan ke localStorage
            calculateProgress(); // Hitung ulang progress
            modal.style.display = 'none'; // Tutup modal
        } else {
            alert('Masukkan nilai target yang valid!');
        }
    });    
    
    // Fungsi untuk membuka modal
    aturTargetButton.addEventListener('click', function () {
        modal.style.display = 'flex';
    });

    // Fungsi untuk menutup modal
    closeModalButton.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Fungsi untuk menyimpan target baru
    saveTargetButton.addEventListener('click', function () {
        const newTarget = targetAmountInput.value.replace(/\./g, ''); // Hapus titik sebelum disimpan

        if (newTarget && !isNaN(newTarget) && newTarget > 0) {
            targetTabungan = parseInt(newTarget);
            localStorage.setItem('targetTabungan', targetTabungan); // Simpan ke localStorage
            calculateProgress(); // Hitung ulang progress
            modal.style.display = 'none'; // Tutup modal
        } else {
            alert('Masukkan nilai target yang valid!');
        }
    });

    // Inisialisasi progress saat halaman dimuat
    calculateProgress();
});
