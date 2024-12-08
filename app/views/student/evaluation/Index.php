<?php require_once __DIR__ . '/../../components/header.php'; ?>


<body class="h-full">


    <?php require_once __DIR__ . '/../../components/student-navbar.php'; ?>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Penilaian </h1>
        </div>
    </header>

    <?php require_once __DIR__ . '/../../components/alert.php'; ?>

    <!-- batas -->
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-2 mx-4">

        <div class="rounded-lg sm:col-span-4 border-b border-gray-900/10 pb-12 shadow p-4 bg-white ">
            <div>
                <h2 class="text-xl mb-4 sm:col-span-6 text-center">
                    <b>
                        Lembar Penilaian
                    </b>
                </h2>
                <b class="overflow-x-auto">
                    <h1 class="">Nis :<?= htmlspecialchars($siswa['nis']); ?></h1>
                    <h1 class="">Nama Siswa :<?= htmlspecialchars($siswa['nama']); ?></h1>
                    <h1 class="">Tempat PKL :<?= htmlspecialchars($siswa['dudi']); ?></h1>
                    <h1 class="">Mentor PKL :<?= htmlspecialchars($siswa['instruktur']); ?></h1>
                    <h1 class="">Pembimbing Sekolah :<?= htmlspecialchars($siswa['pembimbing']); ?></h1>
                    <h1 class="">Proyek / Pekerjaan :<?= htmlspecialchars($observation['job'] ?? '') ?: ''; ?></h1>
                </b>
                <div class="mt-6 ">

                    <dl class="divide-y ">
                        <?php foreach ($learnings as $learn): ?>
                            <input type="hidden" name="id-<?= htmlspecialchars($learn['id']); ?>" value="<?= htmlspecialchars($learn['id']); ?>">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-0 divide-gray-700 border-t border-gray-700">
                                <dt class="text-sm/6 font-medium text-gray-900 sm:col-span-3 sm:mt-0 t"><?= htmlspecialchars($learn['objective']); ?><small class="text-red-600">*0-100</small></dt>
                                <dt class="text-sm/6 font-medium text-gray-900 sm:col-span-1 sm:mt-0 ">
                                    <p>Skor</p>
                                    <input type="number" name="score-<?= htmlspecialchars($learn['id']); ?>" id="score-<?= htmlspecialchars($learn['id']); ?>" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Skor 0-100" value="<?= htmlspecialchars($learn['score']); ?>" readonly>
                                </dt>
                                <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 ">
                                    <p class="font-medium text-gray-900">Deskripsi</p>
                                    <textarea id="desc-<?= htmlspecialchars($learn['id']); ?>" name="desc-<?= htmlspecialchars($learn['id']); ?>" rows="4" class="sm:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deskripsi (Dipindah dari lembar obervasi peserta didik)" readonly><?= htmlspecialchars($learn['description']); ?></textarea>
                                </dd>
                            </div>
                        <?php endforeach; ?>
                        <!-- <div class="flex justify-end px-4">
                            <a href="/siswa/" class="text-sm/6 font-semibold text-gray-900 py-2 px-4">
                                Batal
                            </a>
                            <button type="submit" class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Simpan perubahan</button>
                        </div> -->
                    </dl>
                </div>
            </div>
        </div>

        <div class=" rounded-lg sm:col-span-2">

            <div class="shadow rounded-lg p-4 bg-white dark:bg-slate-500">

                <div class="sm:col-span-6">
                    <h2 class="text-xl mb-4 sm:col-span-6 text-center" id="kehadiran">
                        <b>
                            Kehadiran
                        </b>
                    </h2>

                </div>

                <div class="sm:grid sm:grid-cols-2 sm:gap-4">
                    <label for="sick" class="block text-sm/6 font-medium text-gray-900">Sakit :</label>
                    <input type="number" id="sick" name="sakit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value='<?= htmlspecialchars($precences['sick']); ?>' readonly />

                    <label for="permisi" class="block text-sm/6 font-medium text-gray-900">Izin :</label>
                    <input type="number" id="permisi" name="izin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value='<?= htmlspecialchars($precences['permission']); ?>' readonly />

                    <label for="firmless" class="block text-sm/6 font-medium text-gray-900">Tanpa Keterangan :</label>
                    <input type="number" id="firmless" name="bolos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value='<?= htmlspecialchars($precences['confirmless']); ?>' readonly />
                </div>
            </div>
        </div>
    </div>
</body>