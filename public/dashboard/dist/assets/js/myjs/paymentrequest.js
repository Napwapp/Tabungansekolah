document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".aksi-item").forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            let form = this.closest("form");
            let url = form.action;
            // Tentukan status berdasarkan URL (jika URL mengandung "Sukses", status = "Sukses", jika tidak, "Gagal")
            let status = url.includes("Sukses") ? "Sukses" : "Gagal";
            let aksi = status === "Sukses" ? "menyetujui" : "menolak";

            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda yakin ingin " + aksi + " transaksi ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, " + aksi + "!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gunakan FormData untuk mengambil semua data form termasuk hidden field
                    let formData = new FormData(form);
                    // Kirim AJAX request
                    fetch(url, {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Berhasil!", data.message, "success").then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Gagal!", data.message, "error");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire("Error!", "Terjadi kesalahan pada server!", "error");
                    });
                }
            });
        });
    });
});
