document.addEventListener("DOMContentLoaded", function () {
    const userRoute = document.getElementById("userRoute").value;
    const form = document.querySelector('form');
    const nominalCards = document.querySelectorAll('.nominal-card');
    const customAmountInput = document.getElementById('customAmount');
    const payButton = document.querySelector('.pay-btn');
    const loadingIndicator = document.getElementById('loading-indicator');

    // 1. Fungsi Validasi
    const validateInput = (amount) => {
        const errors = [];
        const numericAmount = parseInt(amount, 10);
        // Jika kurang dari 10.000
        if (numericAmount < 10000) {
            errors.push("Minimal pengisian saldo Rp10.000");
        }
        // Jika jumlah >= 10.000 tetapi tidak kelipatan 500
        else if (numericAmount % 500 !== 0) {
            errors.push("Masukkan kelipatan angka yang valid! (Kelipatan 500 atau 1.000)");
        }
        return errors;
    };

    if (sessionStorage.getItem("topupPending") === "true") {
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "Anda sudah memiliki transaksi yg masih Menunggu Persetujuan. Harap segera datangi staff khusus untuk melakukan pembayaran!",
        });
        return;
    }


    // 2. Fungsi Format
    const formatNumberWithDots = (value) => {
        const rawValue = value.replace(/\./g, '');
        return rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    };

    // 3. Toggle tombol bayar
    const togglePayButton = () => {
        const rawValue = customAmountInput.value.replace(/\./g, '');
        payButton.disabled = !(rawValue.length > 0 && parseInt(rawValue) > 0);
        payButton.classList.toggle('active', !payButton.disabled);
    };

    // 4. Handling nominal cards
    nominalCards.forEach(card => {
        card.addEventListener("click", function () {
            const isSelected = this.classList.toggle('selected');
            nominalCards.forEach(otherCard => {
                if (otherCard !== this) {
                    otherCard.classList.remove('selected');
                    otherCard.style.border = "2px solid rgba(88, 85, 85, 0.4)";
                    otherCard.style.backgroundColor = "#ffffff";
                }
            });
            if (isSelected) {
                const nominalValue = this.querySelector(".amount").textContent.replace(/\./g, '');
                customAmountInput.value = formatNumberWithDots(nominalValue);
                this.style.border = "2px solid #007bff";
                this.style.backgroundColor = "#e8f4ff";
            } else {
                customAmountInput.value = "";
                this.style.border = "2px solid rgba(88, 85, 85, 0.4)";
                this.style.backgroundColor = "#ffffff";
            }
            togglePayButton();
        });
    });

    // 5. Input handling
    customAmountInput.addEventListener('input', function (e) {
        const cursorPosition = e.target.selectionStart;
        const rawValue = this.value.replace(/\./g, '');
        this.value = formatNumberWithDots(rawValue);
        const newCursorPos = cursorPosition + (this.value.length - rawValue.length);
        this.setSelectionRange(newCursorPos, newCursorPos);
        togglePayButton();
    });

    // 6. Form submission
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const rawAmount = customAmountInput.value.replace(/\./g, '');
        const amount = parseInt(rawAmount, 10) || 0;

        const validationErrors = validateInput(amount);
        if (validationErrors.length > 0) {
            Swal.fire({
                icon: "error",
                title: "Validasi Gagal!",
                html: validationErrors.join("<br>"),
                confirmButtonColor: "#007bff"
            });
            return;
        }

        // Tampilkan loading
        payButton.disabled = true;
        loadingIndicator.style.display = 'block';

        // Kirim request via fetch
        // Kirim request via fetch
        fetch('/isi-saldo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ jumlah: amount })
        })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) throw data;
                return data;
            })
            .then(data => {
                Swal.fire({
                    icon: "info",  // Gunakan ikon jam/proses
                    title: "Berhasil!",
                    text: "Transaksi berhasil! Menunggu persetujuan dari admin. Silakan datangi admin untuk melakukan pembayaran.",
                    confirmButtonColor: "#007bff"
                }).then(() => {
                    window.location.href = userRoute;
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: "warning", // Gunakan ikon warning karena ini hanya peringatan, bukan error
                    title: "Menunggu Persetujuan!",
                    html: error.message || "Anda sudah memiliki transaksi yang masih Menunggu Persetujuan. Harap segera datangi staff khusus untuk melakukan pembayaran!",
                    confirmButtonColor: "#007bff"
                });
            })
            .finally(() => {
                payButton.disabled = false;
                loadingIndicator.style.display = 'none';
            });

        togglePayButton();
    });
})
