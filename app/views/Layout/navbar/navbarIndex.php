<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbarIndex.css">
    <script src="resource/javaScript/index.js" ></script>
    <script src="resource/javaScript/menuNavbar.js" ></script>
    <title>hederIndex</title>
</head>

<body>
    <nav class="nav-Index">
        <h3 class="brand">E Jurnal PKL SMEKTA</h3>

        <div class="divNavbar" >
            <ul class="nav-links">
                <a href="#home" class="active" >Beranda</a>
                <a href="#Informasi">Informasi</a>
                <a href="#FiturUtama">Fitur Utama</a>
                <a href="#Profil">Profile</a>
            </ul>

            <a class="btnMasuk" href="login.php">Masuk</a>
            
        </div>

        <div class="menu-toggle" >
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>  

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuTogle = document.querySelector('.menu-toggle input');
        const nav = document.querySelector('.divNavbar');

        if (menuTogle && nav) { // Pastikan elemen ditemukan
            menuTogle.addEventListener('click', function () {
                nav.classList.toggle('slide');
            });
        }
    });
    </script>
</body>

</html>