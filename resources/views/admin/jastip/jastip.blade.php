@extends('admin.index')
@section('content')
    <div class="mx-20 md:ms-28 text-2xl font-semibold ">Pesanan Jastip</div>
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

                        <button type="button" data-modal-target="modalAddPesanan" data-modal-toggle="modalAddPesanan"
                            class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Tambah pesanan
                        </button>
                        @include('admin.jastip.modal.modalAddPesanan')

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
                    <div class=" ">
                        <button id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox"
                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm py-2 px-4 text-center inline-flex items-center"
                            type="button">Filter <i class="fa-solid fa-filter ps-2"></i>
                        </button>


                    </div>

                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="text-center">
                                <th scope="col" class="px-4 py-3">Nama Customers</th>
                                <th scope="col" class="px-4 py-3">Kategori Jasa Titip<i class="fa-solid fa-sort"></i>
                                </th>
                                <th scope="col" class="px-4 py-3">Pengiriman</th>
                                <th scope="col" class="px-4 py-3">Alamat</th>
                                <th scope="col" class="px-4 py-3">Pesanan</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @foreach ($dataJastip as $item)
                                <tr class="border-b text-center">
                                    <th scope="row"
                                        class="text-center px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $item->nama_cus }}
                                    </th>
                                    <td class="px-4 py-3">{{ $item->kategori }}</td>
                                    <td class="px-4 py-3">{{ $item->pengantaran }}</td>
                                    <td class="px-4 py-3 max-w-xs">
                                        <p class="truncate overflow-hidden w-52">{{ $item->alamat }}</p>
                                    </td>
                                    <td class="px-4 py-3 ">
                                        <p class="truncate overflow-hidden w-52 ">{{ $item->deskripsi }}</p>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div>
                                            <form action="{{ route('admin.jastip.visible', $item->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="0">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" name="status" value="1"
                                                        class="sr-only peer"
                                                        @if ($item->status == 1) checked @endif
                                                        onchange="this.form.submit()">
                                                    <div
                                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                                                    </div>
                                                </label>
                                            </form>

                                        </div>
                                    </td>
                                    <td class="px-4 py-3 flex gap-2">
                                        <button type="button" id="readProductButton"
                                            data-modal-target="readProductModal-{{ $item->id }}"
                                            data-modal-toggle="readProductModal-{{ $item->id }}"
                                            class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><i
                                                class="fa-regular fa-eye"></i></button>
                                        <button type="button" id="editModal-{{ $item->id }}"
                                            data-modal-target="editModal-{{ $item->id }}"
                                            data-modal-toggle="editModal-{{ $item->id }}"
                                            class="text-yellow-300 hover:text-white border border-yellow-300 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                            <i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" id="deleteModal"
                                            data-modal-target="deleteModal-{{ $item->id }}"
                                            data-modal-toggle="deleteModal-{{ $item->id }}"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center "><i
                                                class="fa-solid fa-trash"></i></button>
                                    </td>
                                    @include('admin.jastip.modal.readModalPesanan')
                                    @include('admin.jastip.modal.modalDeletePesanan')
                                    @include('admin.jastip.modal.modalEditPesanan')
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $dataJastip->firstItem() }}</span>
                        to
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $dataJastip->lastItem() }}</span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $dataJastip->total() }}</span>
                    </span>
                    <div>
                        {{ $dataJastip->links('vendor.pagination.paginateAdmin') }}
                    </div>
                </nav>
            </div>
        </div>
        <!-- Dropdown menu -->
        <!-- Dropdown menu -->
        <div id="dropdownDefaultCheckbox"
            class=" hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
            <form id="filterForm" method="GET" action="{{ route('admin.jastip.index') }}">
                <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownCheckboxButton">
                    <label for="">Status</label>
                    <hr>
                    <li>
                        <div class="flex items-center">
                            <input id="checkbox-item-1" name="status[]" type="checkbox" value="1"
                                class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 focus:ring-2">
                            <label for="checkbox-item-1"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Selesai</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <input id="checkbox-item-2" name="status[]" type="checkbox" value="0"
                                class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 focus:ring-2">
                            <label for="checkbox-item-2"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Belum
                                Selesai</label>
                        </div>
                    </li>
                    <li class="flex items-center justify-end pt-3">
                        <button type="submit"
                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm py-2 px-4 text-center">Apply
                            Filter</button>
                    </li>
                </ul>
            </form>
        </div>
    </section>
@endsection
