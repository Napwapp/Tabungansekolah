document.addEventListener("DOMContentLoaded", function () {
    const filterTipeElem = document.getElementById("filterTipe");
    const filterStatusElem = document.getElementById("filterStatus");

    // Inisialisasi Choices.js (dropdown tidak perlu sorting & search)
    const filterTipeChoices = new Choices(filterTipeElem, {
        searchEnabled: false,
        itemSelectText: '',
        shouldSort: false
    });

    const filterStatusChoices = new Choices(filterStatusElem, {
        searchEnabled: false,
        itemSelectText: '',
        shouldSort: false
    });

    const tbody = document.getElementById("transaksiBody");
    const noResultsRow = document.getElementById("noResultsRow");
    const rowsPerPageSelect = document.getElementById("rowsPerPage");
    const paginationPrev = document.getElementById("paginationPrev");
    const paginationNext = document.getElementById("paginationNext");
    const paginationInfo = document.getElementById("paginationInfo");
    const pageDropdownWrapper = document.getElementById("pageDropdownWrapper");

    let allRows = Array.from(tbody.querySelectorAll("tr:not(#noResultsRow)"));
    let currentPage = 1;
    let rowsPerPage = parseInt(rowsPerPageSelect.value);


    pageDropdownWrapper.id = "pageDropdownWrapper";
    pageDropdownWrapper.style.padding = "3px 8px";
    pageDropdownWrapper.style.fontSize = "14px";
    pageDropdownWrapper.disabled = true; // disable dropdown agar hanya tampil, bukan interaktif

    rowsPerPageSelect.addEventListener("change", () => {
        currentPage = 1;
        renderPagination();
    });

    filterTipeElem.addEventListener("change", () => {
        currentPage = 1;
        renderPagination();
    });

    filterStatusElem.addEventListener("change", () => {
        currentPage = 1;
        renderPagination();
    });

    function getFilteredRows() {
        const tipeValue = filterTipeElem.value.toLowerCase();
        const statusValue = filterStatusElem.value.toLowerCase();

        return allRows.filter(row => {
            const tipe = row.children[3].textContent.toLowerCase();
            const status = row.children[6].textContent.toLowerCase();

            const tipeMatch = !tipeValue || tipe.includes(tipeValue);
            const statusMatch = !statusValue || status.includes(statusValue);

            return tipeMatch && statusMatch;
        });
    }

    function renderPagination() {
        paginationPrev.innerHTML = '';
        paginationNext.innerHTML = '';
        paginationInfo.textContent = '';
        pageDropdownWrapper.innerHTML = '';

        let filteredRows = getFilteredRows();
        const totalRows = filteredRows.length;
        const selected = rowsPerPageSelect.value;
        rowsPerPage = selected === 'all' ? totalRows : parseInt(selected);
        const totalPages = selected === 'all' ? 1 : Math.ceil(totalRows / rowsPerPage);

        if (currentPage > totalPages) currentPage = totalPages;

        allRows.forEach(row => row.style.display = "none");

        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = selected === 'all' ? totalRows : Math.min(startIndex + rowsPerPage, totalRows);

        filteredRows.slice(startIndex, endIndex).forEach(row => {
            row.style.display = "";
        });

        noResultsRow.style.display = filteredRows.length === 0 ? "" : "none";

        const paginationContainer = document.getElementById("paginationContainer");
        if (filteredRows.length === 0 || totalRows <= rowsPerPage) {
            paginationContainer.style.display = "none";
        } else {
            paginationContainer.style.display = "flex";
        }

        if (selected === 'all' || totalRows <= rowsPerPage) return;

        const createBtn = (label, callback, parent, disabled = false) => {
            const btn = document.createElement("button");
            btn.textContent = label;
            btn.className = "pagination-btn";
            if (disabled) {
                btn.disabled = true;
                btn.classList.add("disabled");
            }
            btn.addEventListener("click", callback);
            parent.appendChild(btn);
        };

        if (currentPage > 1) {
            createBtn("<<", () => { currentPage = 1; renderPagination(); }, paginationPrev);
            createBtn("<", () => { currentPage--; renderPagination(); }, paginationPrev);
        }

        if (currentPage < totalPages) {
            createBtn(">", () => { currentPage++; renderPagination(); }, paginationNext);
            createBtn(">>", () => { currentPage = totalPages; renderPagination(); }, paginationNext);
        }

        // Hanya tampilkan halaman aktif di dalam dropdown (tanpa interaksi)
        const option = document.createElement("option");
        option.value = currentPage;
        option.textContent = `${currentPage}`;
        option.selected = true;
        pageDropdownWrapper.appendChild(option);

        paginationInfo.textContent = `Menampilkan ${startIndex + 1}–${endIndex} dari ${totalRows} data`;
    }

    // Tombol hapus
    document.addEventListener("click", function (event) {
        if (event.target.closest(".delete-btn")) {
            event.preventDefault();
            const button = event.target.closest(".delete-btn");
            const transaksiId = button.getAttribute("data-id");
            const transaksiTipe = button.getAttribute("data-tipe");
            const row = button.closest("tr");

            const csrfTokenElem = document.querySelector('meta[name="csrf-token"]');
            if (!csrfTokenElem) {
                Swal.fire("Gagal", "CSRF token tidak ditemukan!", "error");
                return;
            }
            const csrfToken = csrfTokenElem.getAttribute("content");

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Riwayat transaksi akan dihapus secara permanen.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
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
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil!",
                                    text: "Riwayat berhasil dihapus.",
                                    confirmButtonText: "Ok", 
                                    showConfirmButton: true 
                                }).then(() => {
                                    location.reload(); // reload setelah Swal selesai
                                });
                            } else {
                                Swal.fire("Gagal", data.message || "Terjadi kesalahan saat menghapus transaksi.", "error");
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire("Gagal", "Terjadi kesalahan pada server.", "error");
                        });
                }
            });
        }
    });


    renderPagination();
});
