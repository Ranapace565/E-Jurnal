<div class=" rounded-lg sm:col-span-2">

    <div class="shadow rounded-lg p-4 bg-white dark:bg-slate-500">

        <div class="sm:col-span-6">
            <h2 class="text-xl mb-4 sm:col-span-6 text-center">
                <b>
                    Akses Login
                </b>
            </h2>

        </div>

        <div class="sm:col-span-4">

            <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
            <div class="mt-2 mb-4">
                <div class="mt-2 mb-4">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value='<?= htmlspecialchars($data['username']); ?>' readonly />
                </div>
            </div>
            <label for="username" class="block text-sm/6 font-medium text-gray-900">Password</label>
            <div class="mt-2 mb-4">
                <input type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value='11111111' readonly />
            </div>

            <?php include __DIR__ . '/Update-Akses.php' ?>
        </div>
    </div>
</div>