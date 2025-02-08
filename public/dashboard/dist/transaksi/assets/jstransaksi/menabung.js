document.addEventListener("DOMContentLoaded", function () {
  // Ambil elemen yang diperlukan dari DOM
  const amountInput = document.getElementById("amount"); // Input jumlah tabungan
  const depositButton = document.getElementById("tabungButton"); // Tombol "Tabung Sekarang"
  const loadingIndicator = document.getElementById("loadingIndicator"); //untuk loading indicator
  const tabungSemuaButton = document.querySelector(".button-tabung-semua"); // Tombol "Tabung Semua"
  const balanceAmountElement = document.querySelector(".balance-amount"); // Elemen yang menampilkan saldo (misal: "Rp12.345")

  // Ambil saldo user dari elemen balanceAmount, dengan menghapus karakter non-digit
  let availableDeposit = parseInt(
    balanceAmountElement.textContent.replace(/[^\d]/g, ""),
    10
  ) || 0;

  // Fungsi untuk menambahkan pemisah ribuan (titik)
  function formatWithDots(value) {
      return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  // Fungsi validasi: aktifkan tombol jika input berisi angka lebih dari 0 dan tidak melebihi availableDeposit.
  // (Di sini validasi untuk proses transaksi akan dilakukan lagi saat tombol diklik.)
  function validateInput() {
      const depositAmount = parseInt(amountInput.value.replace(/\./g, ""), 10) || 0;
      depositButton.disabled = !(depositAmount > 0);
    }

  // Event listener untuk input: format angka dan validasi
  amountInput.addEventListener("input", function () {
      const value = amountInput.value.replace(/\D/g, ""); // Hanya angka
      amountInput.value = formatWithDots(value);
      validateInput();
  });

  // Event listener untuk tombol "Tabung Semua"
  // Saat tombol ini diklik, kita isi input dengan availableDeposit (format dengan titik)
  if (tabungSemuaButton) {
      tabungSemuaButton.addEventListener("click", function () {
          if (availableDeposit > 0) {
              amountInput.value = availableDeposit.toLocaleString("id-ID");
              validateInput();
          }
      });
  }

  // Event listener untuk tombol "Tabung Sekarang"
  depositButton.addEventListener("click", function (event) {
    event.preventDefault();

    const depositAmount = parseInt(amountInput.value.replace(/\./g, ""), 10);
    let availableDeposit = parseInt(
        document.querySelector(".balance-amount").textContent.replace(/[^\d]/g, ""),
        10
    ) || 0;

    // Cek apakah nilai deposit adalah angka yang valid
    if (isNaN(depositAmount)) {
        Swal.fire("Error!", "Masukkan angka yang valid!", "error");
        return;
    }

    // Validasi minimal menabung 10.000
    if (depositAmount < 10000) {
        Swal.fire("Error!", "Maaf, Minimal menabung sebesar 10.000", "error");
        return;
    }

    // Validasi tidak boleh melebihi saldo yang dapat ditabung
    if (depositAmount > availableDeposit) {
        Swal.fire("Error!", "Maaf, Saldo tidak mencukupi. Jumlah saldo yang anda tabung melebihi jumlah saldo yang dapat ditabung anda", "error");
        return;
    }

    // Tampilkan Loading Indicator overlay dan ubah teks tombol menjadi "Sedang memproses..."
    depositButton.classList.add("loading");
    depositButton.disabled = true;
    depositButton.textContent = "Sedang memproses...";
    loadingIndicator.style.display = "flex";

    // Catat waktu mulai untuk memastikan minimum durasi loading
    const startTime = Date.now();
    const minimumLoadingTime = 2500; // 1000ms per detik

    // Kirim data ke backend
    fetch("/tabung-uang", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify({ jumlah: depositAmount })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire("Berhasil!", data.message, "success").then(() => {
                window.location.reload();
            });
        } else {
            Swal.fire("Error!", data.message, "error");
        }
    })
    .catch(error => {
        Swal.fire("Error!", "Terjadi kesalahan saat memproses!", "error");
    })
    .finally(() => {
        const elapsed = Date.now() - startTime;
        const delay = Math.max(0, minimumLoadingTime - elapsed);
        setTimeout(() => {
            // Hapus overlay loading dan kembalikan tampilan tombol ke kondisi semula
            loadingIndicator.style.display = "none";
            depositButton.classList.remove("loading");
            depositButton.disabled = false;
            depositButton.textContent = "Tabung Sekarang";
        }, delay);
    });
});


document.getElementById("saldoSaatIni").textContent = `Rp ${newSaldo.toLocaleString()}`;

  // Panggil validasi awal
  validateInput();
});
