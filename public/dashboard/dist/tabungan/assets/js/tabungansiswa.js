document.addEventListener('DOMContentLoaded', function () {
    const targetInfo = document.querySelector('.target-info'); // Informasi target
    const progressCircle = document.querySelector('.ring-progress'); // Progress lingkaran
    const progressPercentage = document.querySelector('.progress-percentage'); // Persentase progress
    
    // Ambil data total_tabungan dan target_tabungan dari elemen tersembunyi di halaman
    const totalTabunganElement = document.getElementById('total-tabungan');
    const targetTabunganElement = document.getElementById('target-tabungan');

    if (!totalTabunganElement || !targetTabunganElement) {
        console.warn('Elemen total-tabungan atau target-tabungan tidak ditemukan.');
        return;
    }

    let totalTabungan = parseInt(totalTabunganElement.dataset.total) || 0;
    let targetTabungan = parseInt(targetTabunganElement.dataset.target) || 0;

    // Fungsi menghitung progress tabungan
    function calculateProgress() {
        if (targetTabungan <= 0) {
            console.warn('Target tabungan belum diatur atau bernilai 0.');
            progressPercentage.textContent = '0%';
            progressCircle.style.strokeDashoffset = 339.29; // Reset progress lingkaran
            return;
        }

        const percentage = Math.min((totalTabungan / targetTabungan) * 100, 100).toFixed(1);
        progressPercentage.textContent = `${percentage}%`;

        // Update progress lingkaran
        const circleCircumference = 339.29; // Keliling lingkaran (2 * π * r)
        const offset = circleCircumference - (circleCircumference * percentage / 100);
        progressCircle.style.strokeDashoffset = offset;
    }

    // Jalankan perhitungan progress saat halaman dimuat
    calculateProgress();
});
