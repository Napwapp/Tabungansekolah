document.addEventListener('DOMContentLoaded', function () {
    const rowsPerPage = 10;
    let currentPage = 1;
    let debounceTimeout;
    let currentFetchController = null;
    const searchCache = {}; // cache pencarian

    // ambil elemen
    const desktopRows = Array.from(document.querySelectorAll('#desktop-user-container tr'));
    const mobileCards = Array.from(document.querySelectorAll('#mobile-user-container .card'));
    let totalItems = desktopRows.length;
    let totalPages = Math.ceil(totalItems / rowsPerPage);

    const infoDiv = document.querySelector('.pagination > div:first-child');
    const controlsEl = document.querySelector('.pagination-controls');

    // SVG arrow (copy sesuai markup)

    const firstSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M8.354 1.646a.5.5 0 0 1 0 .708L3.707 7l4.647 
                      4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 
                      0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
                      <path fill-rule="evenodd"
                      d="M12.354 1.646a.5.5 0 0 1 0 .708L7.707 7l4.647 
                      4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 
                      0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
    
                      </svg>`;
    const lastSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M3.646 1.646a.5.5 0 0 1 .708 0l5 5a.5.5 
                            0 0 1 0 .708l-5 5a.5.5 0 0 1-.708-.708L8.293 7 
                            3.646 2.354a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd"
                        d="M7.646 1.646a.5.5 0 0 1 .708 0l5 5a.5.5 
                            0 0 1 0 .708l-5 5a.5.5 0 0 1-.708-.708L12.293 7 
                            7.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>`;

    const prevSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                          fill="currentColor" viewBox="0 0 16 16">
                       <path fill-rule="evenodd"
                         d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 
                            5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 
                            0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                     </svg>`;

    const nextSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                          fill="currentColor" viewBox="0 0 16 16">
                       <path fill-rule="evenodd"
                         d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 
                            0 0 1 0 .708l-6 6a.5.5 0 0 
                            1-.708-.708L10.293 8 4.646 2.354a.5.5 
                            0 0 1 0-.708z"/>
                     </svg>`;

    function displayPage(page) {
        currentPage = page;
        const startIdx = (page - 1) * rowsPerPage;
        const endIdx = startIdx + rowsPerPage;

        // hide/show desktop rows
        desktopRows.forEach((r, i) => {
            r.style.display = (i >= startIdx && i < endIdx) ? '' : 'none';
        });
        // hide/show mobile cards
        mobileCards.forEach((c, i) => {
            c.style.display = (i >= startIdx && i < endIdx) ? '' : 'none';
        });

        // update info text
        const startItem = Math.min(startIdx + 1, totalItems);
        const endItem = Math.min(endIdx, totalItems);
        infoDiv.textContent = `${startItem} to ${endItem} items of ${totalItems}`;

        renderPaginationControls();
    }

    function renderPaginationControls() {
        controlsEl.innerHTML = '';

        const showJumpArrows = totalPages >= 3; // karena 3 page artinya 2 loncatan
        const isFirstPage = currentPage === 1;
        const isLastPage = currentPage === totalPages;

        // Tombol << ke halaman pertama
        if (showJumpArrows && !isFirstPage) {
            const firstBtn = document.createElement('button');
            firstBtn.classList.add('page-btn', 'arrow');
            firstBtn.innerHTML = firstSvg;
            firstBtn.addEventListener('click', () => displayPage(1));
            controlsEl.appendChild(firstBtn);
        }

        // Tombol sebelumnya
        if (currentPage > 1) {
            const btn = document.createElement('button');
            btn.classList.add('page-btn', 'arrow');
            btn.innerHTML = prevSvg;
            btn.addEventListener('click', () => displayPage(currentPage - 1));
            controlsEl.appendChild(btn);
        }

        // Page‑btn block kelipatan 5
        const blockStart = Math.floor((currentPage - 1) / 5) * 5 + 1;
        const blockEnd = Math.min(blockStart + 4, totalPages);

        if (blockStart > 1) {
            const dots = document.createElement('span');
            dots.textContent = '...';
            dots.classList.add('dots');
            controlsEl.appendChild(dots);
        }

        for (let i = blockStart; i <= blockEnd; i++) {
            const btn = document.createElement('button');
            btn.classList.add('page-btn');
            if (i === currentPage) btn.classList.add('active');
            btn.textContent = i;
            btn.addEventListener('click', () => displayPage(i));
            controlsEl.appendChild(btn);
        }

        if (blockEnd < totalPages) {
            const dots = document.createElement('span');
            dots.textContent = '...';
            dots.classList.add('dots');
            controlsEl.appendChild(dots);
        }

        // Tombol selanjutnya
        if (currentPage < totalPages) {
            const btn = document.createElement('button');
            btn.classList.add('page-btn', 'arrow');
            btn.innerHTML = nextSvg;
            btn.addEventListener('click', () => displayPage(currentPage + 1));
            controlsEl.appendChild(btn);
        }

        // Tombol >> ke halaman terakhir
        if (showJumpArrows && !isLastPage) {
            const lastBtn = document.createElement('button');
            lastBtn.classList.add('page-btn', 'arrow');
            lastBtn.innerHTML = lastSvg;
            lastBtn.addEventListener('click', () => displayPage(totalPages));
            controlsEl.appendChild(lastBtn);
        }
    }

    // inisialisasi halaman pertama
    displayPage(1);

    // search 
    const searchInput = document.getElementById('searchInput');
    let isSearching = false;

    // Render hasil ke DOM
    function renderUsers(data) {
        const desktopContainer = document.getElementById('desktop-user-container');
        const mobileContainer = document.getElementById('mobile-user-container');

        // Bersihkan kontainer
        desktopContainer.innerHTML = '';
        mobileContainer.innerHTML = '';

        // Jika data kosong, tampilkan teks kosong
        if (data.length === 0) {
            // Tabel desktop (gunakan colspan sesuai jumlah kolom tabelmu)
            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = `
                <td colspan="8" style="text-align: center; padding: 1rem; color: #888;">
                    Tidak ada data yang ditemukan
                </td>
            `;
            desktopContainer.appendChild(emptyRow);

            // Tampilan mobile (card kosong)
            const emptyCard = document.createElement('div');
            emptyCard.style.textAlign = 'center';
            emptyCard.style.padding = '1rem';
            emptyCard.style.color = '#888';
            emptyCard.textContent = 'Tidak ada data yang ditemukan';
            mobileContainer.appendChild(emptyCard);

            return;
        }

        // Jika ada data, render seperti biasa
        data.forEach(user => {
            desktopContainer.appendChild(renderDesktopUser(user));
            mobileContainer.appendChild(renderMobileUser(user));
        });

        function renderDesktopUser(user) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><input type="checkbox" class="checkbox checkbox-item-desktop" value="${user.id}"></td>
                <td>
                    <div class="user-info">
                        <img src="/picture/accounts/${user.gambar ?? 'default.png'}" class="avatar avatar-xl me3">
                        <span class="user-name">${user.namalengkap}</span>
                    </div>
                </td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.tabungan?.id_tabungan ?? '-'}</td>
                <td>${user.kelas}</td>
                <td>
                    <select class="form-control" name="role">
                        <option value="user" ${user.role === 'user' ? 'selected' : ''}>User</option>
                        <option value="admin" ${user.role === 'admin' ? 'selected' : ''}>Admin</option>
                    </select>
                </td>
                <td class="created-at">${formatTanggal(user.created_at)}</td>
            `;
            return tr;

        }

        function renderMobileUser(user) {
            const card = document.createElement('div');
            card.classList.add('card');
            card.innerHTML = `
                <div class="card-header position-relative">
                    <input type="checkbox" class="checkbox" value="${user.id}">
                    <div class="user-info">
                        <img src="/picture/accounts/${user.gambar ?? 'default.png'}" alt="Avatar" class="avatar">
                        <span class="user-name">${user.namalengkap}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-row"><div class="card-label">USERNAME:</div><div class="card-value">${user.username}</div></div>
                    <div class="card-row"><div class="card-label">EMAIL:</div><div class="card-value">${user.email}</div></div>
                    <div class="card-row"><div class="card-label">ID TABUNGAN:</div><div class="card-value">${user.tabungan?.id_tabungan ?? '-'}</div></div>
                    <div class="card-row"><div class="card-label">KELAS:</div><div class="card-value">${user.kelas}</div></div>
                    <div class="card-row"><div class="card-label">BERGABUNG:</div><div class="card-value">${formatTanggal(user.created_at, true)}</div></div>
                </div>
            `;
            return card;
        }

        function formatTanggal(datetime, mobile = false) {
            const d = new Date(datetime);
            if (mobile) {
                return d.toLocaleString('id-ID', { month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit' });
            }
            return d.toISOString().slice(0, 10); // format YYYY-MM-DD
        }

        // Render desktop dan mobile
        desktopContainer.innerHTML = '';
        mobileContainer.innerHTML = '';
        data.forEach(user => {
            desktopContainer.appendChild(renderDesktopUser(user));
            mobileContainer.appendChild(renderMobileUser(user));
        });
    }

    // Handler pencarian
    searchInput.addEventListener('input', function (event) {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(function () {
            performSearch(event);
        }, 200);
        updateDeleteButtonVisibility();
    });

    function performSearch(event) {
        const query = event.target.value.trim().toLowerCase();
        // Sembunyikan tombol hapus saat input berubah
        clearAllCheckboxes(); // ✅ langsung uncheck semua diawal


        // Batalkan fetch sebelumnya jika ada
        if (currentFetchController) {
            currentFetchController.abort();
        }

        currentFetchController = new AbortController();
        const signal = currentFetchController.signal;

        // Jika kosong, kembali ke pagination default
        if (query.length === 0) {
            isSearching = false;

            fetch('/load-data-anggota', { signal })
                .then(res => res.json())
                .then(data => {
                    renderUsers(data);
                    bindCheckboxListeners();

                    desktopRows.length = 0;
                    mobileCards.length = 0;

                    document.querySelectorAll('#desktop-user-container tr').forEach(row => desktopRows.push(row));
                    document.querySelectorAll('#mobile-user-container .card').forEach(card => mobileCards.push(card));
                    totalItems = desktopRows.length;
                    totalPages = Math.ceil(totalItems / rowsPerPage);
                    displayPage(currentPage);
                })
                .catch(error => {
                    if (error.name !== 'AbortError') {
                        console.error("Gagal memuat data:", error);
                    }
                });

            return;
        }

        // ✅ Cek cache dulu
        if (searchCache[query]) {
            renderUsers(searchCache[query]);
            infoDiv.textContent = `${searchCache[query].length} hasil ditemukan (cached)`;
            bindCheckboxListeners();
            controlsEl.innerHTML = '';
            return;
        }

        // ✅ Fetch baru
        isSearching = true;
        fetch(`/search-data-anggota?query=${encodeURIComponent(query)}`, { signal })
            .then(res => res.json())
            .then(data => {
                // simpan ke cache
                searchCache[query] = data;

                renderUsers(data);
                infoDiv.textContent = `${data.length} hasil ditemukan`;
                bindCheckboxListeners();
                controlsEl.innerHTML = '';
            })
            .catch(error => {
                if (error.name !== 'AbortError') {
                    console.error('Error:', error);
                }
            });
        // untuk meng unchecked allchecked
        clearAllCheckboxes();
    }

    function bindCheckboxListeners() {
        const itemCheckboxes = document.querySelectorAll('.checkbox-item-desktop, .checkbox-item-mobile');
        itemCheckboxes.forEach(cb => {
            cb.addEventListener('change', updateDeleteButtonVisibility);
        });
    }

    // checkbox 

    // === DESKTOP ===
    const allCheckboxDesktop = document.getElementById('select-all-desktop');
    const itemCheckboxesDesktop = document.querySelectorAll('.checkbox-item-desktop');

    // === MOBILE ===
    const allCheckboxMobile = document.getElementById('select-all-mobile');
    const itemCheckboxesMobile = document.querySelectorAll('.checkbox-item-mobile');

    // Tombol delete
    const deleteBtn = document.getElementById('delete-selected');

    // Fungsi untuk cek apakah ada checkbox yang dicentang
    function updateDeleteButtonVisibility() {
        const anyCheckedDesktop = Array.from(document.querySelectorAll('.checkbox-item-desktop')).some(cb => cb.checked);
        const anyCheckedMobile = Array.from(document.querySelectorAll('.checkbox-item-mobile')).some(cb => cb.checked);

        // Tampilkan tombol hapus jika ada yang dicentang di desktop atau mobile
        deleteBtn.classList.toggle('d-none', !(anyCheckedDesktop || anyCheckedMobile));
    }

    // === EVENT CHECKBOX DESKTOP ===
    if (allCheckboxDesktop) {
        allCheckboxDesktop.addEventListener('change', function () {
            itemCheckboxesDesktop.forEach(cb => cb.checked = allCheckboxDesktop.checked);
            updateDeleteButtonVisibility();
        });
        itemCheckboxesDesktop.forEach(cb => {
            cb.addEventListener('change', updateDeleteButtonVisibility);
        });
    }

    // === EVENT CHECKBOX MOBILE ===
    if (allCheckboxMobile) {
        allCheckboxMobile.addEventListener('change', function () {
            itemCheckboxesMobile.forEach(cb => cb.checked = allCheckboxMobile.checked);
            updateDeleteButtonVisibility();
        });
        itemCheckboxesMobile.forEach(cb => {
            cb.addEventListener('change', updateDeleteButtonVisibility);
        });
    }

    // Fungsi reusable
    // function untuk menyembunyikan tombol hapus
    // function hideDeleteButton() {
    //     document.getElementById('delete-selected').classList.add('d-none');
    // }

    // untuk menunchecked allchecked
    function clearAllCheckboxes() {
        // Gabungkan desktop dan mobile checkbox
        const checkboxes = document.querySelectorAll('.checkbox-item-desktop, .checkbox-item-mobile');

        checkboxes.forEach(cb => cb.checked = false); // uncheck semuanya sekaligus
        allCheckboxDesktop.checked = false; // uncheck "Select All"
        allCheckboxMobile.checked = false; // uncheck "Select All"

        document.getElementById('delete-selected').classList.add('d-none');
    }
});