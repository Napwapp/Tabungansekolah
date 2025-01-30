  function switchTab(tabId) {
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => tab.classList.remove('active'));
    contents.forEach(content => content.style.display = 'none');

    document.querySelector(`#${tabId}`).style.display = 'block';
    document.querySelector(`.tab-nav .tab[onclick="switchTab('${tabId}')"]`).classList.add('active');
  }

  document.querySelector('.pay-btn').addEventListener('click', function() {
    const button = this;
    const loadingIndicator = document.getElementById('loading-indicator');

    // Disable button and show loading indicator
    button.disabled = true;
    loadingIndicator.style.display = 'block';

    // Simulate payment process
    setTimeout(() => {
      button.disabled = false;
      loadingIndicator.style.display = 'none';
      alert('Pembayaran selesai!');
    }, 2000);
  });

  // Mendapatkan semua elemen dengan kelas nominal-card
  const nominalCards = document.querySelectorAll('.nominal-card');
  // Mendapatkan elemen input untuk isi nominal
  const customAmountInput = document.getElementById('customAmount');

  // Fungsi untuk memformat angka dengan titik setiap tiga digit
  function formatNumberWithDots(value) {
    // Hilangkan semua titik yang ada sebelumnya
    const rawValue = value.replace(/\./g, '');
    // Pastikan nilai hanya berisi angka
    const numericValue = rawValue.replace(/[^0-9]/g, '');
    // Tambahkan format titik setiap tiga digit
    return numericValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  // Fungsi untuk memperbarui tombol bayar
  function togglePayButton() {
    const payButton = document.querySelector('.pay-btn');
    // Aktifkan tombol jika input tidak kosong
    if (customAmountInput.value.trim() !== '') {
      payButton.disabled = false;
      payButton.classList.add('active');
    } else {
      payButton.disabled = true;
      payButton.classList.remove('active');
    }
  }

    nominalCards.forEach((card) => {
      // Tambahkan kelas 'initialized' di awal untuk mencegah animasi ganda
      card.classList.add("initialized");
    
      card.addEventListener("click", function () {
        const isActive = this.classList.contains("selected");
    
        if (isActive) {
          // Jika kartu aktif, nonaktifkan
          this.classList.remove("selected");
          this.style.animation = "none";
          void this.offsetWidth; // Trigger reflow
          this.style.animation = "nominal-card 0.2s ease-out";
          this.style.border = "2px solid rgba(88, 85, 85, 0.4)";
          this.style.backgroundColor = "#ffffff";
          customAmountInput.value = "";
        } else {
          // Nonaktifkan semua kartu lain
          nominalCards.forEach((otherCard) => {
            if (otherCard !== this && otherCard.classList.contains("selected")) {
              otherCard.classList.remove("selected");
              otherCard.style.animation = "none";
              void otherCard.offsetWidth;
              otherCard.style.animation = "nominal-card 0.2s ease-out";
              otherCard.style.border = "2px solid rgba(88, 85, 85, 0.4)";
              otherCard.style.backgroundColor = "#ffffff";
            }
          });
        
          
          // Aktifkan kartu yang diklik
          this.classList.add("selected");
          if (!this.classList.contains("initialized")) {
            this.style.animation = "none";
            void this.offsetWidth; // Trigger reflow
            this.style.animation = "nominal-card 0.2s ease-out";
          }
          this.classList.add("initialized"); // Tandai bahwa kartu sudah dirender
          this.style.border = "2px solid #007bff";
          this.style.backgroundColor = "#e8f4ff";
    
          const nominalValue = this
            .querySelector(".amount")
            .textContent.replace(/\./g, "");
          customAmountInput.value = formatNumberWithDots(nominalValue);
        }
    
        togglePayButton();
      });
    });
      
    
  
  // Menambahkan event listener untuk input manual pada custom nominal
  customAmountInput.addEventListener('input', function (e) {
    // Simpan posisi kursor sebelum manipulasi
    const cursorPosition = e.target.selectionStart;

    // Format ulang nilai input dengan titik
    const rawValue = e.target.value.replace(/\./g, '');
    const formattedValue = formatNumberWithDots(rawValue);
    e.target.value = formattedValue;

    // Kembalikan posisi kursor setelah format ulang
    const diff = e.target.value.length - rawValue.length;
    e.target.setSelectionRange(cursorPosition + diff, cursorPosition + diff);
  });

  // Fungsi untuk validasi dan memastikan angka tidak terbatasi
  customAmountInput.addEventListener('change', function () {
    // Hilangkan format titik untuk validasi angka mentah
    const rawValue = this.value.replace(/\./g, '');
    if (isNaN(rawValue) || rawValue === '' || parseInt(rawValue) < 0) {
      alert('Masukkan angka yang valid.');
      this.value = '';
    }
  });
