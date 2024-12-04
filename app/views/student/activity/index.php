<?php require_once __DIR__ . '/../../components/header.php'; ?>

<body class="h-full">
    <?php require_once __DIR__ . '/../../components/student-navbar.php'; ?>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Kelola Kegiatan</h1>
        </div>
    </header>

    <?php require_once __DIR__ . '/../../components/alert.php'; ?>

    <!-- batas -->

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-8 mt-4">
        <div class="mx-auto max-w-screen-lg px-4 2xl:px-0">


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-b border-t border-gray-200 py-4 dark:border-gray-700 md:py-8 xl:gap-16 ">
                <div class="bg-yellow-300 flex items-center justify-center text-white p-4 rounded-lg shadow-2xl">
                    <svg class="w-10 h-10 md:w-20 md:h-20 dark:text-white bg-yellow-400 rounded-full" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

                    </svg>
                    <div class="mx-8">
                        <p>
                            <b>
                                Proses
                            </b>
                        </p>
                        <span class="flex items-center text-3xl font-bold "><?= min($currentPage * $limit, $totalPending) ?>
                        </span>
                    </div>
                </div>
                <div class="bg-green-500 flex items-center justify-center text-white p-4 rounded-lg shadow-2xl">
                    <svg class="w-10 h-10 md:w-20 md:h-20  dark:text-white bg-green-600 rounded-full" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div class="mx-8">
                        <p>
                            <b>
                                Diterima
                            </b>
                        </p>
                        <span class="flex items-center text-3xl font-bold "><?= min($currentPage * $limit, $totalApproved) ?>
                        </span>
                    </div>
                </div>
                <div class="bg-red-600 flex  items-center justify-center text-white p-4 rounded-lg shadow-2xl">
                    <svg class="w-10 h-10 md:w-20 md:h-20  dark:text-white bg-red-700 rounded-full" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

                    </svg>
                    <div class="mx-8">
                        <p>
                            <b>
                                Ditolak
                            </b>
                        </p>
                        <span class="flex items-center text-3xl font-bold "><?= min($currentPage * $limit, $totalRejected) ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800 md:p-8">


                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4">
                    <div class="w-full md:w-1/2" id="search">
                        <form class="flex items-center" action="/siswa/kegiatan#search" method="GET">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg
                                        aria-hidden="true"
                                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor"
                                        viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="simple-search"
                                    name="search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                                    placeholder="Search" />
                            </div>
                        </form>
                    </div>

                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <!--  -->
                        <?php require_once __DIR__ . '/Modal-Insert.php'; ?>


                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <?php require_once __DIR__ . '/Action.php' ?>
                            <!-- <?php require_once __DIR__ . '/Filter.php' ?> -->
                        </div>
                    </div>
                </div>
                <?php require_once __DIR__ . '/../../components/alert.php'; ?>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100">
                        <thead class="text-xs text-white uppercase bg-blue-600 border-b border-blue-400 dark:text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aktivitas
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activitys as $activity) : ?>
                                <?php
                                $rowClass = '';
                                $approveText = '';

                                if ($activity['approve'] == 1) {
                                    $rowClass = 'bg-green-100';
                                    $approveText = 'Diterima';
                                } elseif ($activity['approve'] == 0) {
                                    $rowClass = 'bg-yellow-50';
                                    $approveText = 'Proses';
                                } elseif ($activity['approve'] == 2) {
                                    $rowClass = 'bg-red-100';
                                    $approveText = 'Ditolak';
                                }
                                ?>
                                <tr class="<?= $rowClass; ?> border-b border-blue-400 hover:bg-blue-500">
                                    <td class="px-6 py-4 text-gray-600">
                                        <?= htmlspecialchars($activity['date']); ?>
                                    </td>
                                    <th scope="row" class="px-6 py-4 text-gray-600 whitespace-nowrap dark:text-blue-100">
                                        <?= htmlspecialchars($activity['activity']); ?>
                                    </th>
                                    <td class="px-6 py-4 text-gray-600">
                                        <?= htmlspecialchars($approveText); ?>
                                    </td>
                                    <td class="px-6 py-4 flex items-center justify-end">
                                        <button
                                            id="button-<?= htmlspecialchars($activity['id']); ?>"
                                            data-dropdown-toggle="dropdown-<?= htmlspecialchars($activity['id']); ?>"
                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg
                                                class="w-5 h-5"
                                                aria-hidden="true"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div
                                            id="dropdown-<?= htmlspecialchars($activity['id']); ?>"
                                            class="hidden z-50 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 absolute">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                                <li>
                                                    <a
                                                        href="/admin/show-mentor?id=<?= htmlspecialchars($activity['id']); ?>"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                                </li>
                                                <li>
                                                    <form action="/admin/data-mentor" method="POST" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" onsubmit="return confirm('Apakah Anda yakin ingin mereset akses?')">
                                                        <input type="hidden" name="_method" value="RESET">
                                                        <input type="hidden" name="id" value="<?= htmlspecialchars($activity['id']); ?>">
                                                        <button type="submit" class="w-full text-left">
                                                            Reset Password
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                            <div class="py-1">
                                                <form action="/admin/data-mentor" method="POST" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data?')">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($activity['id']); ?>">
                                                    <button type="submit" class="w-full text-left">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <nav class="flex flex-col items-center py-4 mb-8">
        <span class="text-sm text-gray-700 dark:text-gray-400 mb-4">
            Menampilkan
            <span class="font-semibold text-gray-900 dark:text-white"><?= (($currentPage - 1) * $limit) + 1 ?></span>
            sampai
            <span class="font-semibold text-gray-900 dark:text-white"><?= min($currentPage * $limit, $totalActivitys) ?></span>
            dari
            <span class="font-semibold text-gray-900 dark:text-white"><?= $totalActivitys ?></span>
        </span>
        <!--  -->
        <nav aria-label="Page navigation example">
            <ul class="inline-flex -space-x-px text-sm">
                <!-- Tombol Previous -->
                <li>
                    <a href="<?= $currentPage > 1 ? '/siswa/kegiatan?page=' . ($currentPage - 1) . '&search=' . htmlspecialchars($search) : '#' ?>"
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?= $currentPage == 1 ? 'cursor-not-allowed opacity-50' : '' ?>">
                        Sebelumnya
                    </a>
                </li>

                <!-- Nomor Halaman -->
                <!-- Nomor Halaman -->
                <?php
                // Menentukan rentang halaman yang akan ditampilkan
                if ($totalPages <= 2) {
                    // Jika ada hanya 1 atau 2 halaman, tampilkan semua halaman
                    for ($page = 1; $page <= $totalPages; $page++) {
                        echo '<li>
                    <a href="/siswa/kegiatan?page=' . $page . '&search=' . htmlspecialchars($search) . '"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ' . ($page === $currentPage ? 'text-blue-600 border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : '') . '">
                    ' . $page . '
                    </a>
                </li>';
                    }
                } else {
                    // Jika ada lebih dari 2 halaman, tampilkan 1, halaman tengah, dan halaman terakhir
                    $pageRange = [1, $currentPage - 1, $currentPage, $currentPage + 1, $totalPages];
                    $pageRange = array_unique(array_filter($pageRange, function ($page) use ($totalPages) {
                        return $page > 0 && $page <= $totalPages;
                    }));

                    // Menampilkan halaman
                    foreach ($pageRange as $page) {
                        echo '<li>
                    <a href="/siswa/kegiatan?page=' . $page . '&search=' . htmlspecialchars($search) . '"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 border dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ' . ($page === $currentPage ? 'text-blue-600 border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : '') . '">
                    ' . $page . '
                    </a>
                </li>';
                    }
                }
                ?>

                <!-- Tombol Next -->
                <li>
                    <a href="<?= $currentPage < $totalPages ? '/admin/data-siswa?page=' . ($currentPage + 1) . '&search=' . htmlspecialchars($search) : '#' ?>"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?= $currentPage == $totalPages ? 'cursor-not-allowed opacity-50' : '' ?>">
                        Selanjutnya
                    </a>
                </li>
            </ul>
        </nav>
        <!--  -->
    </nav>
</body>