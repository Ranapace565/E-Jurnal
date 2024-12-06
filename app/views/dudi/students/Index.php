<?php require_once __DIR__ . '/../../components/header.php'; ?>

<body>
    <?php require_once __DIR__ . '/../../components/dudi-navbar.php'; ?>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Daftar Siswa</h1>
        </div>
    </header>
    <?php require_once __DIR__ . '/../../components/alert.php'; ?>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div
                class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" action="/dudi/siswa" method="GET">
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
                    </div>
                </div>
                <?php require_once __DIR__ . '/../../components/alert.php'; ?>
                <div class="overflow-x-auto">
                    <table
                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">NIS</th>
                                <th scope="col" class="px-4 py-3">Nama</th>
                                <th scope="col" class="px-4 py-3">Aktivitas</th>
                                <th scope="col" class="px-4 py-3">Kelamin</th>
                                <th scope="col" class="px-4 py-3">Pembimbing</th>
                                <th scope="col" class="px-4 py-3">Alamat</th>

                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student): ?>
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?= htmlspecialchars($student['nis']); ?>
                                    </th>
                                    <td class="px-4 py-3"><?= htmlspecialchars($student['nama']); ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($student['nama']); ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($student['kelamin']); ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($student['pembimbing']); ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($student['alamat']); ?></td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <!-- Modal-Action.php -->
                                        <button
                                            id="apple-imac-27-dropdown-button"
                                            data-dropdown-toggle="<?= htmlspecialchars($student['nis']); ?>-button"
                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg
                                                class="w-5 h-5"
                                                aria-hidden="true"
                                                fill="currentColor"
                                                viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div
                                            id="<?= htmlspecialchars($student['nis']); ?>-button"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul
                                                class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="apple-imac-27-dropdown-button">
                                                <li>
                                                    <a
                                                        href="/dudi/detail-siswa?id=<?= htmlspecialchars($student['nis']); ?>"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Data Siswa</a>
                                                </li>
                                                <li>
                                                    <form action="/dudi/kegiatan" method="POST">
                                                        <input type="hidden" name="_method" value="INDEX">
                                                        <input type="hidden" name="id" value="<?= htmlspecialchars($student['nis']); ?>">
                                                        <button class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Kegiatan</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <a
                                                        href="/dudi/observsi?id=<?= htmlspecialchars($student['nis']); ?>"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Observasi</a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="/dudi/penilaian?id=<?= htmlspecialchars($student['nis']); ?>"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Penilaian</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col items-center py-4 mb-8">
                    <span class="text-sm text-gray-700 dark:text-gray-400 mb-4">
                        Menampilkan
                        <span class="font-semibold text-gray-900 dark:text-white"><?= (($currentPage - 1) * $limit) + 1 ?></span>
                        sampai
                        <span class="font-semibold text-gray-900 dark:text-white"><?= min($currentPage * $limit, $totalStudents) ?></span>
                        dari
                        <span class="font-semibold text-gray-900 dark:text-white"><?= $totalStudents ?></span>
                    </span>
                    <!--  -->
                    <nav aria-label="Page navigation example">
                        <ul class="inline-flex -space-x-px text-sm">
                            <!-- Tombol Previous -->
                            <li>
                                <a href="<?= $currentPage > 1 ? '/dudi/siswa?page=' . ($currentPage - 1) . '&search=' . htmlspecialchars($search) : '#' ?>"
                                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?= $currentPage == 1 ? 'cursor-not-allowed opacity-50' : '' ?>">
                                    Previous
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
                    <a href="/dudi/siswa?page=' . $page . '&search=' . htmlspecialchars($search) . '"
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
                    <a href="/dudi/siswa?page=' . $page . '&search=' . htmlspecialchars($search) . '"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ' . ($page === $currentPage ? 'text-blue-600 border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : '') . '">
                    ' . $page . '
                    </a>
                </li>';
                                }
                            }
                            ?>

                            <!-- Tombol Next -->
                            <li>
                                <a href="<?= $currentPage < $totalPages ? '/dudi/siswa?page=' . ($currentPage + 1) . '&search=' . htmlspecialchars($search) : '#' ?>"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?= $currentPage == $totalPages ? 'cursor-not-allowed opacity-50' : '' ?>">
                                    Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!--  -->
                </nav>
            </div>
        </div>
    </section>
</body>