        function filterTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('membersTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j]) {
                        if (cells[j].innerText.toLowerCase().includes(filter)) {
                            match = true;
                            break;
                        }
                    }
                }

                rows[i].style.display = match ? '' : 'none';
            }
        }

        function addMember() {
            alert('Fungsi untuk menambah anggota belum diimplementasikan.');
        }

        function editMember(button) {
            alert('Fungsi untuk mengedit anggota belum diimplementasikan.');
        }

        function deleteMember(button) {
            const row = button.closest('tr');
            row.remove();
        }