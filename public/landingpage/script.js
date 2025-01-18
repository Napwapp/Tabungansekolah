// Event listener untuk scroll
window.addEventListener('scroll', function () {
  const elements = document.querySelectorAll('.scroll-element');

  elements.forEach(element => {
      // Cek apakah elemen berada di dalam viewport
      const position = element.getBoundingClientRect();
      if (position.top < window.innerHeight && position.bottom >= 0) {
          element.classList.add('active'); // Tambahkan kelas jika elemen terlihat
      }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const scrollElements = document.querySelectorAll(".scroll-element");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("active"); // Tambahkan animasi
        } else {
          entry.target.classList.remove("active"); // Opsional: Hapus animasi
        }
      });
    },
    {
      threshold: 0.1, // Elemen harus terlihat 10% untuk memicu
    }
  );

  scrollElements.forEach((el) => observer.observe(el));
});
