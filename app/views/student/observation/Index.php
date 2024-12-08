<?php require_once __DIR__ . '/../../components/header.php'; ?>

<body class="h-full">
    <?php require_once __DIR__ . '/../../components/student-navbar.php'; ?>
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
                        Lembar Observasi Anda
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

                    <div class="divide-y ">
                        <div class=" py-6 sm:grid sm:grid-cols-6 sm:gap-0 sm:px-0 divide-gray-700 border-t border-gray-700">
                            <?php $no = 0;
                            foreach ($indicators as $indicator) :  ?>
                                <dt class="text-sm/6 font-medium text-gray-900 sm:col-span-4 sm:mt-0 divide-gray-700 border border-gray-700">

                                    <div class="px-4 sm:grid sm:grid-cols-6 sm:gap-0 sm:px-0">
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
                                                    <div class="flex">
                                                        <h2>Capai :</h2>
                                                        <label for="" class="<?= $indictory['achievement'] == 2 ? 'text-red-700' : 'YA'; ?>">
                                                            <?= $indictory['achievement'] == 2 ? 'Tidak' : 'Ya'; ?>
                                                        </label>
                                                    </div>
                                                </div>

                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </dt>
                                <dd class="min-h-text-2xl text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 divide-gray-700 border border-gray-700 mb-4 sm:mb-0">
                                    <p class="px-2 text-sm font-medium text-gray-900">
                                        Catatan <?= $no ?> : <?= htmlspecialchars($indicator['description']); ?>
                                    </p>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>