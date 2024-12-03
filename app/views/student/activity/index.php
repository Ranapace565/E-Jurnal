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
                        <span class="flex items-center text-3xl font-bold ">16
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
                        <span class="flex items-center text-3xl font-bold ">16
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
                        <span class="flex items-center text-3xl font-bold ">16
                        </span>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800 md:p-8">


                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" action="/admin/data-mentor" method="GET">
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
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100">
                        <thead class="text-xs text-white uppercase bg-blue-600 border-b border-blue-400 dark:text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Color
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-yellow-400 border-b border-blue-400 hover:bg-blue-500">
                                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                    Apple MacBook Pro 17"
                                </th>
                                <td class="px-6 py-4">
                                    Silver
                                </td>
                                <td class="px-6 py-4">
                                    Laptop
                                </td>
                                <td class="px-6 py-4">
                                    $2999
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-white hover:underline">Edit</a>
                                </td>
                            </tr>
                            <tr class="bg-green-500 border-b border-blue-400 hover:bg-blue-500">
                                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                    Microsoft Surface Pro
                                </th>
                                <td class="px-6 py-4">
                                    White
                                </td>
                                <td class="px-6 py-4">
                                    Laptop PC
                                </td>
                                <td class="px-6 py-4">
                                    $1999
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-white hover:underline">Edit</a>
                                </td>
                            </tr>
                            <tr class="bg-red-500 border-b border-blue-400 hover:bg-blue-500">
                                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                    Magic Mouse 2
                                </th>
                                <td class="px-6 py-4">
                                    Black
                                </td>
                                <td class="px-6 py-4">
                                    Accessories
                                </td>
                                <td class="px-6 py-4">
                                    $99
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-white hover:underline">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div id="deleteOrderModal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full">
            <div class="relative h-full w-full max-w-md p-4 md:h-auto">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white p-4 text-center shadow dark:bg-gray-800 sm:p-5">
                    <button type="button" class="absolute right-2.5 top-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteOrderModal">
                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100 p-2 dark:bg-gray-700">
                        <svg class="h-8 w-8 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                        </svg>
                        <span class="sr-only">Danger icon</span>
                    </div>
                    <p class="mb-3.5 text-gray-900 dark:text-white"><a href="#" class="font-medium text-primary-700 hover:underline dark:text-primary-500">@heleneeng</a>, are you sure you want to delete this order from your account?</p>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">This action cannot be undone.</p>
                    <div class="flex items-center justify-center space-x-4">
                        <button data-modal-toggle="deleteOrderModal" type="button" class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">No, cancel</button>
                        <button type="submit" class="rounded-lg bg-red-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Yes, delete</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <nav class="flex flex-col items-center py-4 mb-8">
        <span class="text-sm text-gray-700 dark:text-gray-400 mb-4">
            Menampilkan
            <span class="font-semibold text-gray-900 dark:text-white"><?= (($currentPage - 1) * $limit) + 1 ?></span>
            sampai
            <span class="font-semibold text-gray-900 dark:text-white"><?= min($currentPage * $limit, $totalGroups) ?></span>
            dari
            <span class="font-semibold text-gray-900 dark:text-white"><?= $totalGroups ?></span>
        </span>
        <!--  -->
        <nav aria-label="Page navigation example">
            <ul class="inline-flex -space-x-px text-sm">
                <!-- Tombol Previous -->
                <li>
                    <a href="<?= $currentPage > 1 ? '/admin/data-kelompok?page=' . ($currentPage - 1) . '&search=' . htmlspecialchars($search) : '#' ?>"
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
                    <a href="/admin/data-kelompok?page=' . $page . '&search=' . htmlspecialchars($search) . '"
                    class="flex items-center justify-center px-3 h-8 border leading-tight text-gray-500  dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ' . ($page === $currentPage ? 'text-blue-600 border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : '') . '">
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
                    <a href="/admin/data-group?page=' . $page . '&search=' . htmlspecialchars($search) . '"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 border dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ' . ($page === $currentPage ? 'text-blue-600 border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : '') . '">
                    ' . $page . '
                    </a>
                </li>';
                    }
                }
                ?>

                <!-- Tombol Next -->
                <li>
                    <a href="<?= $currentPage < $totalPages ? '/admin/data-group?page=' . ($currentPage + 1) . '&search=' . htmlspecialchars($search) : '#' ?>"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?= $currentPage == $totalPages ? 'cursor-not-allowed opacity-50' : '' ?>">
                        Next
                    </a>
                </li>
            </ul>
        </nav>
    </nav>


</body>