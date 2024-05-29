<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    @foreach ($produk as $item)
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg"
                    alt="" />
            </a>
            <div class="px-4">
                <p class="text-sm mb-3 pt-4 font-normal text-gray-700 dark:text-gray-400">{{ $item->nama_produk }}</p>
                <div class="flex gap-4 justify-between">
                    <div>
                        <button type="button"><i class="fa-solid fa-pen text-gray-400"></i></button>
                        <button type="button"><i class="fa-regular fa-trash-can text-gray-400"></i></button>
                    </div>
                    <div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="{{ $item->visible }}" class="sr-only peer"
                                @if ($item->visible == 1) checked @endif>
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                            </div>
                        </label>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
