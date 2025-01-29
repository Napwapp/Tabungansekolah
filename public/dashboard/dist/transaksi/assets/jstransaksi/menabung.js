document.addEventListener("DOMContentLoaded", function () {
    const amountInput = document.getElementById("amount");
    const submitButton = document.querySelector(".submit-button");
  
    amountInput.addEventListener("input", function () {
      const value = amountInput.value.replace(/\D/g, ""); // Hanya angka
      amountInput.value = formatWithDots(value); // Format angka
      submitButton.disabled = value === "" || parseInt(value, 10) < 10000; // Tombol aktif jika nominal valid
    });
  
    function formatWithDots(value) {
      return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
  });

  // Saldo awal user (contoh nilai, bisa diambil dari database/backend jika ada)
  let userBalance = 1000000;

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
    const depositAmount = parseInt(depositInput.value, 10);

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

  // jika user menekan tombol tabung semua 
  const tabungSemuaButton = document.querySelector('.button-tabung-semua');

  tabungSemuaButton.addEventListener('click', function () {
    const minRemainingBalance = 10000;
    const maxDepositable = Math.max(0, userBalance - minRemainingBalance);

    depositInput.value = maxDepositable; // Isi input dengan saldo maksimum yang bisa ditabung
  });

  // logika input untuk aktif nonaktifnya
  document.addEventListener("DOMContentLoaded", () => {
    const inputField = document.getElementById("amount"); // Elemen input
    const depositButton = document.querySelector(".deposit-button"); // Tombol Tabung Sekarang
  
    // Fungsi untuk memvalidasi input
    function toggleButtonState() {
      const inputValue = inputField.value.trim(); // Ambil nilai input
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
  
  document.addEventListener("DOMContentLoaded", () => {
    const inputField = document.getElementById("amount"); // Elemen input
    const depositButton = document.querySelector(".deposit-button"); // Tombol Tabung Sekarang
    const tabungSemuaButton = document.querySelector(".button-tabung-semua"); // Tombol Tabung Semua
    const saldoTersedia = 990000; // Misalkan saldo yang tersedia adalah 990.000
  
    // Fungsi untuk memvalidasi input
    function toggleButtonState() {
      const inputValue = inputField.value.trim(); // Ambil nilai input
      if (inputValue && !isNaN(inputValue.replace(/\./g, "")) && parseInt(inputValue.replace(/\./g, "")) > 0) {
        depositButton.disabled = false; // Aktifkan tombol
      } else {
        depositButton.disabled = true; // Nonaktifkan tombol
      }
    }
  
    // Fungsi untuk memformat angka dengan tanda titik
    function formatNumber(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
  
    // Fungsi untuk menangani klik pada tombol Tabung Semua
    tabungSemuaButton.addEventListener("click", () => {
      inputField.value = formatNumber(saldoTersedia); // Format angka dan masukkan ke input
      toggleButtonState(); // Panggil validasi agar tombol Tabung Sekarang aktif
    });
  
    // Tambahkan event listener ke input
    inputField.addEventListener("input", () => {
      let value = inputField.value.replace(/\./g, ""); // Hapus titik sebelum validasi
      if (!isNaN(value) && value !== "") {
        inputField.value = formatNumber(value); // Format ulang input dengan tanda titik
      }
      toggleButtonState(); // Validasi tombol
    });
  
    // Nonaktifkan tombol saat awal
    depositButton.disabled = true;
  });
    
