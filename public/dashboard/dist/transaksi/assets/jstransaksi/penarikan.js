document.addEventListener("DOMContentLoaded", function () {
    const buttonTabungSemua = document.querySelector(".button-tabung-semua");
    const amountInput = document.getElementById("amount");
    const depositButton = document.querySelector(".deposit-button");
    const increaseButton = document.createElement("button");
    const decreaseButton = document.createElement("button");

    // Menambahkan atribut untuk tombol + dan -
    increaseButton.textContent = "+";
    decreaseButton.textContent = "-";
    increaseButton.classList.add("adjust-button");
    decreaseButton.classList.add("adjust-button");
    increaseButton.setAttribute("type", "button");
    decreaseButton.setAttribute("type", "button");

    // Menambahkan tombol ke dalam DOM
    amountInput.parentNode.appendChild(increaseButton);
    amountInput.parentNode.appendChild(decreaseButton);

    // Fungsi untuk memperbarui status tombol
    function updateButtonState() {
        if (amountInput.value.trim() === "") {
            depositButton.classList.add("disabled");
            depositButton.disabled = true;
        } else {
            depositButton.classList.remove("disabled");
            depositButton.disabled = false;
        }
    }

    // Fungsi untuk mengubah angka ke format ribuan (20.000)
    function formatNumber(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Fungsi untuk memperbarui input dengan nilai baru
   // Update nilai input tersembunyi setiap kali input utama berubah
    function updateInputValue(newValue) {
        amountInput.value = formatNumber(newValue); // Format dengan titik
        document.getElementById("amountHidden").value = newValue; // Simpan angka asli tanpa titik
    }

    // Pastikan input tersembunyi diperbarui sebelum form dikirim
    document.querySelector("form").addEventListener("submit", function () {
        let cleanValue = amountInput.value.replace(/\./g, ""); // Hapus titik sebelum dikirim
        document.getElementById("amountHidden").value = cleanValue;
    });

    // Pastikan input tersembunyi selalu diperbarui
    function updateHiddenInput() {
        let cleanValue = amountInput.value.replace(/\./g, ""); // Hapus titik
        document.getElementById("amountHidden").value = cleanValue; // Simpan angka asli
    }

    // Perbarui input tersembunyi saat input utama berubah
    amountInput.addEventListener("input", updateHiddenInput);

    // Perbarui sebelum form dikirim
    document.querySelector("form").addEventListener("submit", function () {
        updateHiddenInput(); // Pastikan nilai dikirim ke backend
    });

    // Event listener untuk tombol +
    increaseButton.addEventListener("click", function (event) {
        event.preventDefault();
        let currentAmount = parseInt(amountInput.value.replace(/\./g, "")) || 0;
        updateInputValue(currentAmount + 50000);
        updateButtonState();
    });

    // Event listener untuk tombol -
    decreaseButton.addEventListener("click", function (event) {
        event.preventDefault();
        let currentAmount = parseInt(amountInput.value.replace(/\./g, "")) || 0;
        if (currentAmount >= 50000) {
            updateInputValue(currentAmount - 50000);
        }
        updateButtonState();
    });

    // Event listener untuk input manual
    amountInput.addEventListener("input", function () {
        let rawValue = amountInput.value.replace(/\D/g, ""); // Hanya angka
        amountInput.value = formatNumber(rawValue);
        updateButtonState();
    });

    // 🔹 Event listener untuk tombol "Tarik Semua"
    if (buttonTabungSemua) {
        buttonTabungSemua.addEventListener("click", function () {
            const totalTabungan = parseInt(buttonTabungSemua.getAttribute("data-tabungan").replace(/\./g, "")) || 0;
            if (totalTabungan > 0) {
                updateInputValue(totalTabungan);
                updateButtonState();
            } else {
                if (typeof Swal !== "undefined") {
                    Swal.fire({
                        icon: "warning",
                        title: "Saldo Kosong",
                        text: "Anda tidak memiliki tabungan yang bisa ditarik.",
                    });
                } else {
                    alert("Saldo Kosong: Anda tidak memiliki tabungan yang bisa ditarik.");
                }
            }
        });
    }

    // Event listener untuk tombol penarikan
    depositButton.addEventListener("click", function (event) {
        event.preventDefault();
        let currentAmount = parseInt(amountInput.value.replace(/\./g, "")) || 0;

        // Validasi jumlah penarikan
        if (currentAmount < 20000) {
            if (typeof Swal !== "undefined") {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Minimal penarikan adalah Rp20.000!",
                });
            } else {
                alert("Gagal! Minimal penarikan adalah Rp20.000!");
            }
            return;
        }
        if (currentAmount % 500 !== 0) {
            if (typeof Swal !== "undefined") {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Masukkan kelipatan angka yang valid",
                });
            } else {
                alert("Gagal! Masukkan kelipatan angka yang valid");
            }
            return;
        }

        // Konfirmasi penarikan
        if (typeof Swal !== "undefined") {
            Swal.fire({
                title: "Konfirmasi Penarikan",
                text: `Anda akan menarik Rp${formatNumber(currentAmount)}. Lanjutkan?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, tarik!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector("form").submit(); // Submit form jika disetujui
                }
            });
        } else {
            if (confirm(`Anda akan menarik Rp${formatNumber(currentAmount)}. Lanjutkan?`)) {
                document.querySelector("form").submit();
            }
        }
    });

    // Inisialisasi status tombol saat halaman dimuat
    updateButtonState();
});
