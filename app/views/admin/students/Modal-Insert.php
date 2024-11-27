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
  Data Siswa
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
          Tambah Data Siswa
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
      <form action="/admin/data-siswa" method="POST">
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
          <input type="hidden" name="_method" value="CREATE">
          <div>
            <label
              for="nis"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIS</label>
            <input
              type="number"
              name="nis"
              id="nis"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 input-nis"
              placeholder="345835488"
              required />
            <!-- <small class="error-message" id="nis-error">NIS sudah terdaftar</small> -->
          </div>
          <div class="">
            <label
              for="nis"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">P. Keahlian</label>

            <?php require_once __DIR__ . '/ProdiChoose.php'; ?>
          </div>


          <!-- <style>
            .input-nis {
              border: 2px solid gray;
            }

            .input-nis.valid {
              border-color: green;
            }

            .input-nis.invalid {
              border-color: red;
            }

            .error-message {
              color: red;
              font-size: 0.875rem;
              display: none;
            }

            .error-message.active {
              display: block;
            }
          </style>

          <script>
            const registeredNIS = <?php echo json_encode(array_column($students, 'nis')); ?>;

            const nisInput = document.getElementById('nis');
            const nisError = document.getElementById('nis-error');

            nisInput.addEventListener('input', () => {
              const nisValue = nisInput.value;

              // Cek apakah NIS ada dalam daftar terdaftar
              if (registeredNIS.includes(nisValue)) {
                nisInput.classList.remove('valid');
                nisInput.classList.add('invalid');
                nisError.classList.add('active');
              } else {
                nisInput.classList.remove('invalid');
                nisInput.classList.add('valid');
                nisError.classList.remove('active');
              }
            });
          </script> -->


          <div>
            <label
              for="name"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <input
              type="text"
              name="name"
              id="name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Insan Firdaus"
              required="" />
          </div>
          <!-- <div>
            <label
              for="prodi"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prodi</label>
            <input
              type="text"
              name="prodi"
              id="prodi"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Teknik Komputer Jaringan"
              required="" />
          </div> -->
          <div>
            <label
              for="username"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input
              type="text"
              name="username"
              id="username"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Insan_Firdaus"
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