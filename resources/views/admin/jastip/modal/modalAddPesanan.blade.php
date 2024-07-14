<script>
    function toggleDiv() {
        var category = document.getElementById("category").value;
        var nameDiv = document.getElementById("kategoriJastip");
        if (category === "dll") {
            nameDiv.style.display = "block";
        } else {
            nameDiv.style.display = "none";
        }
    }
</script>
<div id="modalAddPesanan" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Pesanan Jastip
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="modalAddPesanan">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('admin.jastip.addPesanan') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4 mb-4 ">

                    <div>
                        <label for="nama_cus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Customers</label>
                        <input type="text" id="nama_cus" name="nama_cus"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Tulis Nama Customers" required />
                    </div>
                    <div>
                        <label for="no_wa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                            WA
                            Customers</label>
                        <input type="number" id="no_wa" name="no_wa"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Tulis Nomor Customers" required />
                    </div>


                    <div>
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Jastip</label>
                        <select id="category" onchange="toggleDiv()" name="kategori" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            <option>Pilih Kategori</option>
                            <option value="Gacoan">Gacoan</option>
                            <option value="Seblak">Seblak</option>
                            <option value="dll">dll</option>
                        </select>
                    </div>
                    <div id="kategoriJastip" style="display: none;">
                        <label for="custom_kategori"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Jastip</label>
                        <input type="text" id="custom_kategori" name="custom_kategori"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Tulis Kategori" />
                    </div>

                    <div class=" ">
                        <div>
                            <label for="pengantaran"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Pengantaran
                                Jastip</label>
                        </div>
                        <div class="flex gap-2 " style="padding-top: 5px">
                            <div class=" items-center">
                                <input id="default-radio-1" type="radio" value="Diantar" name="pengantaran"
                                    class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-1"
                                    class=" text-sm font-medium text-gray-900 dark:text-gray-300">Diantar Ke
                                    Rumah</label>
                            </div>
                            <div class=" items-center">
                                <input checked id="default-radio-2" type="radio" value="COD" name="pengantaran"
                                    class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-2"
                                    class=" text-sm font-medium text-gray-900 dark:text-gray-300">COD</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="alamat"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <input type="text" id="alamat" name="alamat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Tulis Alamat Customers" required />
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="4" name="deskripsi"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Tulis apa saja pesanannya" required></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="total_harga"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Harga</label>
                        <input type="text" id="total_harga" name="total_harga"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Total Harga yang perlu dibayarkan" required />
                    </div>
                </div>
                <hr class="pb-4">
                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Tambah Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
