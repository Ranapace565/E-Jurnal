<!-- <label for="Dudi" class="sr-only">Dudi</label>
<div class="relative flex items-center">
    <input
        type="text"
        id="Dudi"
        name="Dudi"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        value=""
        placeholder="Pilih Dudi" required readonly />
    <button
        id="dudiButton"
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
    id="dudi"
    class="hidden absolute z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
    <div class="py-1">
        <ul>
            <?php foreach ($DudiList as $Dudi): ?>
                <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                    onclick="setDudi('<?php echo $Dudi; ?>')">
                    <?php echo $Dudi; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<script>
    function setDudi(value) {
        const input = document.getElementById('Dudi');
        input.value = value;
        dropdown.classList.add('hidden'); // Set value of the input field
    }

    // Optional: To toggle the dropdown visibility
    const dropdownButton = document.getElementById('dudiButton');
    const dropdown = document.getElementById('dudi');

    dropdownButton.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });
</script> -->
<!--  -->
<?php
$DudiList = DudiModel::getAll();
?>
<div class="relative">
    <!-- Input -->
    <input
        type="text"
        id="Dudi"
        name="Dudi"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="Pilih Dari Dropdown / Tambah DUDI Dahulu"
        required
        readonly
        autocomplete="off" `
        data-dropdown-toggle="dudiDropdown" />

    <!-- id -->
    <input
        type="hidden"
        id="dudiId"
        name="dudiId"
        value="" required />

    <div
        id="dudiDropdown"
        class="hidden absolute z-10 w-full bg-white rounded-lg border border-gray-300 shadow-lg mt-1 dark:bg-gray-700">
        <ul class="py-1">
            <?php foreach ($DudiList as $Dudi): ?>
                <!-- <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    onclick="setDudi('<?php echo $Dudi['nama'] ?>')">
                    <?php echo $Dudi['nama'] ?>
                </li> -->
                <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    onclick="setDudi('<?php echo $Dudi['id'] ?>', '<?php echo $Dudi['nama'] ?>')">
                    <?php echo $Dudi['nama'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<!-- <script>
    function setDudi(value) {
        const input = document.getElementById('Dudi');
        const dropdown = document.getElementById('dudiDropdown');
        input.value = value; // Set nilai input
        dropdown.classList.add('hidden'); // Sembunyikan dropdown
    }

    // Mengontrol tampilan dropdown saat input diklik
    const dudiInput = document.getElementById('Dudi');
    const dudiDropdown = document.getElementById('dudiDropdown');

    dudiInput.addEventListener('click', () => {
        dudiDropdown.classList.toggle('hidden');
    });


    // Menutup dropdown saat klik di luar elemen
    document.addEventListener('click', (event) => {
        if (!dudiDropdown.contains(event.target) && event.target !== dudiInput) {
            dudiDropdown.classList.add('hidden');
        }
    });
</script> -->
<script>
    // Fungsi untuk mengatur nilai input saat Dudi dipilih
    function setDudi(id, name) {
        const dudiInput = document.getElementById('Dudi');
        const dudiIdInput = document.getElementById('dudiId'); // Hidden input untuk ID Dudi
        const dudiDropdown = document.getElementById('dudiDropdown');

        dudiInput.value = name; // Nama Dudi ditampilkan di input teks
        dudiIdInput.value = id; // ID Dudi disimpan di hidden input
        dudiDropdown.classList.add('hidden'); // Sembunyikan dropdown
    }

    // Mengontrol tampilan dropdown saat input diklik
    const dudiInput = document.getElementById('Dudi');
    const dudiDropdown = document.getElementById('dudiDropdown');

    dudiInput.addEventListener('click', () => {
        dudiDropdown.classList.toggle('hidden');
    });

    // Menutup dropdown saat klik di luar elemen
    document.addEventListener('click', (event) => {
        if (!dudiDropdown.contains(event.target) && event.target !== dudiInput) {
            dudiDropdown.classList.add('hidden');
        }
    });
</script>