document.addEventListener("DOMContentLoaded", function() {
    const filterTipe = document.getElementById("filterTipe");
    const filterStatus = document.getElementById("filterStatus");
    const tableRows = document.querySelectorAll("#riwayatTable tbody tr");
    
    function filterTable() {
        const tipeValue = filterTipe.value.toLowerCase();
        const statusValue = filterStatus.value.toLowerCase();
        
        tableRows.forEach(row => {
            const tipe = row.children[3].textContent.toLowerCase();
            const status = row.children[5].textContent.toLowerCase();
            
            if ((tipeValue === "" || tipe.includes(tipeValue)) && (statusValue === "" || status.includes(statusValue))) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
    
    filterTipe.addEventListener("change", filterTable);
    filterStatus.addEventListener("change", filterTable);
});