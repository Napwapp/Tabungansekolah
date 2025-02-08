    // Form handling untuk Ubah Kata Sandi
const passwordForm = document.getElementById('passwordForm');
    const message = document.getElementById('message');
   
    passwordForm.addEventListener('submit', function (e) {
    e.preventDefault();
   
        const currentPassword = document.getElementById('currentPassword').value;
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
   
        // Validasi input
        if (newPassword !== confirmPassword) {
            message.style.display = 'block';
            message.textContent = 'Kata sandi baru tidak sesuai dengan konfirmasi.';
            return;
        }
   
        if (newPassword.length < 8) {
            message.style.display = 'block';
            message.textContent = 'Kata sandi baru harus minimal 8 karakter.';
                return;
            }
   
            // Simulasi perubahan kata sandi berhasil
            message.style.display = 'block';
            message.textContent = 'Kata sandi berhasil diubah!';
            message.classList.remove('error');
            message.classList.add('success');
   
            // Reset form
            passwordForm.reset();
           });