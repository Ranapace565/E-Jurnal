<!-- <?php if (!empty($flash)): ?>
    <div id="alert-<?= $flash['type'] ?>" class="flex items-center p-4 mb-4 text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-800 rounded-lg bg-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-50 dark:bg-gray-800 dark:text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-400" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            <?= htmlspecialchars($flash['message']); ?>!
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-50 text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-500 rounded-lg focus:ring-2 focus:ring-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-400 p-1.5 hover:bg-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-<?= $flash['type'] ?>" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?> -->

<!-- <?php if (!empty($flash)): ?>
    <div id="alert-<?= $flash['type'] ?>"
        class="flex items-center p-4 mb-4 text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-800 rounded-lg bg-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-50 dark:bg-gray-800 dark:text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-400"
        role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            <?= htmlspecialchars($flash['message']); ?>
        </div>

        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-50 text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-500 rounded-lg focus:ring-2 focus:ring-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-400 p-1.5 hover:bg-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-400 dark:hover:bg-gray-700"
            data-dismiss-target="#alert-<?= $flash['type'] ?>" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>

    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?> -->

<?php if (!empty($flash)): ?>
    <div id="alert-<?= $flash['type'] ?>"
        class="flex items-center p-4 mb-4 text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-800 rounded-lg bg-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-50 dark:bg-gray-800 dark:text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-400"
        role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            <?= htmlspecialchars($flash['message']); ?>
        </div>

        <?php if (!empty($flash['username'])): ?>
            <div class="w-full max-w-[16rem]">
                <div class="relative">
                    <label for="username-input" class="sr-only">Username</label>
                    <input id="username-input" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="Username = <?= htmlspecialchars($flash['username']) ?>, Password = <?= htmlspecialchars($flash['password']) ?>" disabled readonly>
                    <button data-copy-to-clipboard-target="username-input"
                        data-tooltip-target="tooltip-copy-username"
                        class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center bg-white">
                        <span id="default-icon">
                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                            </svg>
                        </span>
                        <span id="success-icon" class="hidden inline-flex items-center">
                            <svg class="w-3.5 h-3.5 text-blue-700 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                        </span>
                    </button>

                    <div id="tooltip-copy-username" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        <span id="default-tooltip-message">Copy to clipboard</span>
                        <span id="success-tooltip-message" class="hidden">Copied!</span>
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-50 text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-500 rounded-lg focus:ring-2 focus:ring-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-400 p-1.5 hover:bg-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-<?= $flash['type'] === 'error' ? 'red' : 'green' ?>-400 dark:hover:bg-gray-700"
            data-dismiss-target="#alert-<?= $flash['type'] ?>" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
<?php endif; ?>