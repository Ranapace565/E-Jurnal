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
    <nav class="nav-Index" >
        <h3 class="brand">E Jurnal PKL SMEKTA</h3>

        <div class="divNavbar" >
            <ul class="nav-links">
                <a href="#home" class="active" >Beranda</a>
                <a href="#Informasi">Siswa</a>
                <a href="#FiturUtama">Pembimbing</a>
                <a href="#Profil">DU/DI</a>
                <a href="#Profil">Kelompok</a>
            </ul>

            <a class="" href="login.php">
                <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z" clip-rule="evenodd"/>
                </svg>
            </a>
            
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