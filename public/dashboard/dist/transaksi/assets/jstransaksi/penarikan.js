document.addEventListener("DOMContentLoaded", function () {
    const amountInput = document.getElementById("amount");
    const depositButton = document.querySelector(".deposit-button"); // Menggunakan nama yang sesuai
    const increaseButton = document.createElement("button");
    const decreaseButton = document.createElement("button");

    // Menambahkan atribut untuk tombol + dan -
    increaseButton.textContent = "+";
    decreaseButton.textContent = "-";
    increaseButton.classList.add("adjust-button");
    decreaseButton.classList.add("adjust-button");
    increaseButton.setAttribute("type", "button"); // Mencegah tombol berfungsi sebagai submit
    decreaseButton.setAttribute("type", "button");

    // Menambahkan tombol ke dalam DOM
    amountInput.parentNode.appendChild(increaseButton);
    amountInput.parentNode.appendChild(decreaseButton);

    // Fungsi untuk memperbarui status tombol (sesuai dengan kode awal user)
    function updateButtonState() {
        if (amountInput.value.trim() === "") {
            depositButton.classList.add("disabled"); // Tombol dinonaktifkan
            depositButton.disabled = true;
        } else {
            depositButton.classList.remove("disabled"); // Tombol diaktifkan
            depositButton.disabled = false;
        }
    }

    // Fungsi untuk mengupdate input dengan format angka
    function formatNumber(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Fungsi untuk memperbarui input dengan nilai baru
    function updateInputValue(newValue) {
        amountInput.value = formatNumber(newValue);
        amountInput.dispatchEvent(new Event("input")); // Memicu event input agar perubahan terdeteksi
    }

    // Event listener untuk tombol +
    increaseButton.addEventListener("click", function (event) {
        event.preventDefault(); // Mencegah perilaku bawaan tombol
        let currentAmount = parseInt(amountInput.value.replace(/\./g, "")) || 0;
        updateInputValue(currentAmount + 50000);
        updateButtonState(); // Memastikan tombol diperbarui
    });

    // Event listener untuk tombol -
    decreaseButton.addEventListener("click", function (event) {
        event.preventDefault(); // Mencegah perilaku bawaan tombol
        let currentAmount = parseInt(amountInput.value.replace(/\./g, "")) || 0;
        if (currentAmount >= 50000) {
            updateInputValue(currentAmount - 50000);
        }
        updateButtonState(); // Memastikan tombol diperbarui
    });

    // Event listener untuk input manual
    amountInput.addEventListener("input", function () {
        let rawValue = amountInput.value.replace(/\D/g, ""); // Hanya ambil angka
        amountInput.value = formatNumber(rawValue);
        updateButtonState();
    });

    // Inisialisasi status tombol saat halaman dimuat
    updateButtonState();
});
