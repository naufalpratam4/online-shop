<form action="{{ route('admin.add.produk') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add Produk
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->

                <div class="p-4 md:p-5 space-y-4">
                    <div class="mb-5 flex justify-center">
                        <img id="preview-image"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmiqR_gB1aE6SmGpJvgdi6j6MZYtLpcSittA&s"
                            width="80" height="80" alt="gambar" style="border-radius: 50%">
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="user_avatar">Upload file</label>
                        <input name="foto_produk"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="user_avatar_help" id="user_avatar" type="file">
                    </div>

                    <script>
                        document.getElementById('user_avatar').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('preview-image').src = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>

                    <div class="mb-5">
                        <label for="base-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Produk
                        </label>
                        <input type="text" id="base-input" name="nama_produk"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                    </div>
                    <div class="mb-5 flex gap-2">
                        <div class="w-full">
                            <label for="base-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga

                            </label>
                            <input type="number" placeholder="Rp " id="base-input" name="harga"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                        </div>
                        <div class="w-full">
                            <label for="base-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock
                            </label>
                            <input type="number" id="base-input" name="stock"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                        </div>

                    </div>

                    <div class="mb-5">
                        <label for="base-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi

                        </label>
                        <input type="text" id="base-input" name="deskripsi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                    </div>
                    <div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="hidden" name="visible" value="0">
                            <input type="checkbox" name="visible" value="1" class="sr-only peer">
                            <span class="pe-2">Perlihatkan di toko</span>
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                            </div>
                        </label>
                    </div>

                    <div>
                        <label for="kategori"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select id="kategori" name="kategori_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">

                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="static-modal" type="submit"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah
                    </button>
                    <button data-modal-hide="static-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>
