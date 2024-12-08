<?php require_once __DIR__ . '/../../components/header.php'; ?>

<body class="h-full">
    <?php require_once __DIR__ . '/../../components/dudi-navbar.php'; ?>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Observasi </h1>
        </div>
    </header>
    <!-- start -->

    <?php require_once __DIR__ . '/../../components/alert.php'; ?>

    <div class="mt-10 px-2 mx-4">

        <div class="rounded-lg border-b border-gray-900/10 pb-12 shadow p-4 bg-white ">
            <div>
                <h2 class="text-xl mb-4 text-center">
                    <b>
                        Lembar Observasi
                    </b>
                </h2>
                <b class="overflow-x-auto">
                    <h1 class="text-xl">Nis :<?= htmlspecialchars($siswa['nis']); ?></h1>
                    <h1 class="text-xl">Nama :<?= htmlspecialchars($siswa['nama']); ?></h1>
                    <!-- <?= htmlspecialchars($siswa['nama']); ?> -->
                </b>
                <div class="mt-6 ">

                    <dl class="divide-y ">
                        <form action="/dudi/observasi" method="POST">
                            <input type="hidden" name="_method" value="UPDATE">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-6 sm:gap-0 sm:px-0 divide-gray-700 border-t border-gray-700">
                                <?php $no = 0;
                                foreach ($indicators as $indicator) :  ?>
                                    <dt class="text-sm/6 font-medium text-gray-900 sm:col-span-4 sm:mt-0 divide-gray-700 border-t border-gray-700">

                                        <div class="px-4 sm:grid sm:grid-cols-6 sm:gap-0 sm:px-0 h-full">
                                            <?php $no2 = 1;
                                            $no++ ?>
                                            <?php foreach ($indicatories as $indictory): ?>
                                                <?php if ($indictory['indicators_id'] == $indicator['id']): ?>
                                                    <div class="text-sm/6 font-medium text-gray-900 sm:col-span-4 sm:mt-0 divide-gray-700 border border-gray-700 flex">

                                                        <p class="px-2 text-sm font-medium text-gray-900 ">
                                                            <?= $no ?>.<?= $no2++ ?>
                                                        </p>
                                                        <?= $indictory['objective'] ?>
                                                    </div>
                                                    <div class="text-sm/6 font-medium text-gray-900 sm:col-span-2 sm:mt-0 divide-gray-700 border border-gray-700 flex justify-center">
                                                        <div class="">
                                                            <h2>Capai :</h2>
                                                            <div class="flex items-center mb-4">
                                                                <input id="achievement-<?= $indictory['id'] ?>-1" type="radio" value="1" name="achievement-<?= $indictory['id'] ?>" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?= $indictory['achievement'] == 1 ? 'checked' : ''; ?>>
                                                                <label for="achievement-<?= $indictory['id'] ?>-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ya</label>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <input id="achievement-<?= $indictory['id'] ?>-2" type="radio" value="2" name="achievement-<?= $indictory['id'] ?>" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?= $indictory['achievement'] == 2 ? 'checked' : ''; ?>>
                                                                <label for="achievement-<?= $indictory['id'] ?>-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </dt>
                                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 divide-gray-700 border border-gray-700 h-full mb-4 ">
                                        <p class="px-2 text-sm font-medium text-gray-900 ">
                                            Deskripsi indikator <?= $no ?> :
                                        </p>
                                        <textarea id="desc-<?= htmlspecialchars($indicator['id']); ?>" name="desc-<?= htmlspecialchars($indicator['id']); ?>" rows="4" class="sm:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 " placeholder="<?= htmlspecialchars($indicator['description']); ?>" required><?= htmlspecialchars($indicator['description']); ?></textarea>
                                    </dd>
                                <?php endforeach; ?>
                                <?php $no++ ?>
                                <?php foreach ($notes as $note): ?>
                                    <dt class="text-sm/6 font-medium text-gray-900 sm:col-span-4 sm:mt-0 divide-gray-700 border border-gray-700 flex">
                                        <p class="px-4"><?= $no++ ?></p><?= htmlspecialchars($note['objective']); ?>
                                    </dt>
                                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 divide-gray-700 border border-gray-700 h-full mb-4 ">
                                        <textarea id="note-<?= htmlspecialchars($note['id']); ?>" name="note-<?= htmlspecialchars($note['id']); ?>" rows="4" class="sm:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-full" placeholder="<?= htmlspecialchars($note['description']); ?>" required <?= $no == 6 ? 'readonly' : ''; ?>><?= htmlspecialchars($note['description']); ?></textarea>
                                    </dd>
                                <?php endforeach ?>

                            </div>

                            <div class="mt-6 flex justify-end">
                                <a href="/dudi/siswa" class="text-sm/6 font-semibold text-gray-900 py-2 px-4">
                                    Batal
                                </a>
                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</body>