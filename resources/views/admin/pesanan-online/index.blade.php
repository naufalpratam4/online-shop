@extends('admin.index')
@section('content')
    <div class="mx-20 md:ms-28 text-2xl font-semibold ">Pesanan Online</div>
    @if (session('error'))
        <div class="text-red-500">{{ session('error') }}</div>
    @endif
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
                                        const transactionNumberElement = row.querySelector('th');
                                        if (transactionNumberElement) {
                                            const transactionNumber = transactionNumberElement.innerText.toLowerCase();
                                            if (transactionNumber.includes(filter)) {
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
                                    <li class="flex items-center">
                                        <input id="pilih10" name="per_page" type="radio" value="100"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="pilih10"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">100
                                            Page</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="pilih10" name="per_page" type="radio" value="1000"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="pilih10"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">1000
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
                            <tr class="text-center">
                                <th scope="col" class="px-4 py-3">Nomor Transaksi</th>
                                <th scope="col" class="px-4 py-3">Tanggal<i class="fa-solid fa-sort"></i></th>
                                <th scope="col" class="px-4 py-3">Nama Pelanggan</th>
                                <th scope="col" class="px-4 py-3">Total Harga</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @foreach ($riwayat as $item)
                                <tr class="border-b text-center">
                                    <th scope="row"
                                        class="text-center px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $item['nomor_order'] }}</th>
                                    <td class="px-4 py-3">{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-3">{{ $item->user->name }}</td>
                                    <td class="px-4 py-3">@rupiah($item['total'])</td>
                                    <td class="px-4 py-3">
                                        @if ($item->status == 'pending')
                                            <dd
                                                class="me-2 mt-1.5 inline-flex items-center rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                                <svg class="me-1 h-3 w-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                                                </svg>
                                                Pre-order
                                            </dd>
                                        @elseif ($item->status == 'confirmed')
                                            <dd
                                                class="me-2 mt-1.5 inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-green-900 dark:text-green-300">
                                                <i class="fa-solid fa-check pe-1"></i>
                                                Confirmed
                                            </dd>
                                        @elseif ($item->status == 'selesai')
                                            <dd
                                                class="me-2 mt-1.5 inline-flex items-center rounded bg-green-200 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                                <i class="fa-solid fa-check pe-1"></i>
                                                selesai
                                            </dd>
                                        @elseif ($item->status == 'canceled')
                                            <dd
                                                class="me-2 mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 ">
                                                <i class="fa-solid fa-xmark pe-1"></i>
                                                Canceled
                                            </dd>
                                        @elseif ($item->status == 'in transit')
                                            <dd
                                                class="me-2 mt-1.5 inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                                <svg class="me-1 h-3 w-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                                </svg>
                                                In transit
                                            </dd>
                                        @elseif ($item->status == 'in delivery')
                                            <dd
                                                class="me-2 mt-1.5 inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-yellow-900 dark:text-yellow-300">
                                                <svg class="me-1 h-3 w-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                                </svg>
                                                In Delivery
                                            </dd>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 ">
                                        <!-- Modal toggle -->
                                        <div class="flex justify-center m-5">
                                            <button id="updateProductButton-{{ $item->id }}"
                                                data-modal-target="updateProductModal-{{ $item->id }}"
                                                data-modal-toggle="updateProductModal-{{ $item->id }}"
                                                class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                                                type="button">
                                                Update
                                            </button>
                                        </div>
                                        @include('admin.pesanan-online.modal.modalEdit')
                                    </td>
                                </tr>
                                {{-- @include('admin.Data-transaksi.modal-data-transaksi.modal-delete') --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $riwayat->firstItem() }}</span>
                        to
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $riwayat->lastItem() }}</span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $riwayat->total() }}</span>
                    </span>
                    <div>
                        {{ $riwayat->links('vendor.pagination.paginateAdmin') }}
                    </div>
                </nav> --}}
            </div>
            <a href="{{ route('admin.transaksi.export') }}">
                <button
                    class="p-3 bg-green-400 text-white rounded-md mt-2 hover:bg-green-500 focus:ring-4 focus:ring-green-300">
                    <i class="fa-solid fa-file-csv"></i>
                </button>
            </a>
        </div>
        <!-- Dropdown menu -->

    </section>
@endsection
