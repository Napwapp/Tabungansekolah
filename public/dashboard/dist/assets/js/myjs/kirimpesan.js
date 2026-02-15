document.addEventListener("DOMContentLoaded", function () {
    const kategori = document.getElementById("kategori");
    const jenisLaporanDiv = document.getElementById("jenisLaporanDiv");
    const jenisLaporan = document.getElementById("jenisLaporan");
    const judulLabel = document.getElementById("judulLabel");
    const judul = document.getElementById("judul");
    const reportForm = document.getElementById("reportForm");
    const deskripsi = document.getElementById("deskripsi"); // kalau kamu punya textarea untuk isi laporan/saran

    function updateForm() {
        // Reset semua field kecuali kategori
        judul.value = "";    
        if (deskripsi) deskripsi.value = "";   

        if (kategori.value === "laporan") {
            jenisLaporanDiv.classList.remove("hidden");
            judulLabel.textContent = "Masalah";
            judul.placeholder = "Masukkan masalah...";
        } else {
            jenisLaporanDiv.classList.add("hidden");
            judulLabel.textContent = "Masukan Saran";
            judul.placeholder = "Masukkan saranmu...";
        }
    }

    const savedKategori = localStorage.getItem("selectedKategori");
    if (savedKategori) {
        kategori.value = savedKategori;
    }

    updateForm();

    kategori.addEventListener("change", function () {
        updateForm();
        localStorage.setItem("selectedKategori", kategori.value);
    });

    let lastSelectedJenisLaporan = ""; // simpan pilihan terakhir selain "Lainnya"

    // Saat user memilih dari dropdown jenisLaporan
    jenisLaporan.addEventListener("change", function () {
        if (kategori.value === "laporan") {
            if (jenisLaporan.value && jenisLaporan.value !== "Lainnya") {
                judul.value = jenisLaporan.value;
                lastSelectedJenisLaporan = jenisLaporan.value;
            } else {
                judul.value = "";
                lastSelectedJenisLaporan = "";
            }
        }
    });

    // Saat user mengedit input judul
    judul.addEventListener("input", function () {
        if (kategori.value === "laporan") {
            // Jika sebelumnya sudah ada jenisLaporan yang dipilih (bukan "Lainnya")
            if (lastSelectedJenisLaporan) {
                if (judul.value !== lastSelectedJenisLaporan) {
                    jenisLaporan.value = "Lainnya";
                } else {
                    jenisLaporan.value = lastSelectedJenisLaporan;
                }
            }
        }
    });


    reportForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const currentKategori = kategori.value === "saran" ? "Saran" : "Laporan";

        Swal.fire({
            title: `Kirim ${currentKategori}?`,
            text: `Pastikan ${currentKategori.toLowerCase()} sudah benar sebelum dikirim.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Kirim!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user menekan "Ya, Kirim!"
                const formData = new FormData(reportForm);

                fetch(reportForm.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: `${currentKategori} berhasil dikirim.`,
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                reportForm.reset();

                                const savedKategori = localStorage.getItem("selectedKategori");
                                if (savedKategori) {
                                    kategori.value = savedKategori;
                                    updateForm(); // panggil kembali untuk sesuaikan tampilan
                                }

                                // Tambahkan 1 ke badge notifikasi
                                let badgeNotif = document.querySelector('.sidebar-link[data-target="contact"] .badge-notif h2');
                                if (badgeNotif) {
                                    let currentCount = parseInt(badgeNotif.textContent) || 0;
                                    badgeNotif.textContent = currentCount + 1;
                                } else {
                                    let sidebarLink = document.querySelector('.sidebar-link[data-target="contact"]');
                                    if (sidebarLink) {
                                        let newBadge = document.createElement("span");
                                        newBadge.classList.add("badge-notif");

                                        let badgeText = document.createElement("h2");
                                        badgeText.id = "badge-count";
                                        badgeText.textContent = "1";

                                        newBadge.appendChild(badgeText);
                                        sidebarLink.appendChild(newBadge);
                                    }
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: data.message || `Terjadi kesalahan saat mengirim ${currentKategori.toLowerCase()}.`,
                                icon: "error",
                                confirmButtonText: "Coba Lagi"
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: "Error!",
                            text: `Terjadi kesalahan pada server saat mengirim ${currentKategori.toLowerCase()}.`,
                            icon: "error",
                            confirmButtonText: "Coba Lagi"
                        });
                        console.error("Error:", error);
                    });
            }
        });
    });


});
