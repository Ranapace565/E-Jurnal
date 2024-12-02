<?php
// Daftar golongan darah
$bloodTypes = [
    "O+" => "O+",
    "A+" => "A+",
    "B+" => "B+",
    "AB+" => "AB+",
    "O-" => "O-",
    "A-" => "A-",
    "B-" => "B-",
    "AB-" => "AB-"
];
?>
<div class="relative sm:col-span-1">
    <!-- Input -->
    <input
        type="text"
        id="bloodType"
        name="darah"
        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="Pilih Golongan Darah"
        readonly
        required
        autocomplete="off"
        data-dropdown-toggle="bloodTypeDropdown"
        value="<?= htmlspecialchars($data['darah']); ?>" />

    <!-- Hidden Input -->
    <input
        type="hidden"
        id="bloodTypeValue"
        name="bloodTypeValue"
        value="" required />

    <!-- Dropdown -->
    <div
        id="bloodTypeDropdown"
        class="hidden absolute z-10 w-full bg-white rounded-lg border border-gray-300 shadow-lg mt-1 dark:bg-gray-700">
        <ul class="py-1">
            <?php foreach ($bloodTypes as $value => $label): ?>
                <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    onclick="setBloodType('<?php echo $value; ?>', '<?php echo $label; ?>')">
                    <?php echo $label; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="sm:col-span-2"></div>

<script>
    // Fungsi untuk mengatur nilai input saat pilihan dipilih
    function setBloodType(value, label) {
        const bloodTypeInput = document.getElementById('bloodType');
        const bloodTypeValueInput = document.getElementById('bloodTypeValue');
        const bloodTypeDropdown = document.getElementById('bloodTypeDropdown');

        bloodTypeInput.value = label; // Nama ditampilkan di input teks
        bloodTypeValueInput.value = value; // Nilai disimpan di hidden input
        bloodTypeDropdown.classList.add('hidden'); // Sembunyikan dropdown
    }

    // Mengontrol tampilan dropdown saat input diklik
    const bloodTypeInput = document.getElementById('bloodType');
    const bloodTypeDropdown = document.getElementById('bloodTypeDropdown');

    bloodTypeInput.addEventListener('click', () => {
        bloodTypeDropdown.classList.toggle('hidden');
    });

    // Menutup dropdown saat klik di luar elemen
    document.addEventListener('click', (event) => {
        if (!bloodTypeDropdown.contains(event.target) && event.target !== bloodTypeInput) {
            bloodTypeDropdown.classList.add('hidden');
        }
    });
</script>