<button
    id="actionsDropdownButton"
    data-dropdown-toggle="actionsDropdown"
    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white my-4 dark:hover:bg-gray-700"
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
    Pilah
</button>
<div
    id="actionsDropdown"
    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
    <ul
        class="py-1 text-sm text-gray-700 dark:text-gray-200"
        aria-labelledby="actionsDropdownButton">
        <li>
            <a
                href="/dudi/kegiatan?approve=3#main"
                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Proses</a>
        </li>
        <li>
            <a
                href="/dudi/kegiatan?approve=1#main"
                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Diterima</a>
        </li>
        <li>
            <a
                href="/dudi/kegiatan?approve=2#main"
                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ditolak</a>
        </li>
        <li>
            <a
                href="/dudi/kegiatan#main"
                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua</a>
        </li>
    </ul>
</div>