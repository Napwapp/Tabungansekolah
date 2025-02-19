document.addEventListener("DOMContentLoaded", function() {
    // Ambil elemen filter berdasarkan tipe dan status transaksi
    const filterTipeElem = document.getElementById("filterTipe");
    const filterStatusElem = document.getElementById("filterStatus");

    // Inisialisasi dropdown filter menggunakan library Choices.js
    const filterTipeChoices = new Choices(filterTipeElem, {
        searchEnabled: false,  // Nonaktifkan pencarian dalam dropdown
        itemSelectText: '',  // Hapus teks default saat memilih item
        shouldSort: false  // Pastikan urutan asli dipertahankan
    });

    const filterStatusChoices = new Choices(filterStatusElem, {
        searchEnabled: false,
        itemSelectText: '',
        shouldSort: false
    });

    // Ambil semua baris transaksi dalam tabel
    const tableRows = document.querySelectorAll("#riwayatTable tbody tr");

    function filterTable() {
        // Ambil nilai filter yang dipilih user
        const tipeValue = filterTipeElem.value.toLowerCase();
        const statusValue = filterStatusElem.value.toLowerCase();

        // Looping untuk memeriksa setiap baris transaksi
        tableRows.forEach(row => {
            if (row.id === "noResultsRow") return; // Lewati baris khusus (jika tidak ada hasil)

            // Ambil teks tipe transaksi dari kolom ke-4 (index 3)
            const tipe = row.children[3].textContent.toLowerCase();
            // Ambil teks status transaksi dari kolom ke-6 (index 5)
            let status = row.children[5].textContent.toLowerCase();

            // Jika status adalah "Menunggu Persetujuan", ubah menjadi "diproses"
            if (status === "menunggu persetujuan") {
                status = "diproses";
            }

            // Cek apakah baris ini sesuai dengan filter yang dipilih user
            if ((tipeValue === "" || tipe.includes(tipeValue)) &&
                (statusValue === "" || status.includes(statusValue))) {
                row.style.display = ""; // Tampilkan baris jika sesuai filter
            } else {
                row.style.display = "none"; // Sembunyikan jika tidak sesuai filter
            }
        });

        // Cek apakah ada transaksi yang masih terlihat setelah difilter
        let visibleCount = 0;
        tableRows.forEach(row => {
            if (row.id !== "noResultsRow" && row.style.display !== "none") {
                visibleCount++;
            }
        });

        // Tampilkan atau sembunyikan baris "Tidak ada hasil" jika semua transaksi disembunyikan
        const noResultsRow = document.getElementById("noResultsRow");
        if (noResultsRow) {
            noResultsRow.style.display = visibleCount === 0 ? "" : "none";
        }
    }

    // Tambahkan event listener untuk filter tipe dan status
    filterTipeElem.addEventListener("change", filterTable);
    filterStatusElem.addEventListener("change", filterTable);

    // Event listener untuk tombol hapus transaksi
    document.addEventListener("click", function(event) {
        if (event.target.closest(".delete-btn")) {
            event.preventDefault(); // Mencegah navigasi default dari <a> tag

            // Ambil tombol yang diklik
            const button = event.target.closest(".delete-btn");

            // Ambil ID transaksi dan tipe transaksi dari atribut tombol
            const transaksiId = button.getAttribute("data-id");
            const transaksiTipe = button.getAttribute("data-tipe");

            // Ambil baris transaksi yang akan dihapus
            const row = button.closest("tr");

            // Ambil CSRF token
            const csrfTokenElem = document.querySelector('meta[name="csrf-token"]');
            if (!csrfTokenElem) {
                alert("CSRF token tidak ditemukan! Pastikan meta tag CSRF ada di Blade.");
                return;
            }
            const csrfToken = csrfTokenElem.getAttribute("content");

            // Konfirmasi sebelum menghapus transaksi
            if (confirm("Apakah Anda yakin ingin menghapus riwayat transaksi ini?")) {
                // Langsung hapus baris dari tampilan
                row.remove();

                // Kirim permintaan ke server menggunakan Fetch API
                fetch(`/riwayat/hapus/${transaksiTipe}/${transaksiId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Jika berhasil, refresh halaman setelah sedikit delay
                        setTimeout(() => {
                            location.reload();
                        }); // Delay 500ms agar terlihat smooth
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            }
        }
    });
}); 
