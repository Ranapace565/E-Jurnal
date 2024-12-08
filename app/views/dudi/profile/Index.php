<?php require_once __DIR__ . '/../../components/header.php'; ?>

<body class="h-full">
    <?php require_once __DIR__ . '/../../components/dudi-navbar.php'; ?>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Kelola Profile</h1>
        </div>
    </header>


    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-2">
        <!-- Sidebar -->
        <?php require_once __DIR__ . '/Akses.php'; ?>

        <div class="rounded-lg sm:col-span-4 border-b border-gray-900/10 pb-12 shadow p-4 bg-white ">

            <h2 class="text-2xl flex justify-center w-full mb-4" id="identitas">
                <b>
                    Identitas Siswa
                </b>
            </h2>
            <?php include __DIR__ . '/Upload-Foto2.php' ?>

            <?php require_once __DIR__ . '/../../components/alert.php'; ?>

            <form action="/dudi/profile#identitas" method="POST">
                <input type="hidden" name="_method" value="UPDATE">
                <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">

                <div class="space-y-12">

                    <div>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            <!-- nama -->
                            <label for="nama" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nama Instansi</label>
                            <div class="mt-2 sm:col-span-3">
                                <input type="text" name="nama" id="nama" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong"
                                    value="<?= htmlspecialchars($data['nama']); ?>">
                            </div>

                            <!-- tempat lahir -->
                            <label for="mentor" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Mentor Instansi</label>
                            <div class="mt-2 sm:col-span-3">
                                <input type="text" name="mentor" id="mentor" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong" value="<?= htmlspecialchars($data['mentor']); ?>">
                            </div>

                            <label for="alamat" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Alamat Instansi</label>

                            <textarea id="alamat" name="alamat" rows="4" class="sm:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?= htmlspecialchars($data['alamat']); ?></textarea>

                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="/siswa/profile" class="text-sm/6 font-semibold text-gray-900">
                                Batal
                            </a>
                            <!-- <button type="button" class="text-sm/6 font-semibold text-gray-900">Batal</button> -->
                            <button type="submit" class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Simpan perubahan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mx-auto max-w-7xl lg:px-28 py-6 px-2 ">
        <?php require_once __DIR__ . '/Akses.php'; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const imgElement = document.getElementById("image");
            const svgPlaceholder = document.getElementById("placeholder-icon");

            if (!imgElement.src || imgElement.src === window.location.href) {
                // Jika src kosong atau default, sembunyikan img dan tampilkan svg
                imgElement.classList.add("hidden");
                svgPlaceholder.classList.remove("hidden");
            }
        });
    </script>

</body>