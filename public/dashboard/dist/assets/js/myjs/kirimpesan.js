document.addEventListener("DOMContentLoaded", function () {
    const kategori = document.getElementById("kategori");
    const jenisLaporanDiv = document.getElementById("jenisLaporanDiv");
    const jenisLaporan = document.getElementById("jenisLaporan");
    const judulLabel = document.getElementById("judulLabel");
    const judul = document.getElementById("judul");
    const reportForm = document.getElementById("reportForm");

    function updateForm() {
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

    jenisLaporan.addEventListener("change", function () {
        if (kategori.value === "laporan") {
            judul.value = jenisLaporan.value && jenisLaporan.value !== "Lainnya" ? jenisLaporan.value : "";
        }
    });

    reportForm.addEventListener("submit", function (event) {
        event.preventDefault();

        Swal.fire({
            title: "Kirim Laporan?",
            text: "Pastikan laporan atau saran sudah benar sebelum dikirim.",
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
                                text: "Laporan atau saran berhasil dikirim.",
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                reportForm.reset();
                                localStorage.removeItem("selectedKategori");

                                // **Cari elemen badge notifikasi di sidebar untuk pesan**
                                let badgeNotif = document.querySelector('.sidebar-link[data-target="contact"] .badge-notif h2');

                                if (badgeNotif) {
                                    // Jika badge sudah ada, tambahkan 1
                                    let currentCount = parseInt(badgeNotif.textContent) || 0;
                                    badgeNotif.textContent = currentCount + 1; // Tambah 1 ke badge
                                } else {
                                    // Jika badge belum ada, buat elemen baru
                                    let sidebarLink = document.querySelector('.sidebar-link[data-target="contact"]');

                                    if (sidebarLink) {
                                        let newBadge = document.createElement("span");
                                        newBadge.classList.add("badge-notif");

                                        let badgeText = document.createElement("h2");
                                        badgeText.id = "badge-count"; // Pastikan id sesuai dengan Blade
                                        badgeText.textContent = "1"; // Set angka awal

                                        newBadge.appendChild(badgeText);
                                        sidebarLink.appendChild(newBadge);
                                    }
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: data.message || "Terjadi kesalahan saat mengirim laporan.",
                                icon: "error",
                                confirmButtonText: "Coba Lagi"
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: "Error!",
                            text: "Terjadi kesalahan pada server.",
                            icon: "error",
                            confirmButtonText: "Coba Lagi"
                        });
                        console.error("Error:", error);
                    });
            }
        });
    });

    
});
