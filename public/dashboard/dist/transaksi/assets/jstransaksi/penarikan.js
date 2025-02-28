document.addEventListener("DOMContentLoaded", function () {
    const depositButton = document.querySelector(".deposit-button");
    const amountInput = document.getElementById("amount");
    const amountHidden = document.getElementById("amountHidden");  // Pastikan input tersembunyi ini ada
    const loadingIndicator = document.getElementById("loadingIndicator");
    const increaseButton = document.createElement("button");
    const decreaseButton = document.createElement("button");
    const tarikSemuaButton = document.querySelector(".button-tabung-semua");

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
        amountHidden.value = newValue;  // Update hidden input value
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
        let rawValue = amountInput.value.replace(/\D/g, ""); // Hanya angka
        amountInput.value = formatNumber(rawValue);
        amountHidden.value = rawValue; // Pastikan hidden input selalu diperbarui
    });
    

    // Tombol Tarik Semua
    if (tarikSemuaButton) {
        tarikSemuaButton.addEventListener("click", function (event) {
            event.preventDefault();
            const totalTabungan = parseInt(tarikSemuaButton.getAttribute("data-tabungan")) || 0;
            if (totalTabungan >= 20000) {
                updateInputValue(totalTabungan);  // Update input dengan total yang bisa ditarik
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Tabungan yang dapat ditarik tidak mencukupi untuk melakukan penarikan.",
                });
            }
        });
    }

    depositButton.addEventListener("click", function (event) {
        event.preventDefault();
        let currentAmount = parseInt(amountInput.value.replace(/\./g, "")) || 0;
    
        if (currentAmount < 20000) {
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "Minimal mengajukan penarikan adalah Rp20.000",
            });
            return;
        }
    
        if (currentAmount % 500 !== 0) {
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "Masukkan kelipatan angka yang valid",
            });
            return;
        }
    
        if (sessionStorage.getItem("withdrawalPending") === "true") {
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "Anda sudah memiliki transaksi yg masih Menunggu Persetujuan. Harap segera datangi staff khusus untuk melakukan pembayaran!",
            });
            return;
        }
    
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
});
