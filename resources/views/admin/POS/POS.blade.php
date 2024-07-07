@extends('admin.index')
@section('content')
    @if (session('success'))
        @include('template.alerts.success')
    @endif
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <div class="grid md:grid-cols-3 gap-2  ">
        <div class=" col-span-2">
            <div class="pb-2">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="search-input"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2"
                        placeholder="Search" required>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const searchInput = document.getElementById('search-input');
                        const productList = document.getElementById('product-list');
                        const productItems = productList.getElementsByClassName('product-item');

                        searchInput.addEventListener('input', function() {
                            const filter = this.value.toLowerCase();
                            Array.from(productItems).forEach(item => {
                                const productNameElement = item.querySelector('.font-semibold.text-lg');
                                if (productNameElement) {
                                    const productName = productNameElement.innerText.toLowerCase();
                                    if (productName.includes(filter)) {
                                        item.style.display = '';
                                    } else {
                                        item.style.display = 'none';
                                    }
                                }
                            });
                        });
                    });
                </script>

            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="product-list">
                @foreach ($product as $item)
                    <form id="product-list" action="{{ route('admin.posAdd') }}" method="POST" class="product-item">
                        @csrf
                        <button type="submit" class="border p-1 rounded-lg hover:border-green-500">
                            <img class="rounded-t-lg w-full" style="aspect-ratio: 2 / 2;"
                                src="{{ isset($item->foto_produk) ? asset('storage/' . $item->foto_produk) : '' }}"
                                alt="" />
                            <p class="px-1 text-sm pt-2 text-end">Stock : {{ $item->stock }}</p>
                            <div class="flex justify-between pb-1 px-1">
                                <input type="hidden" name="product_id" value="{{ $item->id }}" id="">
                                <p class="font-semibold text-lg">{{ $item->nama_produk }}</p>
                                <p class="font-normal text-lg">Rp. {{ $item->harga }}</p>
                            </div>
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
        <div class="border p-1 rounded-lg bg-gray-50 flex flex-col   md:right-0 h-screen overflow-hidden"
            style="height: 90vh; overflow: hidden;">
            <div class="flex-1 overflow-y-auto custom-scrollbar">
                <div class="text-center font-semibold text-xl py-5">Total pembayaran</div>
                @foreach ($cartItem as $item)
                    <div class="flex mb-2 items-center gap-1">
                        {{-- kiri --}}
                        <button type="button" data-modal-target="popup-modal-{{ $item->id }}"
                            data-modal-toggle="popup-modal-{{ $item->id }}"
                            class="p-4 text-red-500 hover:bg-gray-100"><i class="fa-solid fa-xmark"></i></button>
                        {{-- modal delete --}}
                        <div id="popup-modal-{{ $item->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="popup-modal-{{ $item->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure
                                            you want to
                                            delete this {{ $item->product->nama_produk }}?</h3>
                                        <div class="flex justify-center">
                                            <form action="{{ route('admin.deleteOrder', ['id' => $item->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button data-modal-hide="popup-modal-{{ $item->id }}" type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Yes, I'm sure
                                                </button>
                                            </form>
                                            <button data-modal-hide="popup-modal-{{ $item->id }}" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                                cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <img class=" w-full" style="aspect-ratio: 1 / 1; width:100px"
                                src="{{ isset($item->product->foto_produk) ? asset('storage/' . $item->product->foto_produk) : '' }}"
                                alt="" />
                        </div>
                        {{-- kanan --}}
                        <div class=" w-full">
                            <div class="font-semibold">{{ $item->product->nama_produk }}</div>
                            <label for="counter-input" class="sr-only">Choose quantity:</label>
                            <div class="lg:flex items-center justify-between ">
                                <div class="relative flex items-center">
                                    <form action="{{ route('admin.pos.updateProduk') }}" class="max-w-sm mx-auto flex"
                                        method="POST">
                                        @csrf
                                        <input type="number" name="jumlah" id="number-input"
                                            aria-describedby="helper-text-explanation"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-green-500 focus:border-green-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600"
                                            placeholder="" value="{{ $item->jumlah }}" required />
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <button type="submit" class="p-2 bg-green-500 text-white">Tambah</button>
                                    </form>
                                </div>
                                <div class="ps-1 w-5/12">@rupiah($item->total_harga)</div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="bg-gray-100 p-3 rounded-sm">Total : @rupiah($total_jumlah_harga) </div>
            </div>
            <div class="mt-5">
                <a href="/admin/pos/order-summary">
                    <button class="w-full bg-green-500 rounded-md px-4 py-2 text-white hover:bg-green-600"
                        @unless ($cartItem)
                        disabled
                    @endunless>
                        Checkout
                    </button>

                </a>
            </div>
        </div>

        <style>
            /* Webkit Scrollbar */
            .custom-scrollbar::-webkit-scrollbar {
                width: 12px;
            }

            .custom-scrollbar::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb {
                background-color: #4CAF50;
                /* Warna hijau */
                border-radius: 10px;
                border: 3px solid #f1f1f1;
            }

            /* Firefox */
            .custom-scrollbar {
                scrollbar-width: thin;
                scrollbar-color: #4CAF50 #f1f1f1;
            }
        </style>



    </div>
@endsection
