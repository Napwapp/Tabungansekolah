document.addEventListener('DOMContentLoaded', () => {
  const saldoTabungan = 1000000; // Saldo tabungan pengguna
  const progressBar = document.getElementById('progressBar');
  const setTargetButton = document.getElementById('setTarget');
  const targetInput = document.getElementById('targetTabungan');

  setTargetButton.addEventListener('click', () => {
    const target = parseInt(targetInput.value); // Ambil nilai target dari input
    if (!target || target <= 0) {
      alert('Silakan masukkan target tabungan yang valid!');
      return;
    }

    const progress = Math.min((saldoTabungan / target) * 100, 100); // Hitung progres (maksimal 100%)
    progressBar.style.width = `${progress}%`;
    progressBar.setAttribute('aria-valuenow', progress);
    progressBar.textContent = `${Math.round(progress)}%`;

    if (progress === 100) {
      alert('Selamat! Anda telah mencapai target tabungan!');
    }
    const toggleDarkMode = document.querySelector("#darkModeToggle"); // Tombol toggle
    const body = document.body;

    toggleDarkMode.addEventListener("click", () => {
        body.classList.toggle("dark-mode"); // Tambahkan atau hapus kelas 'dark-mode'
    });

  });
});
