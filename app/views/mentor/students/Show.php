<?php require_once __DIR__ . '/../../components/header.php'; ?>

<body class="h-full">
    <?php require_once __DIR__ . '/../../components/mentor-navbar.php'; ?>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Informasi Siswa</h1>
        </div>
    </header>



    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-2">

        <div class=""></div>
        <div class="rounded-lg sm:col-span-4 border-b border-gray-900/10 pb-12 shadow p-4 bg-white ">

            <h2 class="text-2xl flex justify-center w-full mb-4" id="identitas">
                <b>
                    Identitas Siswa
                </b>
            </h2>

            <div class="col-span-full">
                <div class="mt-2 flex items-center gap-x-3 flex-col">
                    <!-- Gambar Preview -->
                    <label for="file-upload">
                        <img id="image" src="<?= htmlspecialchars($file['file_path']); ?>" alt="Default Image" class="rounded-full w-40 h-40 md:w-40 md:h-40 object-cover" />
                        <svg id="placeholder-icon" class="size-20 text-gray-300 hidden w-40 h-40 md:w-40 md:h-40"
                            viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </label>
                    <!-- <div class="mt-4 flex text-sm text-gray-600">
                        <label for="file-upload"
                            class="relative cursor-pointer rounded-md bg-white font-semibold text-primary-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-600 focus-within:ring-offset-2 hover:text-primary-500">
                            
                            <input id="file-upload" name="file" type="file" accept=".png,.jpg,.jpeg" class="sr-only"
                                onchange="previewImage(this)">
                        </label>
                    </div> -->
                </div>
            </div>
            <!-- 
            <script>
                function previewImage(input) {
                    const file = input.files[0];
                    const imagePreview = document.getElementById('image');
                    const placeholderIcon = document.getElementById('placeholder-icon');

                    // Validasi jika file tidak dipilih
                    if (!file) {
                        return;
                    }

                    // Preview gambar
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result; // Tampilkan gambar
                        placeholderIcon.classList.add('hidden'); // Sembunyikan placeholder
                    };
                    reader.readAsDataURL(file);
                }
            </script> -->


            <?php require_once __DIR__ . '/../../components/alert.php'; ?>


            <div class="space-y-12">

                <div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                        <!-- nama -->
                        <label for="nama" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nama Siswa</label>
                        <div class="mt-2 sm:col-span-3">
                            <input type="text" name="nama" id="nama" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong"
                                value="<?= htmlspecialchars($data['nama']); ?>">
                        </div>

                        <!-- nis -->
                        <label for="nis" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nomor Induk Siswa</label>
                        <div class="sm:col-span-3">
                            <input type="text" name="id" id="nis" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong" readonly value="<?= htmlspecialchars($data['id']); ?>" readonly>
                        </div>

                        <label for="nisn" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nomor Induk Siswa Nasional</label>
                        <div class="sm:col-span-3">
                            <input type="number" name="nisn" id="nisn" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong" value="<?= htmlspecialchars($data['nisn']); ?>" readonly>
                        </div>

                        <!-- tempat lahir -->
                        <label for="tempat" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Tempat Lahir</label>
                        <div class="mt-2 sm:col-span-3">
                            <input type="text" name="tempat" id="tempat" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong" value="<?= htmlspecialchars($data['tempat']); ?>" readonly>
                        </div>
                        <label for="datepicker-autohide" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Tanggal Lahir</label>

                        <!-- tanggal lahir -->
                        <div class="relative max-w-sm sm:col-span-3">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-autohide"
                                name="tanggal" datepicker datepicker-autohide type="text" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Kosong" value="<?= htmlspecialchars($data['tanggal']); ?>" readonly>
                        </div>

                        <label for="kelamin" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Jenis kelamin</label>

                        <div class="sm:col-span-3 flex flex-col ">
                            <div class="flex items-center mb-4">
                                <input type="text" name="tempat" id="tempat" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong" value="<?= htmlspecialchars($data['kelamin']); ?>" readonly>
                            </div>
                        </div>

                        <!-- darah -->
                        <label for="kelamin" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Golongan Darah</label>

                        <div class="sm:col-span-3 flex flex-col ">
                            <div class="flex items-center mb-4">
                                <input type="text" name="tempat" id="tempat" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong" value="<?= htmlspecialchars($data['darah']); ?>" readonly>
                            </div>
                        </div>


                        <label for="alamat" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Alamat Siswa</label>

                        <textarea id="alamat" name="alamat" rows="4" class="sm:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly><?= htmlspecialchars($data['alamat']); ?></textarea>

                        <label for="telp" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nomor Telepon Aktif</label>
                        <div class="mt-2 sm:col-span-3">
                            <input type="number" name="telp" id="telp" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" pattern=".{12,}" value="<?= htmlspecialchars($data['telp']); ?>" readonly>
                        </div>

                        <label for="catatan" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Catatan Kesehatan</label>

                        <textarea id="catatan" name="catatan" rows="4" class="sm:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly><?= htmlspecialchars($data['catatan']); ?></textarea>

                        <label for="ortu" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nama Orang Tua / Wali</label>
                        <div class="mt-2 sm:col-span-3">
                            <input type="text" name="ortu" id="ortu" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong" value="<?= htmlspecialchars($data['ortu']); ?>" readonly>
                        </div>

                        <label for="alamatortu" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Alamat Orang Tua / Wali</label>
                        <textarea id="alamatortu" name="alamatortu" rows="4" class="sm:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Kosong" readonly><?= htmlspecialchars($data['alamatortu']); ?></textarea>

                        <label for="ortutelp" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nomor Telepon Orang Tua / Wali</label>
                        <div class="mt-2 sm:col-span-3">
                            <input type="number" name="telportu" id="telportu" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" pattern=".{8,}" value="<?= htmlspecialchars($data['telportu']); ?>" readonly>
                        </div>

                        <label for="prodi" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Program Pendidikan</label>
                        <div class="mt-2 sm:col-span-3">
                            <input type="text" name="prodi" id="prodi" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                value="<?= htmlspecialchars($data['prodi']); ?>"

                                readonly>
                        </div>

                        <label for="kompetensi" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Kompetensi Keahlian</label>
                        <div class="mt-2 sm:col-span-3">
                            <input type="text" name="kompetensi" id="kompetensi" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong" value="<?= htmlspecialchars($data['kompetensi']); ?>" readonly>
                        </div>

                        <input type="hidden" name="group" id="group" value="<?= htmlspecialchars($data['group_id']); ?>">
                    </div>
                    <div class="mt-6 flex items-center justify-start gap-x-6">
                        <a href="/pembimbing/siswa" class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>