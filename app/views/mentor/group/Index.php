<?php require_once __DIR__ . '/../../components/header.php'; ?>

<body class="h-full">
    <?php require_once __DIR__ . '/../../components/mentor-navbar.php'; ?>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Daftar Kelompok</h1>
        </div>
    </header>
    <!-- start -->

    <?php require_once __DIR__ . '/../../components/alert.php'; ?>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl ">
            <!-- Start coding here -->
            <div
                class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                <!-- <?php require_once __DIR__ . '/../../components/alert.php'; ?> -->
                <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
                    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

                        <div class="mb-4 grid gap-3 sm:grid-cols-2 md:mb-8 ">
                            <?php foreach ($Groups as $group): ?>

                                <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab-<?= htmlspecialchars($group['id']); ?>" data-tabs-toggle="#<?= htmlspecialchars($group['id']); ?>" role="tablist">
                                        <li class="me-2">
                                            <button id="about-tab-<?= htmlspecialchars($group['id']); ?>" data-tabs-target="#about-<?= htmlspecialchars($group['id']); ?>" type="button" role="tab" class="inline-block p-4 text-blue-600 rounded-ss-lg">Tim</button>
                                        </li>
                                        <li class="me-2">
                                            <button id="services-tab-<?= htmlspecialchars($group['id']); ?>" data-tabs-target="#services-<?= htmlspecialchars($group['id']); ?>" type="button" role="tab" class="inline-block p-4">Pembimbing</button>
                                        </li>
                                        <li class="me-2">
                                            <button id="statistics-tab-<?= htmlspecialchars($group['id']); ?>" data-tabs-target="#statistics-<?= htmlspecialchars($group['id']); ?>" type="button" role="tab" class="inline-block p-4">Siswa</button>
                                        </li>

                                    </ul>
                                    <div id="<?= htmlspecialchars($group['id']); ?>">
                                        <div id="about-<?= htmlspecialchars($group['id']); ?>" class="hidden p-4 bg-white rounded-lg">
                                            <!-- date -->
                                            <div class="flex justify-between">
                                                <div class="p-2 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                                                    <span class="font-medium"><?php echo $group['start'] ?> -> <?php echo $group['finish'] ?></span>
                                                </div>

                                            </div>

                                            <div class="flex justify-between items-center mb-5 text-gray-500">
                                                <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                                    <a href="/admin/data-kelompok"><?= htmlspecialchars($group['prodi']); ?></a>
                                                </span>
                                            </div>

                                            <form action="/admin/detail-kelompok" method="POST">
                                                <input type="hidden" name="_method" value="SHOW">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($group['id']); ?>">

                                                <!-- <?= htmlspecialchars($group['Inama']); ?> -->

                                                <button class=" text-3xl font-extrabold tracking-tight text-primary-900 dark:text-white mb-4 text-left" type="submit">

                                                    <?= htmlspecialchars($group['Inama']); ?>
                                                </button>
                                            </form>

                                            <span><?= htmlspecialchars($group['alamat']); ?></span>

                                            <form action="/admin/detail-kelompok" method="POST">
                                                <input type="hidden" name="_method" value="SHOW">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($group['id']); ?>">

                                                <!-- <?= htmlspecialchars($group['Inama']); ?> -->

                                                <button class="mt-4 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">
                                                    Detail Kelompok
                                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                    </svg>
                                                </button>
                                            </form>


                                        </div>
                                        <div id="services-<?= htmlspecialchars($group['id']); ?>" class="hidden p-4 bg-white rounded-lg"> Pembimbing
                                            <h2 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Sekolah :</h2>
                                            <p class="mb-4">
                                                <?= htmlspecialchars($group['Mnama']); ?>
                                            </p>
                                            <h2 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Industri :</h2>
                                            <p class="mb-4">
                                                <?= htmlspecialchars($group['MInama']); ?>
                                            </p>
                                        </div>
                                        <div id="statistics-<?= htmlspecialchars($group['id']); ?>" class="hidden p-4 bg-white rounded-lg">
                                            <b class="mb-4">siswa terdaftar : <?= htmlspecialchars($group['total_students']); ?></b>

                                            <?php $studentGroup = StudentModel::StudentGroup($group['id']); ?>

                                            <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400 mt-4">
                                                <?php foreach ($studentGroup as $student) : ?>

                                                    <li class="grid grid-cols-1 md:grid-cols-2 space-x-2 rtl:space-x-reverse items-center">

                                                        <span class="leading-tight flex">
                                                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                            </svg>
                                                            (
                                                            <b><?= htmlspecialchars($student['id']); ?></b>
                                                            )<?= htmlspecialchars($student['name']); ?>
                                                        </span>
                                                        <div class="flex">
                                                            <form action="/dudi/observasi" method="POST">
                                                                <input type="hidden" name="_method" value="SHOW">
                                                                <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']); ?>">

                                                                <button class=" mt-4 relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800" type="submit">
                                                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                                                        Observasi
                                                                    </span>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                            <form action="/dudi/penilaian" method="POST">
                                                                <input type="hidden" name="_method" value="SHOW">
                                                                <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']); ?>">

                                                                <button class=" mt-4 relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800" type="submit">
                                                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                                                        Nilai
                                                                    </span>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </li>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</body>