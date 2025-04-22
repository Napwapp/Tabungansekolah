document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById("transaksiBody");
    const rowsPerPageSelect = document.getElementById("rowsPerPage");
    const transactionTypeSelect = document.getElementById("transactionType");

    const prevBtn = document.getElementById("prevPage");
    const nextBtn = document.getElementById("nextPage");
    const firstBtn = document.getElementById("firstPage");
    const lastBtn = document.getElementById("lastPage");
    const currentPageSpan = document.getElementById("currentPage");

    const searchInput = document.getElementById('searchInput');

    const rowsPerPageContainer = document.getElementById("rowsPerPageContainer");
    const paginationControls = document.getElementById("paginationControls");

    let currentPage = 1;
    let rowsPerPage = parseInt(rowsPerPageSelect.value);

    function getFilteredRows() {
        const selectedType = transactionTypeSelect.value;
        const filter = searchInput.value.toLowerCase();

        return Array.from(tableBody.querySelectorAll("tr.transaksi-row")).filter(row => {
            const cells = row.getElementsByTagName("td");
            const nis = cells[0]?.textContent.toLowerCase() || '';
            const nama = cells[1]?.textContent.toLowerCase() || '';
            const matchSearch = nis.includes(filter) || nama.includes(filter);
            const matchFilter = selectedType === "" || row.classList.contains(selectedType);

            return matchSearch && matchFilter;
        });
    }

    function displayRows() {
        const filteredRows = getFilteredRows();
        const totalRows = filteredRows.length;
        const totalPages = rowsPerPage === "all" ? 1 : Math.ceil(totalRows / rowsPerPage);
    
        const isSearchActive = searchInput.value.trim() !== "";
    
        // Sembunyikan semua baris
        Array.from(tableBody.querySelectorAll("tr.transaksi-row")).forEach(row => {
            row.style.display = "none";
        });
    
        // Sembunyikan pesan
        const notFoundRow = document.getElementById("notFoundRow");
        if (notFoundRow) notFoundRow.style.display = "none";
    
        const noDataRow = document.getElementById("noDataRow");
        if (noDataRow) noDataRow.style.display = "none";
    
        if (filteredRows.length === 0) {
            if (notFoundRow) notFoundRow.style.display = "";
        } else {
            if (isSearchActive || rowsPerPage === "all") {
                filteredRows.forEach(row => row.style.display = "");
            } else {
                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                filteredRows.slice(start, end).forEach(row => {
                    row.style.display = "";
                });
            }
        }
    
        // Update kontrol
        currentPageSpan.textContent = `Page ${currentPage}`;
        updateButtons(totalPages);
    
        // Sembunyikan pagination & rowsPerPage saat search
        rowsPerPageContainer.classList.toggle("d-none", isSearchActive);
        paginationControls.classList.toggle("d-none", isSearchActive);
        paginationControls.classList.toggle("d-flex", !isSearchActive);
    
        // Update teks jumlah data
        const dataCountText = document.getElementById("dataCountText");
        if (dataCountText) {
            if (isSearchActive) {
                dataCountText.textContent = "";
            } else {
                let start = (currentPage - 1) * rowsPerPage + 1;
                let end = currentPage * rowsPerPage;
                if (rowsPerPage === "all") {
                    start = 1;
                    end = totalRows;
                } else {
                    if (end > totalRows) end = totalRows;
                }
    
                if (totalRows === 0) {
                    dataCountText.textContent = "Tidak ada data yang ditampilkan.";
                } else {
                    dataCountText.textContent = `Menampilkan ${start} sampai ${end} dari ${totalRows} data`;
                }
            }
        }
    }
    
    function updateButtons(totalPages) {
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage >= totalPages;
        firstBtn.disabled = currentPage === 1;
        lastBtn.disabled = currentPage === totalPages;
    }

    // Event listeners
    rowsPerPageSelect.addEventListener("change", function () {
        rowsPerPage = this.value === "all" ? "all" : parseInt(this.value);
        currentPage = 1;
        displayRows();
    });

    transactionTypeSelect.addEventListener("change", function () {
        currentPage = 1;
        displayRows();
    });

    nextBtn.addEventListener("click", function () {
        const totalPages = rowsPerPage === "all" ? 1 : Math.ceil(getFilteredRows().length / rowsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            displayRows();
        }
    });

    prevBtn.addEventListener("click", function () {
        if (currentPage > 1) {
            currentPage--;
            displayRows();
        }
    });

    lastBtn.addEventListener("click", function () {
        const totalPages = rowsPerPage === "all" ? 1 : Math.ceil(getFilteredRows().length / rowsPerPage);
        currentPage = totalPages;
        displayRows();
    });

    firstBtn.addEventListener("click", function () {
        currentPage = 1;
        displayRows();
    });

    searchInput.addEventListener("keyup", function () {
        currentPage = 1;
        displayRows();
    });

    // Inisialisasi awal
    displayRows();
});
