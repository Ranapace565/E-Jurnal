<div id="<?= htmlspecialchars($activity['id']); ?>update" tabindex="-1" aria-hidden="true" class="max-h-auto fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden antialiased md:inset-0  shadow-inner">
  <div class="max-h-auto relative max-h-full w-full max-w-lg p-4">
    <!-- Modal content -->
    <div class="relative rounded-lg bg-gray-100 shadow dark:bg-gray-800">
      <!-- Modal header -->
      <div class="<?= $cardClass; ?> flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
        <h3 class="text-lg font-semibold text-white dark:text-white">Kelola Kegiatan <?= htmlspecialchars($approveText); ?></h3>

        <button type="button" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-white hover:bg-gray-200 hover:text-white dark:hover:bg-red-600 dark:hover:text-white" data-modal-toggle="<?= htmlspecialchars($activity['id']); ?>update">
          <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2 p-4 md:p-">
        <div class="col-span-2">
          <!-- form -->
          <form action="/dudi/kegiatan" method="POST">
            <input type="hidden" name="_method" value="UPDATE">
            <input type="hidden" name="id" value="<?= htmlspecialchars($activity['id']); ?>">
            <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">

              <div class="col-span-2">



                <label for="date<?= htmlspecialchars($activity['id']); ?>" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Tanggal </label>
                <div class="relative max-w-sm">
                  <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                  </div>


                  <input id="date<?= htmlspecialchars($activity['id']); ?>" name="tanggal" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" value="<?= htmlspecialchars($activity['date']); ?>" required readonly>


                </div>
              </div>

              <div class="col-span-2">
                <label for="pick-up-point-input" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Minggu ke </label>
                <input type="text" id="pick-up-point-input" name="minggu" class="block w-full rounded-lg border border-gray-300
                 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Enter the pick-up point name" readonly value="<?= htmlspecialchars($activity['week']); ?>" />
              </div>

              <div class="col-span-2">
                <label for="pick-up-point-input" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Kegiatan* </label>
                <input type="text" id="pick-up-point-input" name="kegiatan" class="block w-full rounded-lg border border-gray-300
                 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Enter the pick-up point name" required value="<?= htmlspecialchars($activity['activity']); ?>" readonly />
              </div>

              <div class="col-span-2">
                <label for="deskripsi" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Detail Kegiatan*</label>
                <textarea id="deskripsi" name="detail" rows="4" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Wajib isi deskripsi" required readonly><?= htmlspecialchars($activity['description']); ?></textarea>
              </div>


              <div class="col-span-2 mb-4">
                <label for="pick-up-point-input" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Status</label>

                <!-- <div class="flex items-center me-4">
                  <input id="inline-radio" type="radio" value="3" name="inline-radio-group"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    <?= $activity['approve'] === 3 ? 'checked' : ''; ?>>
                  <label for="inline-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Proses</label>
                </div> -->

                <div class="flex items-center me-4">
                  <input id="inline-2-radio" type="radio" value="1" name="approve"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    <?= $activity['approve'] === 1 ? 'checked' : ''; ?>>
                  <label for="inline-2-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Terima</label>
                </div>

                <div class="flex items-center me-4">
                  <input id="inline-checked-radio" type="radio" value="2" name="approve"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    <?= $activity['approve'] === 2 ? 'checked' : ''; ?>>
                  <label for="inline-checked-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tolak</label>
                </div>
              </div>


            </div>
            <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5 flex sm:justify-end justify-between">

              <button type="button" class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700" data-modal-toggle="<?= htmlspecialchars($activity['id']); ?>update">

                <span>Batal</span>
              </button>

              <button type="submit" class="me-2 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 justify-between">Simpan Perubahan</button>
            </div>
          </form>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>