// Cache search
const searchCacheAdmin = {};
let currentFetchController = null;

document.addEventListener("DOMContentLoaded", function () {
    // Logika Filter Notifikasi
    const sidebarFilters = document.querySelectorAll(".sidebar-filter li[data-filter]");
    sidebarFilters.forEach(filter => {
        filter.addEventListener("click", function (event) {
            event.stopPropagation();
            sidebarFilters.forEach(item => item.classList.remove("active"));
            this.classList.add("active");

            let filterType = this.getAttribute("data-filter");

            fetch(`/notifikasi/admin/filter?filter=${filterType}`)
                .then(response => response.json())
                .then(data => {
                    updateNotificationList(data);
                })
                .catch(error => console.error("Error fetching notifications:", error));
        });
    });

    function updateNotificationList(data) {
        // Ambil elemen list yang akan diupdate
        const listWrapper = document.querySelector('.users-list-wrapper.media-list');
        let html = '';

        // Fungsi untuk memformat tanggal menjadi "d M" (misal: "12 Mar")
        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            const day = date.getDate();
            const month = months[date.getMonth()];
            return `${day} ${month}`;
        }

        // Fungsi untuk mendapatkan HTML status ikon sesuai dengan status laporan
        function getStatusLaporanIcon(status) {
            switch (status) {
                case 'Terkirim':
                    return '<i class="bi bi-check-all text-gray"></i> Belum Dibaca';
                case 'Dibaca_Admin':
                    return '<i class="bi bi-check-all text-primary"></i> Telah Dibaca';
                case 'Dibalas':
                    return '<i class="bi bi-chat-left-text"></i> Sudah Dibalas';
                default:
                    return '<i class="bi bi-question-circle text-secondary"></i> Status Tidak Diketahui';
            }
        }

        // Jika ada data, looping dan buat HTML setiap item
        if (data && data.length > 0) {
            data.forEach(item => {
                // Ambil data langsung dari tabel laporan_users
                const userName = item.nama_pengirim ? item.nama_pengirim : 'User Tidak Diketahui';
                const userImage = item.foto_pengirim ? item.foto_pengirim : 'default.png';

                // Tentukan kelas <li>, jika status laporan bukan "Terkirim" maka tambahkan class "mail-read"
                const liClass = item.status_laporan === 'Terkirim' ? 'media' : 'media mail-read';

                html += `
                    <li class="${liClass}" data-id="${item.id}" onclick="openMessageOverlay(${item.id})" id="notification-${item.id}">
                        <div class="pr-50">
                            <div class="avatar">
                                <img src="${userImage}" alt="avatar">
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="user-details">
                                <div class="wrapper-name-mail">
                                    <div class="sender-name">
                                        <strong>${userName}</strong>
                                    </div>
                                    <div class="mail-items">
                                        <span class="list-group-item-text"><strong>${item.email}</strong></span>
                                    </div>
                                    <div class="mail-items">
                                        <span class="list-group-item-text text-truncate">${item.tipe}</span>
                                    </div>
                                </div>
                                <div class="mail-meta-item">
                                    <span class="mail-meta-content float-right">
                                        <span class="mail-date">${formatDate(item.created_at)}</span>
                                        <span id="status-laporan-${item.id}" class="status-icon">
                                            ${getStatusLaporanIcon(item.status_laporan)}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="mail-message">
                                <p class="list-group-item-text truncate mb-0">
                                    ${item.isi_pesan ? item.isi_pesan : 'Tidak ada isi pesan'}
                                </p>
                                <div class="mail-meta-item">
                                    <span>
                                        ${item.status_laporan === 'Terkirim' ? `<span class="bullet-unread" id="bullet-${item.id}"></span>` : ''}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                `;
            });
        } else {
            // Jika tidak ada data, tampilkan pesan bahwa tidak ada laporan masuk
            html = `
                <li class="media">
                    <p class="text-center w-100">Tidak ada laporan masuk.</p>
                </li>
            `;
        }

        // Update konten list dengan HTML yang sudah dibuat
        listWrapper.innerHTML = html;
    }

    // Debounce search input
    let debounceTimeout;
    document.getElementById('searchInput').addEventListener('input', function (event) {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(function () {
            performSearch(event);
        }, 300);
    });

    function performSearch(event) {
        const query = event.target.value.trim().toLowerCase(); // Lowercase untuk konsistensi cache key
    
        // Batalkan fetch sebelumnya jika masih berjalan
        if (currentFetchController) {
            currentFetchController.abort();
        }
    
        currentFetchController = new AbortController();
        const signal = currentFetchController.signal;
    
        // Jika query kosong, tampilkan kembali data sesuai filter aktif
        if (query.length === 0) {
            loadNotifications();
            return;
        }
    
        // ✅ Gunakan cache jika sudah ada
        if (searchCacheAdmin[query]) {
            updateSearchResults(searchCacheAdmin[query], query);
            return;
        }
    
        // Jika belum ada di cache → fetch baru
        fetch(`/search-notifications/admin?query=${encodeURIComponent(query)}`, { signal })
            .then(response => response.json())
            .then(data => {
                searchCacheAdmin[query] = data; // Simpan hasil ke cache
                updateSearchResults(data, query);
            })
            .catch(error => {
                if (error.name !== 'AbortError') {
                    console.error('Error:', error);
                }
            });
    }
    
    // Update list laporan berdasarkan data yang diterima dan query pencarian
    function updateSearchResults(data, query) {
        const notificationList = document.querySelector('.users-list-wrapper.media-list');
        notificationList.innerHTML = ''; // Bersihkan daftar sebelumnya

        // Pastikan data yang diterima berupa array
        if (!data || !Array.isArray(data)) {
            console.error("Data yang diterima bukan array:", data);
            notificationList.innerHTML = `<li class="media"><p class="text-center w-100">Terjadi kesalahan dalam memuat laporan.</p></li>`;
            return;
        }

        if (data.length === 0) {
            notificationList.innerHTML = `<li class="media"><p class="text-center w-100">Tidak ada laporan masuk.</p></li>`;
            return;
        }

        // Looping setiap item dan buat HTML sesuai struktur Blade di halaman admin
        data.forEach(item => {
            // Ambil data langsung dari tabel laporan_users
            const senderName = item.nama_pengirim ? item.nama_pengirim : 'User Tidak Diketahui';
            const senderImage = item.foto_pengirim ? item.foto_pengirim : 'default.png';

            // Jika status_laporan "Terkirim", tampilkan tanpa class tambahan; jika tidak, tambahkan class "mail-read"
            const liClass = item.status_laporan === 'Terkirim' ? 'media' : 'media mail-read';

            // Format tanggal sesuai dengan format "d M" (misalnya: "12 Mar")
            const formattedDate = formatDate(item.created_at);

            // Dapatkan HTML status ikon sesuai dengan status laporan
            const statusIcon = getStatusLaporanIcon(item.status_laporan);

            // Buat struktur HTML untuk masing-masing laporan
            let liHtml = `
            <li class="${liClass}" data-id="${item.id}" onclick="openMessageOverlay(${item.id})" id="notification-${item.id}">
                <div class="pr-50">
                    <div class="avatar">
                        <img src="${senderImage}" alt="avatar">
                    </div>
                </div>
                <div class="media-body">
                    <div class="user-details">
                        <div class="wrapper-name-mail">
                            <div class="sender-name">
                                <strong>${highlightText(senderName, query)}</strong>
                            </div>
                            <div class="mail-items">
                                <span class="list-group-item-text"><strong>${highlightText(item.email, query)}</strong></span>
                            </div>
                            <div class="mail-items">
                                <span class="list-group-item-text text-truncate">${highlightText(item.tipe, query)}</span>
                            </div>
                        </div>
                        <div class="mail-meta-item">
                            <span class="mail-meta-content float-right">
                                <span class="mail-date">${formattedDate}</span>
                                <span id="status-laporan-${item.id}" class="status-icon">
                                    ${statusIcon}
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="mail-message">
                        <p class="list-group-item-text truncate mb-0">${highlightText(item.isi_pesan || 'Tidak ada isi pesan', query)}</p>
                        <div class="mail-meta-item">
                            <span>
                                ${item.status_laporan === 'Terkirim' ? `<span class="bullet-unread" id="bullet-${item.id}"></span>` : ''}
                            </span>
                        </div>
                    </div>
                </div>
            </li>
        `;
            notificationList.innerHTML += liHtml;
        });
    }

    // Helper: Format tanggal menjadi "d M"
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const day = date.getDate();
        const month = months[date.getMonth()];
        return `${day} ${month}`;
    }

    // Helper: Highlight teks yang sesuai dengan query pencarian
    function highlightText(text, query) {
        if (!query) return text;
        const regex = new RegExp(`(${query})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }

    // Helper: Mengembalikan HTML ikon status laporan (meniru accessor di model)
    function getStatusLaporanIcon(status) {
        switch (status) {
            case 'Terkirim':
                return '<i class="bi bi-check-all text-gray"></i> Belum Dibaca';
            case 'Dibaca_Admin':
                return '<i class="bi bi-check-all text-primary"></i> Telah Dibaca';
            case 'Dibalas':
                return '<i class="bi bi-chat-left-text"></i> Sudah Dibalas';
            default:
                return '<i class="bi bi-question-circle text-secondary"></i> Status Tidak Diketahui';
        }
    }

    // Fungsi untuk memuat semua laporan (jika query pencarian kosong)
    function loadNotifications() {
        let activeFilterElement = document.querySelector('[data-filter].active');
        let filter = activeFilterElement ? activeFilterElement.getAttribute('data-filter') : 'all';

        fetch(`/search-notifications/admin?query=&filter=${filter}`)
            .then(response => response.json())
            .then(data => {
                updateSearchResults(data, ''); // Update tampilan laporan tanpa highlight
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Muat laporan saat halaman pertama kali di-load
    document.addEventListener("DOMContentLoaded", function () {
        loadNotifications();
    });

});