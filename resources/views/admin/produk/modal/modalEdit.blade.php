 <!-- modal Edit produk -->
 <div>
     <form action="{{ route('admin.produk.edit', $item->id) }}" method="POST">
         @csrf
         <div id="modal-edit-{{ $item->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
             class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
             <div class="relative p-4 w-full max-w-2xl max-h-full">
                 <!-- Modal content -->
                 <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                     <!-- Modal header -->
                     <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                         <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                             Edit Produk
                         </h3>
                         <button type="button"
                             class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                             data-modal-hide="modal-edit-{{ $item->id }}">
                             <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                             </svg>
                             <span class="sr-only">Close modal</span>
                         </button>
                     </div>

                     <!-- Modal body -->

                     <div class="p-4 md:p-5 space-y-4">
                         <div class="mb-5 flex justify-center">
                             <img class="rounded-full w-2/12" style="aspect-ratio: 2 / 2;"
                                 src="{{ isset($item->foto_produk) ? asset('storage/' . $item->foto_produk) : '' }}"
                                 alt="" />
                         </div>
                         <div class="flex flex-col items-center justify-center">
                             <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                 for="user_avatar">Upload file</label>
                             <input name="foto_produk"
                                 class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                 aria-describedby="user_avatar_help" id="user_avatar" type="file">

                             <a href=""><span class="text-center cursor-pointer   text-red-500">Remove</span></a>
                         </div>

                         <div class="mb-5">
                             <label for="base-input"
                                 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                 Produk
                             </label>
                             <input type="text" id="base-input" name="nama_produk" value="{{ $item->nama_produk }}"
                                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">

                         </div>
                         <div class="mb-5">
                             <label for="base-input"
                                 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                             </label>
                             <input type="text" id="base-input" name="harga" value="{{ $item->harga }}"
                                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                         </div>
                         <div class="mb-5">
                             <label for="base-input"
                                 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock

                             </label>
                             <input type="text" id="base-input" name="stock" value="{{ $item->stock }}"
                                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                         </div>
                         <div class="mb-5">
                             <label for="base-input"
                                 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                             </label>
                             <input type="text" id="base-input" name="deskripsi" value="{{ $item->deskripsi }}"
                                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                         </div>


                         <div>
                             <label for="countries"
                                 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                 Kategori</label>
                             <select id="countries" name="kategori_id"
                                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">

                                 <option value="{{ $item->kategori_id }}">{{ $item->kategori->nama_kategori }}</option>
                                 @foreach ($kategori as $item)
                                     <option value="{{ $item->id }}">
                                         {{ $item->nama_kategori }}</option>
                                 @endforeach

                             </select>
                         </div>
                     </div>
                     <!-- Modal footer -->
                     <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                         <button data-modal-hide="static-modal" type="submit"
                             class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit
                         </button>
                         <button data-modal-hide="modal-edit-{{ $item->id }}" type="button"
                             class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                     </div>
                 </div>
             </div>
         </div>
     </form>
 </div>
