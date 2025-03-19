document.addEventListener("DOMContentLoaded", function () {

    // Variabel global untuk menyimpan filter aktif. Default: "all".
    let activeFilter = 'all';
    let debounceTimeout;

    // 1. Logika Dropdown Sidebar (tidak berubah)
    document.querySelectorAll(".list-group-item.has-dropdown").forEach(function (dropdown) {
        let dropdownMenu = dropdown.querySelector(".dropdown-content");
        let icon = dropdown.querySelector(".bi-chevron-down");

        // Pastikan dropdown tersembunyi pada awal
        dropdownMenu.style.display = "none";
        icon.style.transform = "rotate(0deg)";

        dropdown.addEventListener("click", function (event) {
            event.stopPropagation();
            // Tutup semua dropdown lain sebelum membuka yang baru
            document.querySelectorAll(".dropdown-content").forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.style.display = "none";
                }
            });
            document.querySelectorAll(".bi-chevron-down").forEach(i => {
                if (i !== icon) i.style.transform = "rotate(0deg)";
            });
            // Toggle dropdown yang diklik
            if (dropdownMenu.style.display === "block") {
                dropdownMenu.style.display = "none";
                icon.style.transform = "rotate(0deg)";
            } else {
                dropdownMenu.style.display = "block";
                icon.style.transform = "rotate(180deg)";
            }
        });
    });

    // Menutup dropdown jika klik di luar
    document.addEventListener("click", function (event) {
        if (!event.target.closest('.has-dropdown')) {
            document.querySelectorAll(".dropdown-content").forEach(menu => menu.style.display = "none");
            document.querySelectorAll(".bi-chevron-down").forEach(icon => icon.style.transform = "rotate(0deg)");
        }
    });

    // 2. Logika Filter Notifikasi
    const sidebarFilters = document.querySelectorAll(".sidebar-filter li[data-filter]");
    sidebarFilters.forEach(filter => {
        filter.addEventListener("click", function (event) {
            event.stopPropagation();
            sidebarFilters.forEach(item => item.classList.remove("active"));
            this.classList.add("active");

            // Perbarui filter aktif
            activeFilter = this.getAttribute("data-filter");

            fetch(`/notifikasi/filter?filter=${activeFilter}`)
                .then(response => response.json())
                .then(data => {
                    updateNotificationList(data);
                })
                .catch(error => console.error("Error fetching notifications:", error));
        });
    });

    function updateNotificationList(notifications) {
        const notificationContainer = document.querySelector(".notification-list");
        notificationContainer.innerHTML = ""; // Bersihkan kontainer

        if (notifications.length === 0) {
            notificationContainer.innerHTML = `<li class="text-center p-3">Tidak ada notifikasi</li>`;
            return;
        }

        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        const notifHTML = notifications.map(notification => {
            let photoUrl = (notification.tipe === 'Laporan' || notification.tipe === 'Saran')
                ? (notification.foto_pengirim ? `${notification.foto_pengirim}` : `/dashboard/dist/assets/images/logo/logoSMK_.png`)
                : `/dashboard/dist/assets/images/logo/logoSMK_.png`;

            let dateObj = new Date(notification.created_at);
            let day = dateObj.getDate().toString().padStart(2, '0');
            let month = monthNames[dateObj.getMonth()];
            let formattedDate = `${day} ${month}`;

            let statusIcon = '';
            let statusText = '';

            if (notification.status_laporan === 'Dibaca_Admin') {
                statusIcon = '<i class="bi bi-check-all text-primary"></i>';
                statusText = 'Dibaca Admin';
            } else if (notification.status_laporan === 'Dibalas') {
                statusIcon = '<i class="bi bi-check-all text-primary"></i>';
                statusText = 'Telah Dibalas';
            } else if (notification.tipe === 'Laporan' || notification.tipe === 'Saran') {
                statusIcon = '<i class="bi bi-check-all text-gray"></i>';
                statusText = 'Terkirim';
            } else if (notification.tipe === 'Pengingat') {
                statusIcon = '<i class="bi bi-bell text-danger"></i>';
                statusText = 'Pengingat';
            } else if (notification.tipe === 'Transaksi' && !notification.status_transaksi) {
                statusIcon = '<i class="bi bi-question-circle text-secondary"></i>';
                statusText = 'Status Tidak Diketahui';
            } else {
                switch (notification.status_transaksi) {
                    case 'Sukses':
                        statusIcon = '<i class="bi bi-check-circle text-success"></i>';
                        statusText = 'Transaksi Berhasil';
                        break;
                    case 'Menunggu Persetujuan':
                        statusIcon = '<i class="bi bi-hourglass-split text-warning"></i>';
                        statusText = 'Menunggu Persetujuan';
                        break;
                    case 'Gagal':
                        statusIcon = '<i class="bi bi-x-circle text-danger"></i>';
                        statusText = 'Transaksi Gagal';
                        break;
                    default:
                        statusIcon = '<i class="bi bi-question-circle text-secondary"></i>';
                        statusText = 'Status Tidak Diketahui';
                        break;
                }
            }

            let unreadClass = notification.status === 'Belum Dibaca' ? '' : 'mail-read';

            let replyHtml = notification.balasan ? `
                <div class="reply-container-user">
                    <div class="reply-list ${notification.status === 'Belum Dibaca' ? 'unread' : 'read'}">
                        <span>Ada balasan dari admin</span>
                    </div>
                </div>
            ` : '';

            return `
                <li class="media ${unreadClass}" onclick="openMessageOverlay(${notification.id})" id="notification-${notification.id}">
                    <div class="pr-50">
                        <div class="avatar">
                            <img src="${photoUrl}" alt="avatar">
                        </div>
                    </div>
                    <div class="media-body">
                        <div class="user-details">
                            <div class="wrapper-name-mail">
                                <div class="sender-name">
                                    <strong>${notification.nama_pengirim ? notification.nama_pengirim : 'Sistem'}</strong>
                                </div>
                                <div class="mail-items">
                                    <span class="list-group-item-text text-truncate">${notification.judul}</span>
                                </div>
                                ${replyHtml}
                            </div>
                            <div class="mail-meta-item">
                                <span class="mail-meta-content float-right">
                                    <span class="mail-date">${formattedDate}</span>
                                    <span class="status-icon">${statusIcon} ${statusText}</span>
                                </span>
                            </div>
                        </div>
                        <div class="mail-message">
                            <p class="list-group-item-text truncate mb-0">
                                ${notification.isi_pesan.substring(0, 50)}
                            </p>
                            <div class="mail-meta-item" data-id="${notification.id}">
                                <span>
                                    ${notification.status === 'Belum Dibaca' ? `<span class="bullet-unread" id="bullet-${notification.id}"></span>` : ''}
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
            `;
        }).join('');

        document.querySelector(".notification-list").innerHTML = notifHTML;
    }

    // 3. Logika Search dengan Debounce
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function (event) {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(function () {
            performSearch(event);
        }, 300);
    });

    function performSearch(event) {
        const query = event.target.value.trim();

        if (query.length === 0) {
            // Saat input kosong, ambil data sesuai filter aktif
            fetch(`/notifikasi/filter?filter=${activeFilter}`)
                .then(response => response.json())
                .then(data => {
                    updateNotificationList(data);
                })
                .catch(error => console.error("Error fetching notifications:", error));
            return;
        }

        // Saat ada query, lakukan pencarian (global)
        fetch('/search-notifications?query=' + encodeURIComponent(query) + `&filter=${activeFilter}`)
            .then(response => response.json())
            .then(data => {
                updateSearchResults(data, query);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function updateSearchResults(responseData, query) {
        const notificationList = document.querySelector('.users-list-wrapper');
        notificationList.innerHTML = '';

        if (!responseData || !Array.isArray(responseData.data)) {
            console.error("Data yang diterima bukan array:", responseData);
            notificationList.innerHTML = '<li>Terjadi kesalahan dalam memuat notifikasi.</li>';
            return;
        }

        const data = responseData.data;

        if (data.length === 0) {
            notificationList.innerHTML = '<li>No notifications found.</li>';
        } else {
            data.forEach(pesan => {
                const notificationElement = document.createElement('li');
                notificationElement.classList.add('media');
                notificationElement.id = `notification-${pesan.id}`;
                notificationElement.setAttribute('onclick', `openMessageOverlay(${pesan.id})`);

                if (pesan.status !== 'Belum Dibaca') {
                    notificationElement.classList.add('mail-read');
                }

                let fotoProfil = (pesan.tipe === 'Laporan' || pesan.tipe === 'Saran')
                    ? (pesan.foto_pengirim ? `${pesan.foto_pengirim}` : `/dashboard/dist/assets/images/logo/logoSMK_.png`)
                    : `/dashboard/dist/assets/images/logo/logoSMK_.png`;

                let statusIcon = getStatusIcon(pesan);
                let formattedDate = new Date(pesan.created_at).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short'
                });

                notificationElement.innerHTML = `
                    <div class="pr-50">
                        <div class="avatar">
                            <img src="${fotoProfil}" alt="avatar">
                        </div>
                    </div>
                    <div class="media-body">
                        <div class="user-details">
                            <div class="wrapper-name-mail">
                                <div class="sender-name">
                                    <strong>${highlightText(pesan.nama_pengirim || 'Sistem', query)}</strong>
                                </div>
                                <div class="mail-items">
                                    <span class="list-group-item-text text-truncate">${highlightText(pesan.judul || 'Tidak ada judul', query)}</span>
                                </div>
                                ${pesan.balasan ? `
                                <div class="reply-container-user">
                                    <div class="reply-list ${pesan.status === 'Belum Dibaca' ? 'unread' : 'read'}">
                                        <span>Ada balasan dari admin</span>
                                    </div>
                                </div>
                                ` : ''}
                            </div>
                            <div class="mail-meta-item">
                                <span class="mail-meta-content float-right">
                                    <span class="mail-date">${formattedDate}</span>
                                    <span class="status-icon">${statusIcon}</span>
                                </span>
                            </div>
                        </div>
                        <div class="mail-message">
                            <p class="list-group-item-text truncate mb-0">${highlightText(pesan.isi_pesan || 'Tidak ada isi pesan', query)}</p>
                            <div class="mail-meta-item" data-id="${pesan.id}">
                                ${pesan.status === 'Belum Dibaca' ? `<span class="bullet-unread" id="bullet-${pesan.id}"></span>` : ''}
                            </div>
                        </div>
                    </div>
                `;

                notificationList.appendChild(notificationElement);
            });
        }
    }

    function highlightText(text, query) {
        if (!query) return text;
        const regex = new RegExp(`(${query})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }

    function getStatusIcon(pesan) {
        let statusIcon = '';
        if (pesan.status_laporan === 'Dibaca_Admin') {
            statusIcon = '<i class="bi bi-check-all text-primary"></i>  Dibaca Admin';
        } else if (pesan.status_laporan === 'Dibalas') {
            statusIcon = '<i class="bi bi-check-all text-primary"></i>  Telah Dibalas';
        } else if (pesan.tipe === "Laporan" || pesan.tipe === "Saran") {
            statusIcon = '<i class="bi bi-check-all text-gray"></i> Terkirim';
        } else if (pesan.tipe === "Pengingat") {
            statusIcon = '<i class="bi bi-bell text-danger"></i> Pengingat';
        } else if (pesan.tipe === "Transaksi" && !pesan.status_transaksi) {
            statusIcon = '<i class="bi bi-question-circle text-secondary"></i> Status Tidak Diketahui';
        } else {
            switch (pesan.status_transaksi) {
                case 'Sukses':
                    statusIcon = '<i class="bi bi-check-circle text-success"></i> Transaksi Berhasil';
                    break;
                case 'Menunggu Persetujuan':
                    statusIcon = '<i class="bi bi-hourglass-split text-warning"></i> Menunggu Persetujuan';
                    break;
                case 'Gagal':
                    statusIcon = '<i class="bi bi-x-circle text-danger"></i> Transaksi Gagal';
                    break;
                default:
                    statusIcon = '<i class="bi bi-question-circle text-secondary"></i> Status Tidak Diketahui';
            }
        }
        return statusIcon;
    }

    // Fungsi untuk memuat notifikasi ketika input search kosong
    function loadNotifications() {
        fetch(`/notifikasi/filter?filter=${activeFilter}`)
            .then(response => response.json())
            .then(data => {
                // Perbarui tampilan notifikasi dengan data filter aktif
                updateNotificationList(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Muat notifikasi saat halaman pertama kali di-load
    document.addEventListener("DOMContentLoaded", function () {
        loadNotifications();
    });
});
