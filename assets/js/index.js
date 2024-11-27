window.addEventListener("scroll", function() {
    var header = document.querySelector("nav");
    header.classList.toggle("sticky", window.scrollY > 0);
});

fetch('Layout/navbar/navbarIndex.php')
    .then(response => response.text())
    .then(data => document.getElementById('navbar').innerHTML = data);

window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-links a');

    sections.forEach((section, index) => {
        const rect = section.getBoundingClientRect();
        // Cek apakah section terlihat
        if (rect.top <= 50 && rect.bottom >= 50) {
            // Hapus kelas aktif dari semua link
            navLinks.forEach(link => link.classList.remove('active'));
            // Temukan link yang sesuai berdasarkan ID
            const activeLink = document.querySelector(`.nav-links a[href="#${section.id}"]`);
            if (activeLink) {
                activeLink.classList.add('active'); // Tambahkan kelas aktif
            }
        }
    });
});