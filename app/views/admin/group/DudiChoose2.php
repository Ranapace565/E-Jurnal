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
        value="<?= htmlspecialchars($group['Inama']); ?>"
        autocomplete="off" `
        data-dropdown-toggle="dudiDropdown" />

    <!-- id -->
    <input
        type="hidden"
        id="dudiId"
        name="dudiId"
        value="<?= htmlspecialchars($group['Iid']); ?>" required />

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