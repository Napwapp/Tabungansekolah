document.addEventListener('DOMContentLoaded', function () {
    // Mengambil notifikasi dari database menggunakan fetch
    fetch('/get-notifications')
        .then(response => response.json())
        .then(notifications => {
            if (notifications.length > 0) {
                notifications.forEach(notification => {
                    // Contoh: Menggunakan toastr untuk menampilkan pop-up notifikasi
                    // Pastikan library toastr sudah ter-include di project kamu
                    toastr.info(notification.judul, 'Notifikasi');

                    //menampilkan notifikasi dengan custom popup, contoh:
                    const notifElement = document.createElement('div');
                    notifElement.classList.add('notif-popup');
                    notifElement.innerHTML = `
                        <strong>${notification.judul}</strong>
                        <p>${notification.isi_pesan}</p>
                    `;
                    document.body.appendChild(notifElement);
                    
                    // Hapus popup setelah beberapa detik
                    setTimeout(() => {
                        notifElement.remove();
                    }, 4000);
                    
                });
            }
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
        });
});
