<?php require_once __DIR__ . '/../../components/header.php'; ?>

<body class="h-full">
    <?php require_once __DIR__ . '/../../components/dudi-navbar.php'; ?>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <?php foreach ($activitys as $activity) : ?>


                <?php $nama = $activity['student_name']; ?>
            <?php endforeach ?>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Kelola Kegiatan <?php $nama ?></h1>
        </div>
    </header>

    <?php require_once __DIR__ . '/../../components/alert.php'; ?>

    <!-- batas -->

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-8 mt-4">
        <div class="mx-auto max-w-screen-lg px-4 2xl:px-0">


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-b border-t border-gray-200 py-4 dark:border-gray-700 md:py-8 xl:gap-16">
                <a href="/dudi/kegiatan?approve=3#main">
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
                </a>
                <a href="/dudi/kegiatan?approve=1#main">
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
                </a>
                <a href="/dudi/kegiatan?approve=2#main">
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
                </a>

            </div>

            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800 md:p-8" id="main">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4">
                    <div class="w-full md:w-1/2" id="search">
                        <form class="flex items-center" action="/dudi/kegiatan#search" method="GET">
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


                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <?php require_once __DIR__ . '/Action.php' ?>
                        </div>
                    </div>
                </div>
                <?php require_once __DIR__ . '/../../components/alert.php'; ?>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100" id="table">
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
                                $cardClass = '';

                                if ($activity['approve'] == 1) {
                                    $rowClass = 'bg-green-100';
                                    $cardClass = 'bg-green-600';
                                    $approveText = 'Diterima';
                                } elseif ($activity['approve'] == 3) {
                                    $rowClass = 'bg-yellow-50';
                                    $cardClass = 'bg-yellow-400 te';
                                    $approveText = 'Proses';
                                } elseif ($activity['approve'] == 2) {
                                    $rowClass = 'bg-red-100';
                                    $cardClass = 'bg-red-700';
                                    $approveText = 'Ditolak';
                                }
                                ?>
                                <tr class="<?= $rowClass; ?> border-b border-blue-400 hover:bg-blue-500" onclick="openModal(<?= htmlspecialchars($activity['id']); ?>)">
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
                                        <!-- Tombol untuk dropdown actions -->
                                        <button
                                            id="button-<?= htmlspecialchars($activity['id']); ?>"
                                            data-dropdown-toggle="dropdown-<?= htmlspecialchars($activity['id']); ?>"
                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>

                                <?php include __DIR__ . '/Modal-Update.php' ?>

                                <script>
                                    function openModal(activityId) {
                                        // Mengambil modal berdasarkan ID aktivitas
                                        const modal = document.getElementById(activityId + 'update');

                                        // Menampilkan modal
                                        modal.classList.remove('hidden');

                                        // Menambahkan event listener untuk menutup modal ketika klik di luar modal
                                        modal.addEventListener('click', function(event) {
                                            if (event.target === modal) {
                                                modal.classList.add('hidden');
                                            }
                                        });
                                    }
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const closeButtons = document.querySelectorAll('[data-modal-toggle]');
                                        closeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const modalId = button.getAttribute('data-modal-toggle');
                                                const modal = document.getElementById(modalId);
                                                if (modal) {
                                                    modal.classList.add('hidden'); // Menyembunyikan modal
                                                }
                                            });
                                        });
                                    });
                                </script>
                                </li>

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
                    <a href="<?= $currentPage > 1 ? '/dudi/kegiatan?page=' . ($currentPage - 1) . '&search=' . htmlspecialchars($search) . '&approve=' . htmlspecialchars($approve) : '#' ?>#main"
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 <?= $currentPage == 1 ? 'cursor-not-allowed opacity-50' : '' ?>">
                        Sebelumnya
                    </a>
                </li>

                <!-- Nomor Halaman -->
                <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                    <li>
                        <a href="/dudi/kegiatan?page=<?= $page ?>&search=<?= htmlspecialchars($search) ?>&approve=<?= htmlspecialchars($approve) ?>#main"
                            class="flex items-center justify-center px-3 h-8 leading-tight <?= $page == $currentPage ? 'text-blue-600 border-gray-300 bg-blue-50' : 'text-gray-500 bg-white' ?>">
                            <?= $page ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <!-- Tombol Next -->
                <li>
                    <a href="<?= $currentPage < $totalPages ? '/dudi/kegiatan?page=' . ($currentPage + 1) . '&search=' . htmlspecialchars($search) . '&approve=' . htmlspecialchars($approve) : '#' ?>#main"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 <?= $currentPage == $totalPages ? 'cursor-not-allowed opacity-50' : '' ?>">
                        Selanjutnya
                    </a>
                </li>
            </ul>
        </nav>
        <!--  -->
    </nav>
</body>