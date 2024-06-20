<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    @foreach ($produk as $item)
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg w-full" style="aspect-ratio: 3 / 2;"
                    src="{{ isset($item->foto_produk) ? asset('storage/' . $item->foto_produk) : '' }}" alt="" />
            </a>
            <div class="px-4">
                <div class="md:flex md:justify-between">
                    <p class="text-sm mb-3 md:pt-4 font-normal text-gray-700 dark:text-gray-400">{{ $item->nama_produk }}
                    </p>
                    <p class="text-sm mb-3 md:pt-4 font-normal text-gray-700 dark:text-gray-400">
                        @if ($item->kategori_id)
                            Kategori : {{ $item->kategori->nama_kategori }}
                        @else
                            <div></div>
                        @endif
                    </p>

                </div>
                <div class="flex gap-4 justify-between">
                    <div>
                        <button type="button" data-modal-target="modal-edit" data-modal-toggle="modal-edit"><i
                                class="fa-solid fa-pen text-gray-400"></i></button>
                        <button type="button" data-modal-target="modal-delete" data-modal-toggle="modal-delete"><i
                                class="fa-regular fa-trash-can text-red-500"></i></button>

                        {{-- modal delete --}}
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <div id="modal-delete" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="popup-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are
                                                you
                                                sure you want to delete this product?</h3>
                                            <button data-modal-hide="popup-modal" type="button"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Yes, I'm sure
                                            </button>
                                            <button data-modal-hide="popup-modal" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                                cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                    <div>
                        <form action="{{ route('admin.produk.visible', $item->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="visible" value="0">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="visible" value="1" class="sr-only peer"
                                    @if ($item->visible == 1) checked @endif onchange="this.form.submit()">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                                </div>
                            </label>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
