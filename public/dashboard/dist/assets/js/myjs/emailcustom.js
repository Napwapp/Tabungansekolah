document.addEventListener("DOMContentLoaded", function () {
    let lastScrollTop = 0;
    const button = document.getElementById("floating-button");
    const emailListWrapper = document.querySelector(".email-app-list-wrapper"); // Ambil elemen wrapper

    emailListWrapper.addEventListener("scroll", function () {
        let scrollTop = emailListWrapper.scrollTop; // Gunakan scrollTop dari elemen wrapper

        if (scrollTop > lastScrollTop + 50) {
            // Scroll ke bawah, tombol mengecil
            button.classList.add("shrink");
        } else if (scrollTop < lastScrollTop - 50) {
            // Scroll ke atas, tombol kembali besar
            button.classList.remove("shrink");
        }

        lastScrollTop = scrollTop;
    });
});