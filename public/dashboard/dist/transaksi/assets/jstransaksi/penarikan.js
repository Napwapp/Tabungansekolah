document.addEventListener("DOMContentLoaded", function () {
    const depositButton = document.querySelector(".deposit-button");
    const amountInput = document.getElementById("amount");
    const loadingIndicator = document.getElementById("loadingIndicator");
    const increaseButton = document.createElement("button");
    const decreaseButton = document.createElement("button");

    if (!depositButton || !amountInput) return;

    increaseButton.textContent = "+";
    decreaseButton.textContent = "-";
    increaseButton.classList.add("adjust-button");
    decreaseButton.classList.add("adjust-button");

    amountInput.parentNode.appendChild(increaseButton);
    amountInput.parentNode.appendChild(decreaseButton);

    function showLoading() {
        if (loadingIndicator) {
            loadingIndicator.style.display = "flex";
        }
        depositButton.classList.add("loading");
        depositButton.disabled = true;
    }

    function hideLoading() {
        if (loadingIndicator) {
            loadingIndicator.style.display = "none";
        }
        depositButton.classList.remove("loading");
        depositButton.disabled = false;
    }

    function formatNumber(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateInputValue(newValue) {
        amountInput.value = formatNumber(newValue);
        document.getElementById("amountHidden").value = newValue;
    }

    increaseButton.addEventListener("click", function (event) {
        event.preventDefault();
        let currentAmount = parseInt(amountInput.value.replace(/\./g, "")) || 0;
        updateInputValue(currentAmount + 50000);
    });

    decreaseButton.addEventListener("click", function (event) {
        event.preventDefault();
        let currentAmount = parseInt(amountInput.value.replace(/\./g, "")) || 0;
        if (currentAmount >= 50000) {
            updateInputValue(currentAmount - 50000);
        }
    });

    amountInput.addEventListener("input", function () {
        let rawValue = amountInput.value.replace(/\D/g, "");
        amountInput.value = formatNumber(rawValue);
    });

    depositButton.addEventListener("click", function (event) {
        event.preventDefault();
        let currentAmount = parseInt(amountInput.value.replace(/\./g, "")) || 0;
    
        // Validasi: Minimal penarikan harus 20.000
        if (currentAmount < 20000) {
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "Minimal mengajukan penarikan adalah Rp20.000",
            });
            return;
        }
    
        // Validasi: Harus kelipatan 500
        if (currentAmount % 500 !== 0) {
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "Masukkan kelipatan angka yang valid",
            });
            return;
        }
    
        // Cek apakah user sudah memiliki permintaan yang sedang diproses
        if (sessionStorage.getItem("withdrawalPending") === "true") {
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "Anda sudah memiliki permintaan penarikan yang sedang diproses. Harap tunggu persetujuan admin.",
            });
            return;
        }
    
        // Konfirmasi penarikan dengan SweetAlert
        Swal.fire({
            title: "Konfirmasi Penarikan",
            text: `Anda akan menarik Rp${formatNumber(currentAmount)}. Lanjutkan?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, tarik!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();
                sessionStorage.setItem("withdrawalPending", "true");
    
                // Ambil route tujuan dari elemen hidden (atau default ke "/user")
                const userRoute = document.getElementById("userRoute")
                    ? document.getElementById("userRoute").value
                    : "/user";
    
                const form = document.querySelector("form");
                const formData = new FormData(form);
    
                fetch(form.action, {
                    method: form.method,
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content")
                    }
                })
                .then(response => response.json())
                .then(data => {
                    hideLoading();
                    if (data.success) {
                        // Set sessionStorage agar notifikasi dapat ditampilkan di halaman user
                        sessionStorage.setItem("withdrawalSuccess", "true");
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: data.message,
                        }).then(() => {
                            window.location.href = userRoute;
                        });
                    } else {
                        sessionStorage.removeItem("withdrawalPending");
                        Swal.fire({
                            icon: "error",
                            title: "Gagal!",
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
                    hideLoading();
                    sessionStorage.removeItem("withdrawalPending");
                    console.error("Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Gagal!",
                        text: "Terjadi kesalahan saat memproses!",
                    });
                });
            }
        });
    });
})    
