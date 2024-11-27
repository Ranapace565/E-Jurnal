<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/tailwind.css">
    <link rel="stylesheet" href="/assets/css/navbarDUDI.css">
    <script src="resource/javaScript/index.js"></script>
    <script src="resource/javaScript/menuNavbar.js"></script>
</head>

<body class="w-full h-full ">
    <header class="fixed z-10 w-full">
        <?php include(__DIR__ . '/../Layout/navbar/navbarDudi.php'); ?>
    </header>

    <section class="flex justify-center items-center">
        <div class="w-[80%] md:w-4/6 lg:w-2/4 p-8 mt-48 md:p-16 lg:p-16 bg-white rounded-3xl shadow-blurShadow">
            <h1 class="w-full text-center font-semibold text-primary-900 text-3xl">Detail Kegiatan</h1>
            <h1 class="w-full text-center font-semibold text-primary-900 text-3xl mb-12">Bayu Firmansayah</h1>

            <form class="flex flex-col" action="">
                <label class="text-primary-900 font-semibold text-2xl mt-6" for="">Tanggal Kegiatan</label>
                <p class="rounded-lg mt-1 h-11 w-56 text-center" type="text">31-31-3131</p>

                <label class="text-primary-900 font-semibold text-2xl mt-6" for="">Nama Kegiatan</label>
                <p class="rounded-lg mt-1 h-11" type="text">Gulunng Kabel</p>

                <label class="text-primary-900 font-semibold text-2xl mt-6" for="">Deskripsi Kegiatan</label>
                <p class="rounded-lg mt-1 h-44 text-justify" type="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat, quia beatae. Odit quod dolores, doloribus in voluptas nesciunt obcaecati omnis reprehenderit laboriosam eaque doloremque ipsa quaerat non eius esse adipisci!</p>

                <label class="text-primary-900  font-semibold text-2xl mt-6 " for="">Status</label>
                <div class="flex rounded-lg mt-1 h-11 text-left font-semibold items-center justify-start ">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="1-case2" value="Di Setujui" class="text-blue-700 focus:ring-2 focus:ring-blue-500">
                        <span>Setujui</span>
                    </label>

                    <!-- Opsi kedua -->
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="1-case2" value="Di Tolak" class="text-blue-700 focus:ring-2 focus:ring-blue-500 ml-8">
                        <span>Tolak</span>
                    </label>
                </div>

                <div class="w-full flex lg:flex-row md:flex-col flex-col  justify-between mt-8 ">
                    <a class="w-auto px-8 h-full mt-8 text-primary-900 text-center text-base font-semibold rounded-lg py-4 border border-primary-900 hover:bg-primary-900 active:bg-gray-200 hover:text-white duration-500" href="">Kembali Ke Halaman Siswa</a>
                    <a class="w-auto px-8 h-full mt-8 text-primary-900 text-center text-base font-semibold rounded-lg py-4 border border-primary-900 hover:bg-primary-900 active:bg-gray-200 hover:text-white duration-500" href="">Simpan</a>
                </div>

            </form>
        </div>
    </section>

    <footer class=" w-full bottom-0 p-8 bg-primary-950 mt-32">
        <p class="text-white ">© Copyright BismilahIP4. All Right Reserved</p>
    </footer>
</body>

</html>