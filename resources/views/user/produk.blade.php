<div class="w-10/12 mx-auto px-2 md:px-0  grid grid-cols-2 md:grid-cols-3 gap-4" id="product">
    @foreach ($produk as $item)
        <div
            class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="/product-detail">
                <img class="md:p-8 rounded-t-lg"
                    src="{{ isset($item->foto_produk) ? asset('storage/' . $item->foto_produk) : '' }}"
                    alt="product image" style="aspect-ratio: 3 / 2;" />
            </a>
            <div class="px-5 pb-5">
                <a href="#">
                    <h5 class="md:text-xl font-semibold tracking-tight text-gray-900 dark:text-white truncate ">
                        {{ $item->nama_produk }}t</h5>
                </a>
                <div class="flex items-center mt-2.5 mb-5">
                    <div class="flex items-center space-x-1 rtl:space-x-reverse">

                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>

                    </div>
                    <span
                        class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-800 ms-3">5.0</span>
                </div>
                <div class="flex flex-wrap items-center justify-between">
                    <div class="md:text-2xl   font-bold text-gray-900 dark:text-white">Rp
                        {{ $item->harga }}</div>
                    <a href="#"
                        class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm md:px-5 md:py-2.5 px-2 py-1 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Add
                        to cart</a>
                </div>
            </div>
        </div>
    @endforeach

</div>
