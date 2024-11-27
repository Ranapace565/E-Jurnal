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
        readonly
        autocomplete="off"
        value="<?= htmlspecialchars($group['Mnama']); ?>" />

    <!-- id -->
    <input
        type="hidden"
        id="mentorId"
        name="mentorId"
        value="<?= htmlspecialchars($group['Mid']); ?>" />

    <!-- Dropdown -->
    <div
        id="mentorDropdown"
        class="hidden absolute z-10 w-full bg-white border border-gray-300 rounded-lg divide-y divide-gray-100 shadow-md dark:bg-gray-700 dark:divide-gray-600">
        <ul class="py-1">
            <?php foreach ($mentorList as $mentor): ?>

                <li
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    onclick="setMentor('<?php echo $mentor['id'] ?>', '<?php echo $mentor['nama'] ?>')">
                    <?php echo $mentor['nama'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

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