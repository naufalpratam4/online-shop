<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    @foreach ($produk as $item)
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="{{ route('admin.productId', $item->nama_produk) }}">
                <img class="rounded-t-lg w-full" style="aspect-ratio: 3 / 2;"
                    src="{{ isset($item->foto_produk) ? asset('storage/' . $item->foto_produk) : '' }}" alt="" />
            </a>
            <div class="px-4">
                <div class="md:flex md:justify-between">
                    <p class="text-sm mb-3 md:pt-4 font-normal text-gray-700 dark:text-gray-400">
                        {{ $item->nama_produk }}
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
                    <div class="flex gap-1">
                        <button type="button" data-modal-target="modal-edit-{{ $item->id }}"
                            data-modal-toggle="modal-edit-{{ $item->id }}"><i
                                class="fa-solid fa-pen text-gray-400"></i></button>

                        {{-- modal edit --}}
                        @include('admin.produk.modal.modalEdit')

                        <button type="button" data-modal-target="modal-delete-{{ $item->id }}"
                            data-modal-toggle="modal-delete-{{ $item->id }}"><i
                                class="fa-regular fa-trash-can text-red-500"></i></button>

                        {{-- modal delete --}}
                        @include('admin.produk.modal.modalDeleteProduk')

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
