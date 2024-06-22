@extends('admin.index')
@section('content')
    <div class="mx-20 text-2xl font-semibold">Data Transaksi</div>
    <section class=" dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white  dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">

                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="search-input"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2  "
                                placeholder="Search" required="">
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const searchInput = document.getElementById('search-input');
                                const tableBody = document.getElementById('table-body');
                                const rows = tableBody.getElementsByTagName('tr');

                                searchInput.addEventListener('input', function() {
                                    const filter = this.value.toLowerCase();
                                    Array.from(rows).forEach(row => {
                                        const productNameElement = row.querySelector('th.bates');
                                        if (productNameElement) {
                                            const productName = productNameElement.innerText.toLowerCase();
                                            if (productName.includes(filter)) {
                                                row.style.display = '';
                                            } else {
                                                row.style.display = 'none';
                                            }
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href="/admin/pos">
                            <button type="button"
                                class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add product
                            </button>
                        </a>

                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                type="button">

                                Data Per Page
                                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div id="filterDropdown"
                                class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Pilih Page</h6>
                                <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                    <li class="flex items-center">
                                        <input id="pilih5" name="per_page" type="radio" value="5"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="pilih5"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">5 Page</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="pilih10" name="per_page" type="radio" value="10"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="pilih10"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">10
                                            Page</label>
                                    </li>
                                </ul>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const inputs = document.querySelectorAll('input[name="per_page"]');
                                    inputs.forEach(input => {
                                        input.addEventListener('change', function() {
                                            const perPage = this.value;
                                            const form = document.createElement('form');
                                            form.method = 'GET';
                                            form.action = ''; // current page URL

                                            const hiddenInput = document.createElement('input');
                                            hiddenInput.type = 'hidden';
                                            hiddenInput.name = 'per_page';
                                            hiddenInput.value = perPage;

                                            form.appendChild(hiddenInput);
                                            document.body.appendChild(form);
                                            form.submit();
                                        });
                                    });
                                });
                            </script>


                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>

                                <th scope="col" class="px-4 py-3">Nomor Transaksi</th>
                                <th scope="col" class="px-4 py-3">Tanggal<i class="fa-solid fa-sort"></i></th>
                                <th scope="col" class="px-4 py-3">Produk<i class="fa-solid fa-sort"></i></th>
                                <th scope="col" class="px-4 py-3">Admin</th>
                                <th scope="col" class="px-4 py-3">Jumlah</th>
                                <th scope="col" class="px-4 py-3">Total Harga</th>
                                <th scope="col" class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @foreach ($sales as $item)
                                <tr class="border-b dark:border-gray-700">

                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $item->order_id }}</th>
                                    <td class="px-4 py-3">{{ $item->order->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-3">{{ $item->product->nama_produk }}</td>
                                    <td class="px-4 py-3">{{ $item->order->user->name }}</td>
                                    <td class="px-4 py-3">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3">@rupiah($item->price)</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button type="button"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 me-2 mb-2 ">Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $sales->firstItem() }}</span>
                        to
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $sales->lastItem() }}</span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $sales->total() }}</span>
                    </span>
                    <div>
                        {{ $sales->links('vendor.pagination.paginateAdmin') }}
                    </div>
                </nav>
            </div>
        </div>
    </section>
@endsection
