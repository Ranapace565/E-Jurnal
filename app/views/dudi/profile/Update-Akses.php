<!-- Modal toggle -->
<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    Update Akses
</button>

<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Update Akses
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="/dudi/profile" method="POST">

                    <input type="hidden" name="_method" value="AKSES">

                    <input type="hidden" name="id" value="<?= htmlspecialchars($data['user_id']); ?>">

                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 ">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="username" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="<?= htmlspecialchars($data['username']); ?>" />
                            <small class="text-red-700">*abaikan username jika tidak diupdate</small>
                        </div>
                    </div>

                    <div class="col-span-2 sm:col-span-1 mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Lama</label>
                        <input type="password" name="oldpassword" id="oldpassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" pattern=".{8,}" required placeholder="••••••••" value="" />
                        <small class="text-red-700">*wajib diisi untuk update username maupun password</small>
                    </div>
                    <div class="col-span-2 sm:col-span-1 mb-4">
                        <label for="newpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Baru</label>
                        <input type="password" name="newpassword" id="newpassword" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" pattern=".{8,}" placeholder="••••••••">
                        <small class="error-message">Password minimal 8 karakter.</small>
                        <style>
                            .input-field:invalid {
                                border: 2px solid red;
                            }

                            .input-field:valid {
                                border: 2px solid green;
                            }

                            .error-message {
                                color: red;
                                font-size: 0.875rem;
                                display: none;
                            }

                            .input-field:invalid+.error-message {
                                display: block;
                            }
                        </style>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("insert-student-form").addEventListener("submit", function(event) {
        const passwordInput = document.getElementById("password");
        const passwordError = document.getElementById("password-error");

        if (passwordInput.value.length < 8) {
            // Tampilkan error jika password kurang dari 8 karakter
            passwordError.classList.remove("hidden");
            passwordInput.classList.add("border-red-500");
            passwordInput.focus();
            event.preventDefault(); // Hentikan pengiriman form
        } else {
            // Sembunyikan error jika valid
            passwordError.classList.add("hidden");
            passwordInput.classList.remove("border-red-500");
        }
    });
</script>