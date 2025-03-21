<button data-modal-target="profile-modal" data-modal-toggle="profile-modal" class="col-span-2 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    Update Data Diri
</button>

<!-- Main modal -->
<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-2">

    <div class="rounded-lg sm:col-span-4">

        <div id="profile-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <form class="mx-auto max-w-7xl lg:px-28 py-6 px-2 mt-10" action="/siswa/profile" method="POST">
                <input type="hidden" name="_method" value="UPDATE">

                <div class="space-y-12">

                    <div class="border-b border-gray-900/10 pb-12 shadow p-4 bg-white ">
                        <h2 class="text-2xl flex justify-center w-full mb-4">
                            <b>
                                Identitas Siswa
                            </b>
                        </h2>

                        <?php include __DIR__ . '/Upload-Foto.php' ?>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            <!-- nama -->
                            <label for="nama" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nama Siswa</label>
                            <div class="mt-2 sm:col-span-3">
                                <input type="text" name="nama" id="nama" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong">
                            </div>

                            <!-- nis -->
                            <label for="nis" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nomor Induk Siswa</label>
                            <div class="sm:col-span-3">
                                <input type="text" name="id" id="nis" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong">
                            </div>

                            <label for="nisn" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nomor Induk Siswa Nasional</label>
                            <div class="sm:col-span-3">
                                <input type="text" name="nisn" id="nisn" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong">
                            </div>

                            <!-- tempat lahir -->
                            <label for="tempat" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Tempat Lahir</label>
                            <div class="mt-2 sm:col-span-3">
                                <input type="text" name="tempat" id="tempat" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong">
                            </div>
                            <label for="datepicker-autohide" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Tanggal Lahir</label>

                            <!-- tanggal lahir -->
                            <div class="relative max-w-sm sm:col-span-3">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="datepicker-autohide"
                                    name="tanggal" datepicker datepicker-autohide type="text" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Kosong">
                            </div>

                            <label for="kelamin" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Jenis kelamin</label>

                            <div class="sm:col-span-3 flex flex-col justify-between">
                                <div class="flex items-center">
                                    <input id="laki" type="radio" value="laki-laki" name="kelamin" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="laki" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Laki-Laki</label>
                                </div>
                                <div class="flex items-center">
                                    <input checked id="perempuan" type="radio" value="perempuan" name="kelamin" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="perempuan" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Perempuan</label>
                                </div>
                            </div>

                            <!-- darah -->
                            <label for="kelamin" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Golongan Darah</label>

                            <?php include __DIR__ . '/Blood-Chooser.php' ?>

                            <label for="alamat" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Alamat Siswa</label>

                            <textarea id="alamat" name="alamat" rows="4" class="sm:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Kosong"></textarea>

                            <label for="telp" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nomor Telepon Aktif</label>
                            <div class="mt-2 sm:col-span-3">
                                <input type="number" name="telp" id="telp" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" pattern=".{12,}" placeholder="Kosong">
                            </div>

                            <label for="catatan" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Catatan Kesehatan</label>

                            <textarea id="catatan" name="catatan" rows="4" class="sm:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Kosong"></textarea>

                            <label for="ortu" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nama Orang Tua / Wali</label>
                            <div class="mt-2 sm:col-span-3">
                                <input type="text" name="ortu" id="ortu" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong">
                            </div>

                            <label for="alamatortu" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Alamat Orang Tua / Wali</label>

                            <textarea id="alamatortu" name="alamatortu" rows="4" class="sm:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Kosong"></textarea>

                            <label for="ortutelp" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Nomor Telepon Orang Tua / Wali</label>
                            <div class="mt-2 sm:col-span-3">
                                <input type="number" name="ortutelp" id="ortutelp" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" pattern=".{12,}" placeholder="Kosong">
                            </div>

                            <label for="prodi" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Program Pendidikan</label>
                            <div class="mt-2 sm:col-span-3">
                                <input type="text" name="prodi" id="prodi" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong" readonly>
                            </div>

                            <label for="kompetensi" class="flex flex-col justify-center text-sm/6 font-medium text-gray-900 sm:col-span-2 ">Kompetensi Keahlian</label>
                            <div class="mt-2 sm:col-span-3">
                                <input type="text" name="kompetensi" id="kompetensi" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Kosong">
                            </div>

                            <input type="hidden" name="group" id="group">
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="/siswa/profile" class="text-sm/6 font-semibold text-gray-900">
                                Batal
                            </a>
                            <!-- <button type="button" class="text-sm/6 font-semibold text-gray-900">Batal</button> -->
                            <button type="submit" class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Simpan perubahan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>