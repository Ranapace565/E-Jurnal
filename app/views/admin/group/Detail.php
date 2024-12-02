<?php require_once __DIR__ . '/../../components/header.php'; ?>

<body>
  <?php require_once __DIR__ . '/../../components/admin-navbar.php'; ?>
  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class=" text-3xl font-bold tracking-tight text-gray-800">
        Kelompok
      </h1>
      <h1 class=" text-3xl font-extrabold tracking-tight text-primary-900 dark:text-white mb-4"> <?= htmlspecialchars($group['Inama']); ?></h1>
    </div>
  </header>
  <?php require_once __DIR__ . '/../../components/alert.php'; ?>

  <section class=" bg-white py-8 antialiased dark:bg-gray-900 max-w-2xl mx-auto mt-4 shadow-blurShadow rounded-lg px-4">
    <!-- class=" bg-white py-8 antialiased dark:bg-gray-900 md:py-16 max-w-2xl  mx-auto mt-4" -->

    <h2 class=" text-3xl font-bold tracking-tight text-gray-800 mb-4" id="kelola">
      Kelola Kelompok
    </h2>
    <small class="text-red-600">*klik pada data untuk memilih dan merubah, dan klik simpan perubahan</small>

    <!-- update -->
    <form action="/admin/detail-kelompok#kelola" method="POST">
      <input type="hidden" name="_method" value="PUT">
      <div class="px-4 sm:px-0">
        <input type="hidden" name="id" value="<?= htmlspecialchars($group['id']); ?>">
        <h3 class="text-base/7 font-semibold text-gray-900">Durasi :</h3>


        <!-- tanggal -->

        <div id="date-range-picker" date-rangepicker class="flex items-start flex-col md:flex-row justify-between mb-4">


          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
              </svg>
            </div>
            <input id="datepicker-range-start" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal Mulai" required value="<?= htmlspecialchars(string: $group['start']); ?>">
          </div>

          <span class="mx-4 text-gray-500">sampai</span>
          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
              </svg>
            </div>
            <input id="datepicker-range-end" name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal Selesai" readonly required value="<?= htmlspecialchars($group['finish']); ?>">
          </div>
        </div>

      </div>

      <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm/6 font-medium text-gray-900">Instansi :</dt>
            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
              <?php require_once __DIR__ . '/DudiChoose2.php' ?>
              <!-- <input
              type="hidden"
              id="mentorId"
              name="mentorId"
              value="" />
            <input
              type="text"
              name="mentor"
              id="mentor"
              readonly
              value="Contoh teks di input"
              class="mt-1 max-w-2xl text-sm/6 text-gray-700 sm:col-span-2 bg-transparent border-none focus:ring-0 focus:outline-none appearance-none" /> -->
            </dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm/6 font-medium text-gray-900">Alamat :</dt>
            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"><?= htmlspecialchars($group['alamat']); ?>
              <br>
              <small class="text-red-600">
                *untuk ubah alamat, ubah pada data DUDI
              </small>
            </dd>


          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm/6 font-medium text-gray-900">Mentor :</dt>
            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
              <?= htmlspecialchars($group['MInama']); ?>
            </dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm/6 font-medium text-gray-900">Pembimbing Guru:</dt>
            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
              <!-- <?= htmlspecialchars($group['Mnama']); ?> -->
              <?php require_once __DIR__ . '/MentorChoose2.php' ?>
            </dd>
          </div>

        </dl>
      </div>

      <button type="submit" class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none ml-2 focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 px-4 py-2 mt-4 dark:focus:ring-blue-800">Simpan Perubahan</button>
    </form>
    <div id="siswa" class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">

      <dt class="text-sm/6 font-medium text-gray-900">Siswa</dt>
      <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">


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

          <!-- input -->

          <form class="max-w-md mx-auto mt-3" action="/admin/detail-kelompok#siswa" method="POST">

            <input type="hidden" name="_method" value="INSERT">

            <input type="hidden" name="id" value="<?= htmlspecialchars($group['id']); ?>">

            <div class="">
              <label for="">Tambah Siswa :</label>
              <div class="flex">
                <input type="number" id="input-nis" name="nis" class="block w-full text-sm text-gray-900 border px-4 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan NIS Siswa" required />

                <button type="submit" class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none ml-2 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
              </div>

            </div>

          </form>

      </dd>
    </div>




  </section>


</body>