<div id="readProductModal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-xl bg-white rounded-lg shadow-lg">
        <!-- Modal content -->
        <div class="p-4 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between mb-4 rounded-t">
                <div class="text-lg text-gray-900">
                    <h3 class="font-semibold">
                        {{ $item->nama_cus }}
                    </h3>
                    <p class="font-bold text-gray-700">
                        @rupiah($item->total_harga)
                    </p>
                </div>
                <div>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg p-2 inline-flex"
                        data-modal-toggle="readProductModal-{{ $item->id }}">
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>
            <!-- Modal body -->
            <div class="space-y-4">
                <div>
                    <dt class="font-semibold text-gray-900">Alamat</dt>
                    <dd class="font-light text-gray-600">{{ $item->alamat }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-900">Jenis Pengantaran</dt>
                    <dd class="font-light text-gray-600">{{ $item->pengantaran }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-900">Category</dt>
                    <dd class="font-light text-gray-600">{{ $item->kategori }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-900">Details</dt>
                    <dd class="font-light text-gray-600">{{ $item->deskripsi }}</dd>
                </div>
            </div>
        </div>
    </div>
</div>
