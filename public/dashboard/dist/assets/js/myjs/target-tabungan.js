document.addEventListener('DOMContentLoaded', function () {
    const saldoTabungan = 1000000; // Saldo tabungan pengguna
    const progressBar = document.getElementById('progressBar');
    const setTargetButton = document.getElementById('setTarget');
    const targetInput = document.getElementById('targetTabungan');
    const progressCircle = document.querySelector('.ring-progress');
    const percentageText = document.querySelector('.progress-percentage');
    const totalTabungan = parseInt(document.getElementById('total-tabungan').dataset.total || 0);
    const targetTabungan = parseInt(document.getElementById('target-tabungan').dataset.target || 0);

    // Hitung progres hanya jika target valid
    let progress = 0;
    if (targetTabungan > 0) {
        progress = Math.min((totalTabungan / targetTabungan) * 100, 100);
    }

    // Update tampilan lingkaran SVG
    if (progressCircle) {
        const radius = progressCircle.r.baseVal.value;
        const circumference = 2 * Math.PI * radius;
        progressCircle.style.strokeDasharray = `${circumference}`;
        const offset = circumference - (progress / 100) * circumference;
        progressCircle.style.strokeDashoffset = offset;
    }

    // Update teks persentase
    if (percentageText) {
        percentageText.textContent = `${Math.round(progress)}%`;
    }

    // Tampilkan ikon jika sudah 100%
    const iconTarget = document.getElementById('icon-target-tercapai');
    if (progress === 100 && iconTarget) {
        iconTarget.style.display = 'inline';
    }

    // Atur progress awal ke 0%
    if (progressBar) {
        progressBar.style.width = '0%';
        progressBar.setAttribute('aria-valuenow', 0);
        progressBar.textContent = '0%';
    }

    if (setTargetButton && targetInput && progressBar) {
        setTargetButton.addEventListener('click', () => {
            const target = parseInt(targetInput.value);

            if (isNaN(target) || target <= 0) {
                alert('Silakan masukkan target tabungan yang valid!');
                return;
            }

            const progress = Math.min((saldoTabungan / target) * 100, 100); // Hitung progres (maksimal 100%)
            const roundedProgress = isNaN(progress) ? 0 : Math.round(progress);

            progressBar.style.width = `${roundedProgress}%`;
            progressBar.setAttribute('aria-valuenow', roundedProgress);
            progressBar.textContent = `${roundedProgress}%`;

            if (roundedProgress === 100) {
                alert('Selamat! Anda telah mencapai target tabungan!');
            }

            const toggleDarkMode = document.querySelector("#darkModeToggle");
            const body = document.body;

            if (toggleDarkMode) {
                toggleDarkMode.addEventListener("click", () => {
                    body.classList.toggle("dark-mode");
                });
            }
        });
    }
});
