document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".aksi-item").forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            let form = this.closest("form");
            let url = form.action;
            // Tentukan status berdasarkan URL (jika URL mengandung "Sukses", status = "Sukses", jika tidak, "Gagal")
            let status = url.includes("Sukses") ? "Sukses" : "Gagal";
            let aksi = status === "Sukses" ? "menyetujui" : "menolak";

            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda yakin ingin " + aksi + " transaksi ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, " + aksi + "!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gunakan FormData untuk mengambil semua data form termasuk hidden field
                    let formData = new FormData(form);
                    // Kirim AJAX request
                    fetch(url, {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Berhasil!", data.message, "success").then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Gagal!", data.message, "error");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire("Error!", "Terjadi kesalahan pada server!", "error");
                    });
                }
            });
        });
    });
});

// Ambil elemen
// const tableBody = document.querySelector("#riwayatTable tbody");
// const searchInput = document.getElementById("searchInput");
// const filterJenis = document.getElementById("filterJenis");
// const filterTanggal = document.getElementById("filterTanggal");
// const rowsPerPageSelect = document.getElementById("rowsPerPage");
// const paginationControls = document.getElementById("paginationControls");
// const rowsPerPageContainer = document.getElementById("rowsPerPageContainer");
// const dataCountText = document.getElementById("dataCountText");
// const prevButton = document.getElementById("prevPage");
// const nextButton = document.getElementById("nextPage");
// const currentPageSpan = document.getElementById("currentPage");

// let currentPage = 1;
// let rowsPerPage = parseInt(rowsPerPageSelect.value);

// function filterRows() {
//     const keyword = searchInput.value.toLowerCase();
//     const jenis = filterJenis.value;
//     const tanggal = filterTanggal.value;

//     return Array.from(tableBody.querySelectorAll("tr")).filter(row => {
//         const nama = row.cells[1]?.textContent.toLowerCase() || "";
//         const jenisTransaksi = row.cells[4]?.textContent || "";
//         const tanggalTransaksi = row.cells[7]?.textContent || "";

//         const cocokNama = nama.includes(keyword);
//         const cocokJenis = jenis === "all" || jenisTransaksi === jenis;
//         const cocokTanggal = tanggal === "" || tanggalTransaksi === tanggal;

//         return cocokNama && cocokJenis && cocokTanggal;
//     });
// }

// function displayRows() {
//     const filtered = filterRows();
//     const total = filtered.length;
//     const isSearchActive = searchInput.value.trim() !== "";

//     tableBody.querySelectorAll("tr").forEach(row => row.style.display = "none");

//     if (total === 0) {
//         dataCountText.textContent = "Tidak dapat menemukan data.";
//         return;
//     }

//     let start = (currentPage - 1) * rowsPerPage;
//     let end = start + rowsPerPage;

//     if (rowsPerPage === -1 || isSearchActive) {
//         start = 0;
//         end = total;
//     }

//     filtered.slice(start, end).forEach(row => row.style.display = "");

//     // Update teks jumlah
//     if (isSearchActive) {
//         dataCountText.textContent = "";
//     } else {
//         const from = total === 0 ? 0 : start + 1;
//         const to = end > total ? total : end;
//         dataCountText.textContent = `Menampilkan ${from} sampai ${to} dari ${total} data`;
//     }

//     // Update tombol halaman
//     const totalPages = Math.ceil(total / rowsPerPage);
//     currentPageSpan.textContent = `Halaman ${currentPage}`;
//     prevButton.disabled = currentPage === 1;
//     nextButton.disabled = currentPage === totalPages;

//     // Tampilkan/Hide pagination
//     paginationControls.classList.toggle("d-none", isSearchActive);
//     rowsPerPageContainer.classList.toggle("d-none", isSearchActive);
// }

// searchInput.addEventListener("input", () => {
//     currentPage = 1;
//     displayRows();
// });

// filterJenis.addEventListener("change", () => {
//     currentPage = 1;
//     displayRows();
// });

// filterTanggal.addEventListener("change", () => {
//     currentPage = 1;
//     displayRows();
// });

// rowsPerPageSelect.addEventListener("change", () => {
//     rowsPerPage = rowsPerPageSelect.value === "all" ? -1 : parseInt(rowsPerPageSelect.value);
//     currentPage = 1;
//     displayRows();
// });

// prevButton.addEventListener("click", () => {
//     if (currentPage > 1) {
//         currentPage--;
//         displayRows();
//     }
// });

// nextButton.addEventListener("click", () => {
//     const total = filterRows().length;
//     const totalPages = Math.ceil(total / rowsPerPage);
//     if (currentPage < totalPages) {
//         currentPage++;
//         displayRows();
//     }
// });

// displayRows();
