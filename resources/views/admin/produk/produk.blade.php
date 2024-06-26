@extends('admin.index')
@section('content')
    <div class="grid md:grid-cols-3 gap-2">
        {{-- kiri --}}
        <div class="col-span-2">
            <div class="">
                <!-- Menampilkan Pesan Kesalahan -->
                @if ($errors->any())
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline"> Ada beberapa masalah dengan input Anda.</span>
                        <ul class="mt-3 list-disc list-inside text-sm text-green-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div id="alert-2"
                        class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ps-2">{{ session('success') }}</div>
                    </div>
                @endif

            </div>
            <div class="border-2 rounded-xl bg-white py-4 px-20">
                <div class="grid grid-cols-2 text-center">
                    <div>
                        <div class="text-lg">Produk Total</div>
                        <div class="font-semibold text-xl">{{ $produkTotal }}</div>
                    </div>
                    <div>
                        <div class="text-lg">Produk Tersedia</div>
                        <div class="font-semibold text-xl">{{ $produkTersedia }}</div>
                    </div>
                </div>
            </div>
            {{-- add produk and kategori --}}
            <div class="py-10 flex gap-3">
                <button type="button" data-modal-target="static-modal" data-modal-toggle="static-modal"
                    class="px-4 py-2 bg-green-500 hover:bg-green-800 duration-150 text-white rounded-full"><i
                        class="fa-solid fa-plus"></i> Produk</button>
                <button type="button" data-modal-target="modal-kategori" data-modal-toggle="modal-kategori"
                    class="px-4 py-2 bg-white hover:bg-gray-200 duration-150  rounded-full"><i class="fa-solid fa-plus"></i>
                    Tambah Kategori</button>
            </div>


            <!-- modal add produk -->
            @include('admin.produk.modal.modalAddProduk')

            <!-- modal add kategori -->
            @include('admin.produk.modal.modalAddKategoriProduk')
            {{-- produk --}}
            <div>
                @include('admin.produk.DataProduk')
            </div>
        </div>
        {{-- kanan --}}
        <div class="hidden md:block">
            @include('admin.produk.device')
        </div>
    </div>

@endsection
