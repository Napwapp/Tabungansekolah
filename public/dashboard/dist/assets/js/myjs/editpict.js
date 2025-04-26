// Fungsi Loading
function showLoading() {
    const loadingBox = document.createElement('div');
    loadingBox.id = 'loadingBox';
    loadingBox.style.position = 'fixed';
    loadingBox.style.top = '50%';
    loadingBox.style.left = '50%';
    loadingBox.style.transform = 'translate(-50%, -50%)';
    loadingBox.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    loadingBox.style.color = 'white';
    loadingBox.style.padding = '20px';
    loadingBox.style.borderRadius = '5px';
    loadingBox.style.zIndex = '9999';
    loadingBox.style.display = 'flex';
    loadingBox.style.alignItems = 'center';
    loadingBox.style.gap = '15px';

    const spinner = document.createElement('div');
    spinner.style.width = '40px';
    spinner.style.height = '40px';
    spinner.style.border = '3px solid rgba(255, 255, 255, 0.3)';
    spinner.style.borderTop = '3px solid white';
    spinner.style.borderRadius = '50%';
    spinner.style.animation = 'spin 1s linear infinite';

    const text = document.createElement('div');
    text.textContent = 'Mengirim data...';

    loadingBox.appendChild(spinner);
    loadingBox.appendChild(text);
    document.body.appendChild(loadingBox);
}

function hideLoading() {
    const loadingBox = document.getElementById('loadingBox');
    if (loadingBox) loadingBox.remove();
}

// Event DOM Loaded
document.addEventListener('DOMContentLoaded', function () {
    const profileAvatar = document.querySelector('.profile-avatar');
    const modal = document.getElementById('profileModal');
    const modalImage = document.getElementById('modalImage');
    const closeButton = document.querySelector('.close-button');
    const editButton = document.querySelector('.edit-profile-button');
    const inputEditFoto = document.getElementById('inputEditFoto');

    profileAvatar.addEventListener('click', function () {
        const imgSrc = this.querySelector('img').src;
        modalImage.src = imgSrc;
        profileAvatar.classList.add('clicked');

        setTimeout(() => modal.classList.add('show'), 100);
        document.body.style.overflow = 'hidden';
    });

    closeButton.addEventListener('click', function () {
        modal.classList.remove('show');
        setTimeout(() => {
            profileAvatar.classList.remove('clicked');
            document.body.style.overflow = '';
        }, 300);
    });

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.remove('show');
            setTimeout(() => {
                profileAvatar.classList.remove('clicked');
                document.body.style.overflow = '';
            }, 300);
        }
    });

    editButton.addEventListener('click', function () {
        inputEditFoto.click();
    });

    inputEditFoto.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('gambar', file);

            // Preview gambar lokal
            const reader = new FileReader();
            reader.onload = function (e) {
                modalImage.classList.add('loading-image');
                modalImage.src = e.target.result;
            };
            reader.readAsDataURL(file);

            inputEditFoto.disabled = true;
            showLoading();

            fetch('/update-foto-profil', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        showToast('success', result.message);
                        // Update gambar di modal
                        modalImage.src = result.newImageUrl;
            
                        // ✅ Update gambar di halaman profil utama
                        const mainImage = document.getElementById('profileImageMain');
                        if (mainImage) {
                            mainImage.src = result.newImageUrl;
                        }            
                    } else {
                        showToast('error', result.message);
                    }
                })
                .catch(() => {
                    showToast('error', 'Terjadi kesalahan saat mengunggah gambar.');
                })
                .finally(() => {
                    inputEditFoto.disabled = false;
                    hideLoading();
                    modalImage.classList.remove('loading-image');
                });
        }
    });

    // Hapus efek blur saat gambar selesai dimuat
    modalImage.addEventListener('load', () => {
        modalImage.classList.remove('loading-image');
    });
});
