document.addEventListener("DOMContentLoaded", function () {
    const textarea = document.getElementById('input-alamat');
    const submitBtn = document.getElementById('btn-submit-alamat');
    const initialValue = textarea.value.trim();

    textarea.addEventListener('input', function () {
      const currentValue = textarea.value.trim();

      // Aktifkan tombol hanya jika ada perubahan dari nilai awal
      if (currentValue !== initialValue) {
        submitBtn.disabled = false;
      } else {
        submitBtn.disabled = true;
      }
    });
  });
