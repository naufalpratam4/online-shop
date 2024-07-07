<div class="flex mx-auto font-bold">
    <p class="mx-auto text-3xl">Produk Utama Kami</p>
</div>
<div class="grid md:grid-cols-3 mx-28 ">
    @foreach ($produk as $item)
        <form id="product-list" action="{{ route('user.posAdd') }}" method="POST" class="product-item">
            @csrf
            <div
                class="group mx-auto my-5 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
                <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="">
                    <img class="peer absolute top-0 right-0 h-full w-full object-cover"
                        src="{{ isset($item->foto_produk) ? asset('storage/' . $item->foto_produk) : '' }}"
                        alt="product image" />

                </a>
                <div class="mt-4 px-5 pb-5">
                    <a href="#">
                        <h5 class="text-xl tracking-tight text-slate-900">{{ $item->nama_produk }}</h5>
                        <input type="hidden" name="product_id" value="{{ $item->id }}" id="">
                    </a>
                    <div class="mt-2 mb-5 flex items-center justify-between">
                        <p>
                            <span class="text-3xl font-bold text-slate-900">@rupiah($item->harga)</span>
                        </p>
                    </div>
                    <button type="submit"
                        class="flex items-center justify-center rounded-md bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Add to cart
                    </button>

                </div>
            </div>
        </form>
    @endforeach
</div>
