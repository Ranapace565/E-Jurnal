<?php
$prodiList = StudentModel::getProdi();
?>
<!-- <div class="w-full md:w-1/2"> -->
<label for="Prodi" class="sr-only">Prodi</label>
<div class="relative flex items-center">
    <input
        type="text"
        id="Prodi"
        name="prodi"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        value=""
        placeholder="Prodi" required />
    <button
        id="prodiButton"
        data-dropdown-toggle="actionsDropdown"
        type="button"
        class="inset-y-0 left-0 flex items-center pl-3">
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
    </button>

</div>
<div
    id="prodi"
    class="hidden absolute z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
    <div class="py-1">
        <ul>
            <?php foreach ($prodiList as $prodi): ?>
                <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                    onclick="setProdi('<?php echo $prodi; ?>')">
                    <?php echo $prodi; ?>
                </li>
            <?php endforeach; ?>
            <!-- <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                    onclick="setProdi('TKJ')">
                    TKJ
                </li>
                <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                    onclick="setProdi('MM')">
                    MM
                </li>
                <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                    onclick="setProdi('DPIB')">
                    DPIB
                </li> -->
        </ul>
    </div>
</div>
<!-- </div> -->

<script>
    function setProdi(value) {
        const input = document.getElementById('Prodi');
        input.value = value;
        dropdown.classList.add('hidden'); // Set value of the input field
    }

    // Optional: To toggle the dropdown visibility
    const dropdownButton = document.getElementById('prodiButton');
    const dropdown = document.getElementById('prodi');

    dropdownButton.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });
</script>