// Menunggu hingga halaman sepenuhnya dimuat sebelum menjalankan skrip
document.addEventListener("DOMContentLoaded", function () {
  const amountInput = document.getElementById("amount"); // Input jumlah tabungan
  const submitButton = document.querySelector(".submit-button"); // Tombol submit tabungan

  // Event listener untuk format angka dan validasi input
  amountInput.addEventListener("input", function () {
    const value = amountInput.value.replace(/\D/g, ""); // Hanya angka
    amountInput.value = formatWithDots(value); // Format angka dengan pemisah ribuan
    submitButton.disabled = value === "" || parseInt(value, 10) < 10000; // Tombol aktif jika nominal valid
  });

  // Fungsi untuk menambahkan pemisah ribuan pada angka
  function formatWithDots(value) {
    return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }
});

// Saldo awal user (contoh nilai, bisa diambil dari database/backend jika ada)
let userBalance = 0;

// Elemen DOM
const balanceAmountElement = document.querySelector('.balance-amount'); // Elemen saldo yang dapat ditabung
const depositInput = document.getElementById('amount'); // Input jumlah saldo yang ingin ditabung
const depositButton = document.querySelector('.deposit-button'); // Tombol 'Tabung Sekarang'

// Fungsi untuk memperbarui jumlah saldo yang dapat ditabung
function updateBalanceInfo() {
  const minRemainingBalance = 10000; // Sisa saldo minimum yang harus ada

  // Hitung saldo yang dapat ditabung
  let maxDepositable = userBalance - minRemainingBalance;

  // Jika saldo kurang dari minimum yang disyaratkan, atur jumlah yang dapat ditabung ke 0
  if (maxDepositable < 0) {
    maxDepositable = 0;
  }

  // Perbarui tampilan saldo yang dapat ditabung
  balanceAmountElement.textContent = `Rp${maxDepositable.toLocaleString('id-ID')}`;
}

// Event listener untuk tombol 'Tabung Sekarang'
depositButton.addEventListener('click', function () {
  const depositAmount = parseInt(depositInput.value.replace(/\./g, ""), 10); // Ambil angka tanpa titik

  if (isNaN(depositAmount) || depositAmount <= 0) {
    alert('Masukkan jumlah saldo yang valid untuk ditabung!');
    return;
  }

  if (depositAmount > userBalance - 10000) {
    alert('Saldo tidak mencukupi. Anda harus menyisakan Rp10.000.');
    return;
  }

  // Kurangi saldo user
  userBalance -= depositAmount;

  // Perbarui info saldo
  updateBalanceInfo();

  // Kosongkan input dan berikan konfirmasi
  depositInput.value = '';
  alert('Saldo berhasil ditabung!');
});

// Perbarui info saldo di awal
updateBalanceInfo();

// Jika user menekan tombol tabung semua
const tabungSemuaButton = document.querySelector('.button-tabung-semua');

tabungSemuaButton.addEventListener('click', function () {
  const minRemainingBalance = 10000; // Saldo minimal yang harus disisakan
  const maxDepositable = Math.max(0, userBalance - minRemainingBalance); // Hitung saldo yang dapat ditabung

  depositInput.value = formatWithDots(maxDepositable.toString()); // Isi input dengan saldo maksimum yang bisa ditabung dengan format angka
});

// Logika input untuk aktif/nonaktif tombol
document.addEventListener("DOMContentLoaded", () => {
  const inputField = document.getElementById("amount"); // Elemen input
  const depositButton = document.querySelector(".deposit-button"); // Tombol Tabung Sekarang

  // Fungsi untuk memvalidasi input
  function toggleButtonState() {
    const inputValue = inputField.value.trim().replace(/\./g, ""); // Ambil nilai input tanpa titik
    if (inputValue && !isNaN(inputValue) && parseInt(inputValue) > 0) {
      depositButton.disabled = false; // Aktifkan tombol
    } else {
      depositButton.disabled = true; // Nonaktifkan tombol
    }
  }

  // Tambahkan event listener ke input
  inputField.addEventListener("input", toggleButtonState);

  // Nonaktifkan tombol saat awal
  depositButton.disabled = true;
});

// Event listener untuk tombol + dan -
document.addEventListener("DOMContentLoaded", function () {
  const amountInput = document.getElementById("amount"); // Input nominal
  const depositButton = document.querySelector(".deposit-button"); // Tombol Tabung Sekarang
  const increaseButton = document.createElement("button"); // Tombol tambah (+)
  const decreaseButton = document.createElement("button"); // Tombol kurang (-)

  // Menambahkan tombol ke dalam DOM
  amountInput.parentNode.appendChild(increaseButton);
  amountInput.parentNode.appendChild(decreaseButton);

  // Fungsi untuk memperbarui status tombol
  function updateButtonState() {
      if (amountInput.value.trim() === "") {
          depositButton.classList.add("disabled"); // Tombol dinonaktifkan
          depositButton.disabled = true;
      } else {
          depositButton.classList.remove("disabled"); // Tombol diaktifkan
          depositButton.disabled = false;
      }
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
      amountInput.value = formatWithDots(rawValue);
      updateButtonState();
  });

  // Inisialisasi status tombol saat halaman dimuat
  updateButtonState();
});
