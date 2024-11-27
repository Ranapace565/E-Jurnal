<?php require_once __DIR__ . '/../../components/header.php'; ?>

<body>
  <?php require_once __DIR__ . '/../../components/admin-navbar.php'; ?>
  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Kelola Kelompok PKL</h1>
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
            <form class="flex items-center" action="/admin/data-kelompok" method="GET">
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
        <!-- <?php require_once __DIR__ . '/../../components/alert.php'; ?> -->
        <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
          <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

            <div class="mb-4 grid gap-3 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-3">
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


                        <!--  -->
                        <button id="dropdownbtn<?= htmlspecialchars($group['id']); ?>" data-dropdown-toggle="dropdownDots<?= htmlspecialchars($group['id']); ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                          </svg>
                        </button>
                      </div>


                      <!-- Dropdown menu -->
                      <div id="dropdownDots<?= htmlspecialchars($group['id']); ?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownbtn<?= htmlspecialchars($group['id']); ?>">
                          <li>
                            <form action="/admin/detail-kelompok" method="POST" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                              <input type="hidden" name="id" value="<?= htmlspecialchars($group['id']); ?>">
                              <button type="submit" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Kelola</button>
                            </form>
                            <!-- <a href="/admin/detail-group" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Kelola</a> -->
                          </li>
                          <!-- <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Setting</a>
                          </li>
                          <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                          </li> -->
                        </ul>
                        <div class="py-2">
                          <form action="/admin/data-kelompok" method="POST" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" onsubmit="return confirm('Yakin akan menghapus data kelompok <?= htmlspecialchars($group['Inama']); ?> ?')">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($group['id']); ?>">
                            <button type="submit" class="w-full text-left">
                              Hapus
                            </button>
                          </form>


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

                          <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            <span class="leading-tight">
                              (
                              <b><?= htmlspecialchars($student['id']); ?></b>
                              )<?= htmlspecialchars($student['name']); ?>
                            </span>
                          </li>
                        <?php endforeach ?>
                      </ul>
                      <form action="/admin/detail-kelompok#siswa" method="POST">
                        <input type="hidden" name="_method" value="SHOW">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($group['id']); ?>">

                        <!-- <?= htmlspecialchars($group['Inama']); ?> -->

                        <button class=" mt-4 relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800" type="submit">
                          <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            Tambah Siswa
                          </span>
                          </svg>
                        </button>
                      </form>
                      <!-- <a class=" mt-4 relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                          Tambah Siswa
                        </span>
                      </a> -->
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
    <!--  -->
  </nav>
  <!-- </div>
  </div> -->
  <!-- </section> -->
</body>