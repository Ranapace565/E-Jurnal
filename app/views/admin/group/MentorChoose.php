<!-- 
<label for="Mentor" class="sr-only">Mentor</label>
<div class="relative flex items-center">
    <input
        type="text"
        id="Mentor"
        name="Mentor"
        data-dropdown-toggle="actionsDropdown"
        type="button"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        value=""
        placeholder="Pilih Mentor" required="" readonly />
    <button
        id="mentorButton"
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
    id="mentor"
    class="hidden absolute z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
    <div class="py-1">
        <ul>
            <?php foreach ($mentorList as $mentor): ?>
                <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                    onclick="setMentor('<?php echo $prodi; ?>')">
                    <?php echo $prodi; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>
    function setMentor(value) {
        const input = document.getElementById('Mentor');
        const dropdown = document.getElementById('mentor'); // Tambahkan ini
        input.value = value;
        dropdown.classList.add('hidden'); // Sembunyikan dropdown setelah memilih nilai
    }

    // Optional: To toggle the dropdown visibility
    const mentorButton = document.getElementById('mentorButton');
    const mentorDropdown = document.getElementById('mentor');

    mentorButton.addEventListener('click', () => {
        mentorDropdown.classList.toggle('hidden');
    });
</script> -->

<?php
$mentorList = MentorModel::getAll();
?>
<div class="relative">
    <input
        type="text"
        id="Mentor"
        name="Mentor"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="Pilih Dari Dropdown / Tambah Pembimbing Dahulu"
        required
        autocomplete="off" />

    <!-- id -->
    <input
        type="hidden"
        id="mentorId"
        name="mentorId"
        value="" />

    <!-- Dropdown -->
    <div
        id="mentorDropdown"
        class="hidden absolute z-10 w-full bg-white border border-gray-300 rounded-lg divide-y divide-gray-100 shadow-md dark:bg-gray-700 dark:divide-gray-600">
        <ul class="py-1">
            <?php foreach ($mentorList as $mentor): ?>
                <!-- <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    onclick="setMentor('<?php echo $mentor['nama'] ?>')">
                    <?php echo $mentor['nama'] ?>
                </li> -->
                <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    onclick="setMentor('<?php echo $mentor['id'] ?>', '<?php echo $mentor['nama'] ?>')">
                    <?php echo $mentor['nama'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- <script>
    // Menampilkan dropdown saat input diklik
    const mentorInput = document.getElementById('Mentor');
    const mentorDropdown = document.getElementById('mentorDropdown');

    mentorInput.addEventListener('click', () => {
        mentorDropdown.classList.toggle('hidden');
    });

    // Menutup dropdown jika area luar diklik
    document.addEventListener('click', (event) => {
        if (!mentorDropdown.contains(event.target) && event.target !== mentorInput) {
            mentorDropdown.classList.add('hidden');
        }
    });

    // Mengatur nilai input saat mentor dipilih
    function setMentor(value) {
        mentorInput.value = value;
        mentorDropdown.classList.add('hidden'); // Menyembunyikan dropdown
    }
</script> -->

<script>
    // Menampilkan dropdown saat input diklik
    const mentorInput = document.getElementById('Mentor');
    const mentorDropdown = document.getElementById('mentorDropdown');
    const mentorIdInput = document.getElementById('mentorId'); // Hidden input untuk ID mentor

    mentorInput.addEventListener('click', () => {
        mentorDropdown.classList.toggle('hidden');
    });

    // Menutup dropdown jika area luar diklik
    document.addEventListener('click', (event) => {
        if (!mentorDropdown.contains(event.target) && event.target !== mentorInput) {
            mentorDropdown.classList.add('hidden');
        }
    });

    // Mengatur nilai input saat mentor dipilih
    function setMentor(id, name) {
        mentorInput.value = name; // Nama mentor ditampilkan di input teks
        mentorIdInput.value = id; // ID mentor disimpan di hidden input
        mentorDropdown.classList.add('hidden'); // Menyembunyikan dropdown
    }
</script>