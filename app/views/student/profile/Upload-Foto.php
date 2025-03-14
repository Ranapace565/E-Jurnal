<div class="col-span-full">
    <div class="mt-2 flex items-center gap-x-3 flex-col">
        <label for="file-upload">
            <img id="image"
                src=""
                alt="Default Image"
                class="rounded-full w-96 h-96 md:w-40 md:h-40 object-cover" />
            <svg id="placeholder-icon"
                class="size-20 text-gray-300 hidden w-40 h-40 md:w-40 md:h-40"
                viewBox="0 0 24 24"
                fill="currentColor"
                aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                    clip-rule="evenodd" />
            </svg>
        </label>

        <div class="mt-4 flex text-sm text-gray-600">
            <label for="file-upload"
                class="relative cursor-pointer rounded-md bg-white font-semibold text-primary-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-600 focus-within:ring-offset-2 hover:text-primary-500">
                <span>Ubah foto</span>
                <input id="file-upload"
                    name="file-upload"
                    type="file"
                    accept=".png,.jpg,.jpeg"
                    class="sr-only"
                    onchange="validateAndPreview(this)">
            </label>
        </div>
    </div>
</div>

<script>
    function validateAndPreview(input) {
        const file = input.files[0];
        const imagePreview = document.getElementById('image');
        const placeholderIcon = document.getElementById('placeholder-icon');

        if (!file) {
            alert("Silakan pilih file!");
            return;
        }

        const allowedTypes = ['image/png', 'image/jpeg'];
        if (!allowedTypes.includes(file.type)) {
            alert("Hanya file PNG atau JPG yang diperbolehkan!");
            input.value = ''; // Reset input
            return;
        }

        // Validasi ukuran file (maksimal 2MB)
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            alert("Ukuran file tidak boleh lebih dari 2MB!");
            input.value = ''; // Reset input
            return;
        }

        // Preview gambar
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result; // Tampilkan gambar
            placeholderIcon.classList.add('hidden'); // Sembunyikan placeholder
        };
        reader.readAsDataURL(file);
    }
</script>