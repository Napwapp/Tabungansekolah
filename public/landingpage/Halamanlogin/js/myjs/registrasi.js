document.addEventListener('DOMContentLoaded', function() {
    const closeBtn = document.getElementById('close-alert');
    const alertBox = document.getElementById('error-alert');
    const successBox = document.getElementById('success-alert');
    const successClose = document.getElementById('close-success');

    // hapus pesan error
    if (closeBtn && alertBox) {
        closeBtn.addEventListener('click', function() {
            // Sembunyikan alert secara langsung dari tampilan
            alertBox.style.display = 'none';

            // Ambil URL dan token dari data attribute milik alertBox
            const url = alertBox.getAttribute('data-clear-url');
            const token = alertBox.getAttribute('data-token');

            // Lakukan request AJAX ke backend untuk hapus session errors
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                }
            }).then(response => response.json())
            .then(data => {
                console.log(data.message);
            }).catch(error => {
                console.error('Error clearing session:', error);
            });
        });
    }

    // hapus pesan sukses
    if (successBox && successClose) {
        successClose.addEventListener('click', function () {
            successBox.style.display = 'none';

            const url = successBox.getAttribute('data-clear-url');
            const token = successBox.getAttribute('data-token');

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => console.log(data.message))
            .catch(err => console.error(err));
        });
    }
});
