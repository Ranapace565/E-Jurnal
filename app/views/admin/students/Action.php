<button
    id="actionsDropdownButton"
    data-dropdown-toggle="actionsDropdown"
    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
    type="button">
    <svg
        class="-ml-1 mr-1.5 w-5 h-5"
        fill="currentColor"
        viewbox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true">
        <path
            clip-rule="evenodd"
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
    </svg>
    Actions
</button>
<div
    id="actionsDropdown"
    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
    <!-- <ul
                  class="py-1 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="actionsDropdownButton">
                  <li>
                    <a
                      href="#"
                      class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass Edit</a>
                  </li>
                </ul> -->
    <div class="py-1">
        <form action="/admin/data-siswa" method="POST" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data siswa? Tindakan ini tidak dapat dibatalkan.')">
            <input type="hidden" name="_method" value="DELETEALL">
            <button type="submit" class="w-full text-left">
                Delete all
            </button>
        </form>

        <!-- <a
            href="/admin/deleteall-siswa"
            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" onclick="return confirm('Apakah Anda yakin ingin menghapus semua data siswa? Tindakan ini tidak dapat dibatalkan.')">Delete all</a> -->
    </div>
</div>