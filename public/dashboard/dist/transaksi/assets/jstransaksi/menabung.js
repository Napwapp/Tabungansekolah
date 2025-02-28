document.addEventListener("DOMContentLoaded", function () {
    const amountInput = document.getElementById("amount");
    const depositButton = document.getElementById("tabungButton");
    const loadingIndicator = document.getElementById("loadingIndicator");
    const tabungSemuaButton = document.querySelector(".button-tabung-semua");
    const balanceAmountElement = document.querySelector(".balance-amount");
    const userRoute = document.getElementById("userRoute").value;
  
    let availableDeposit = parseInt(
        balanceAmountElement.textContent.replace(/[^\d]/g, ""),
        10
    ) || 0;
  
    function formatWithDots(value) {
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
  
    function validateInput() {
        const depositAmount = parseInt(amountInput.value.replace(/\./g, ""), 10) || 0;
        depositButton.disabled = !(depositAmount > 0);
    }
  
    amountInput.addEventListener("input", function () {
        const value = amountInput.value.replace(/\D/g, "");
        amountInput.value = formatWithDots(value);
        validateInput();
    });
  
    if (tabungSemuaButton) {
        tabungSemuaButton.addEventListener("click", function () {
            if (availableDeposit > 0) {
                amountInput.value = availableDeposit.toLocaleString("id-ID");
                validateInput();
            }
        });
    }
  
    depositButton.addEventListener("click", function (event) {
        event.preventDefault();
  
        const depositAmount = parseInt(amountInput.value.replace(/\./g, ""), 10);
        let availableDeposit = parseInt(
            document.querySelector(".balance-amount").textContent.replace(/[^\d]/g, ""),
            10
        ) || 0;
  
        if (isNaN(depositAmount)) {
            Swal.fire("Error!", "Masukkan angka yang valid!", "error");
            return;
        }
  
        if (depositAmount < 10000) {
            Swal.fire("Error!", "Maaf, Minimal menabung sebesar 10.000", "error");
            return;
        }
  
        if (depositAmount % 500 !== 0) {
            Swal.fire("Error!", "Masukan kelipatan angka yang valid! Kelipatan 500", "error");
            return;
        }
  
        if (depositAmount > availableDeposit) {
            Swal.fire("Error!", "Maaf, Saldo tidak mencukupi.", "error");
            return;
        }
  
        depositButton.classList.add("loading");
        depositButton.disabled = true;
        depositButton.textContent = "Sedang memproses...";
        loadingIndicator.style.display = "flex";
  
        fetch("/tabung-uang", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ jumlah: depositAmount })
        })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) throw data;
                return data;
            })
            .then(data => {
                Swal.fire({
                    icon: "info",  // Menampilkan ikon info jika transaksi berhasil
                    title: "Berhasil!",
                    text: "Berhasil Menabung! Menunggu persetujuan dari admin.",
                    confirmButtonColor: "#007bff"
                }).then(() => {
                    window.location.href = userRoute;
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: "warning", // Menampilkan warning jika ada transaksi yang masih pending
                    title: "Menunggu Persetujuan!",
                    html: error.message || "Anda sudah memiliki transaksi yang masih Menunggu Persetujuan. Harap Segera melakukan pembayaran kepada admin supaya admin dapat segera menyetujui transaksi sebelumnya!",
                    confirmButtonColor: "#007bff"
                });
            })
            .finally(() => {
                loadingIndicator.style.display = "none";
                depositButton.classList.remove("loading");
                depositButton.disabled = false;
                depositButton.textContent = "Tabung Sekarang";
            });        
    });
  
    validateInput();
  });
  