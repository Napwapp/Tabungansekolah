document.addEventListener('DOMContentLoaded', function () {
  const kontakInputs = document.querySelectorAll('.kontak-input');
  const saveButtons = document.querySelectorAll('.save-button');
  const addButtons = document.querySelectorAll('.add-button');

  // Fungsi menyembunyikan semua tombol
  function hideAllButtons() {
    saveButtons.forEach(btn => btn.style.display = 'none');
    addButtons.forEach(btn => btn.style.display = 'none');
  }

  // Menyembunyikan tombol saat halaman dimuat
  hideAllButtons();

  // Tombol muncul saat input fokus
  kontakInputs.forEach(input => {
    input.addEventListener('focus', function () {
      hideAllButtons();
      const slot = this.getAttribute('data-slot');
      const value = this.value.trim();
      const saveButton = document.querySelector(`.save-button[data-slot="${slot}"]`);
      const addButton = document.querySelector(`.add-button[data-slot="${slot}"]`);

      if (value) {
        saveButton.style.display = 'block';
      } else {
        addButton.style.display = 'block';
      }
    });
  });

  // Event Listener untuk mengosongkan input dan menyembunyikan tombol saat klik di luar
  document.addEventListener('click', function (e) {
    const inputElements = document.querySelectorAll('.kontak-input');
    const buttonElements = document.querySelectorAll('.add-button, .save-button'); // Tombol yang akan disembunyikan

    inputElements.forEach(input => {
      if (input !== e.target) {
        // Kosongkan input jika klik di luar input
        input.value = '';
        const slot = input.getAttribute('data-slot');
        const kontakData = input.getAttribute('value');

        // Tampilkan kembali kontakData jika ada
        if (kontakData) {
          input.value = kontakData;
        } else {
          input.placeholder = 'Belum ada data';
        }

        // Sembunyikan tombol jika klik di luar input
        buttonElements.forEach(button => {
          const slot = button.getAttribute('data-slot');
          if (slot === input.getAttribute('data-slot')) {
            button.style.display = 'none'; // Sembunyikan tombol
          }
        });
      }
    });
  });

  // Fungsi Tambah Kontak
  // Event Listener untuk tombol tambah
  addButtons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const slot = this.getAttribute('data-slot');
      const kontakInput = document.querySelector(`.kontak-input[data-slot="${slot}"]`);
      const nomor = kontakInput.value.trim();

      // Validasi format nomor
      const regex = /^8\d{10,11}$/; // Nomor dimulai dengan 8 dan 10-11 digit
      const isValidNomor = regex.test(nomor);

      if (!isValidNomor) {
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Pastikan format nomor yang Anda masukkan sesuai dan berjumlah 11-12 angka (+62 tidak dihitung). Contoh: 81234567890',
        });
      } else {
        // Cek apakah nomor sudah ada sebelum memanggil addKontak
        checkNomor(nomor).then(exists => {
          if (exists) {
            Swal.fire('Gagal', 'Nomor sudah terdaftar!', 'error');
          } else {
            // Lanjutkan ke fetch penambahan kontak jika nomor tidak terdaftar
            addKontak(slot, nomor);
          }
        }).catch(err => {
          Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
        });
      }
    });
  });

  // Event Listener untuk tombol simpan
  saveButtons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const slot = this.getAttribute('data-slot');
      const kontakInput = document.querySelector(`.kontak-input[data-slot="${slot}"]`);
      const nomor = kontakInput.value.trim();

      // Validasi format nomor
      const regex = /^8\d{10,11}$/; // Pastikan nomor diawali dengan angka 8 dan diikuti 10-11 digit
      const isValidNomor = regex.test(nomor);

      if (!isValidNomor) {
        // Jika format nomor tidak valid, tampilkan pesan kesalahan
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Pastikan format nomor yang Anda masukkan sesuai dan berjumlah 11-12 angka (+62 tidak dihitung). Contoh : 81234567890',
        });

      } else {
        // Jika nomor valid, panggil function addKontak
        updateKontak(slot, nomor);
      }
    });
  });

  function checkNomor(nomor) {
    return fetch('/admin/landing/kontak/cek-nomor', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ nomor })
    })
      .then(response => response.json())
      .then(data => data.exists) // Kembalikan nilai true/false
      .catch(err => {
        console.error('Error:', err);
        throw err;
      });
  }


  // Fungsi Tambah Kontak
  function addKontak(slot, nomor) {
    Swal.fire({
      title: 'Tambah Kontak?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, tambahkan',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        fetch('/admin/landing/kontak/tambah', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ id_informasi_kontak: slot, nomor: nomor })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              const kontakInput = document.querySelector(`.kontak-input[data-slot="${slot}"]`);

              // Update nilai input dan atribut value
              if (kontakInput) {
                kontakInput.value = data.nomor;
                kontakInput.setAttribute('value', data.nomor);
              }
              Swal.fire('Berhasil', data.success, 'success');
              hideAllButtons(); // Sembunyikan tombol setelah input diperbarui
            } else {
              Swal.fire('Gagal', data.error || 'Terjadi kesalahan! Gagal menambahkan kontak', 'error');
            }
          })
          .catch(err => {
            // Menangani jika ada kesalahan pada request
            Swal.fire('Error', 'Terjadi Kesalahan!', 'error').then(() => {
              location.reload(); // Reload hanya jika error fatal
            });
          });
      }
    });
  }

  // Fungsi Update Kontak
  function updateKontak(slot, nomor) {
    Swal.fire({
      title: 'Perbarui Kontak?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, perbarui',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        fetch('/admin/landing/kontak/update', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ id_informasi_kontak: slot, nomor: nomor })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Update langsung value terbaru dan atributnya
              const kontakInput = document.querySelector(`.kontak-input[data-slot="${slot}"]`);

              if (kontakInput) {
                kontakInput.value = data.nomor;
                kontakInput.setAttribute('value', data.nomor);
                hideAllButtons();
              } Swal.fire('Berhasil', data.success, 'success');

            } else {
              Swal.fire('Gagal', data.error || 'Terjadi kesalahan.', 'error');
            }
          })
          .catch(err => {
            // Menangani jika ada kesalahan pada request
            Swal.fire('Error', 'Terjadi Kesalahan! Pastikan Format Nomor Telepon yg anda masukan Benar! Dengan jumlah angka 10-13 dan Pastikan juga kalau nomor yg anda masukan belum terdaftar', 'error').then(() => {
              location.reload();  // Halaman langsung di-refresh setelah OK di klik
            });
          });
      }
    });
  }

  // Form Tambah Kontak Baru
  // Form Tambah Kontak Baru
  const formTambah = document.getElementById('form-tambah-kontak');
  formTambah.addEventListener('submit', function (e) {
    e.preventDefault();
    const nomor = document.getElementById('new-kontak').value.trim();
    
    // Validasi format nomor
    const regex = /^8\d{10,11}$/; // Nomor dimulai dengan 8 dan 10-11 digit
    const isValidNomor = regex.test(nomor);

    if (!isValidNomor) {
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: 'Pastikan format nomor yang Anda masukkan sesuai dan berjumlah 11-12 angka (+62 tidak dihitung). Contoh: 81234567890',
      });
      return; // Hentikan eksekusi jika tidak valid
    }

    // Pastikan nomor valid
    if (nomor) {
      // Cek apakah nomor sudah terdaftar
      checkNomor(nomor).then(exists => {
        if (exists) {
          Swal.fire('Gagal', 'Nomor sudah terdaftar!', 'error');

          formTambah.reset();
        } else {
          // Konfirmasi sebelum proses
          Swal.fire({
            title: 'Konfirmasi',
            text: `Apakah Anda yakin ingin menambahkan nomor ${nomor}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tambahkan!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              fetch(formTambah.action, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ nomor })
              })
                .then(response => response.json())
                .then(data => {
                  if (data.success) {
                    // Cari input dengan slot kosong berdasarkan urutan
                    const emptyInputs = document.querySelectorAll('.kontak-input');
                    let isFilled = false;

                    emptyInputs.forEach(input => {
                      if (input.value === '' && !isFilled) {
                        // Masukkan nomor ke input slot kosong pertama
                        input.value = nomor;
                        input.setAttribute('value', nomor); // Set attribute untuk persistensi

                        // reset form
                        formTambah.reset();
                        isFilled = true; // Tandai bahwa slot sudah diisi
                      }
                    });

                    if (isFilled) {
                      Swal.fire('Berhasil', data.success, 'success');
                    } else {
                      Swal.fire('Info', 'Semua slot sudah terisi.', 'info');
                    }
                  } else {
                    Swal.fire('Gagal', data.error || 'Terjadi kesalahan! Pastikan nomor yang Anda masukkan benar dan belum terdaftar.', 'error');
                  }
                  formTambah.reset();
                })
                .catch(err => {
                  // Menangani jika ada kesalahan pada request
                  Swal.fire('Error', 'Terjadi Kesalahan! Pastikan nomor yang Anda masukkan benar dan belum terdaftar.', 'error').then(() => {
                    location.reload();  // Halaman langsung di-refresh setelah OK di klik
                  });
                });
            }
          });
        }
      }).catch(err => {
        Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
      });
    }
  });
})