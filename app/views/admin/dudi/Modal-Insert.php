<!-- Modal toggle -->

<button
  id="btn-modal-insert"
  data-modal-target="modal-insert"
  data-modal-toggle="modal-insert"
  class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
  type="button">
  <svg
    class="h-3.5 w-3.5 mr-2"
    fill="currentColor"
    viewbox="0 0 20 20"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true">
    <path
      clip-rule="evenodd"
      fill-rule="evenodd"
      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
  </svg>
  Data DUDI
</button>

<div
  id="modal-insert"
  tabindex="-1"
  aria-hidden="true"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
  <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
    <!-- Modal content -->
    <div
      class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
      <!-- Modal header -->
      <div
        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
          Tambah Data DUDI
        </h3>
        <button
          type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-toggle="modal-insert">
          <svg
            aria-hidden="true"
            class="w-5 h-5"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path
              fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <form action="/admin/data-dudi" method="POST">
        <input type="hidden" name="_method" value="CREATE">
        <div class="grid gap-4 mb-4 sm:grid-cols-2">

          <div>
            <label
              for="name"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Instansi</label>
            <input
              type="text"
              name="name"
              id="name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="PT. Pertama"
              required="" />
          </div>

          <div>
            <label
              for="alamat"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <input
              type="text"
              name="alamat"
              id="alamat"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Jl. Kenanga no.11"
              required="" />
          </div>

          <div>
            <label
              for="username"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input
              type="text"
              name="username"
              id="username"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="ptpertama"
              required="" />
          </div>

          <div>
            <label
              for="password"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input
              type="password"
              name="password"
              id="password"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 input-field"
              placeholder="Password" pattern=".{8,}"
              required />
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
        </div>
        <button
          type="submit"
          class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
          <svg
            class="mr-1 -ml-1 w-6 h-6"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path
              fill-rule="evenodd"
              d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
              clip-rule="evenodd"></path>
          </svg>
          Tambah Data
        </button>
      </form>
    </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById("btn-modal-insert").click();
  });
</script>
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