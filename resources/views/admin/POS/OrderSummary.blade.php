@extends('admin.index')
@section('content')
    <div class="grid md:grid-cols-3">
        <section class=" col-span-2 py-8 antialiased  md:py-16">
            <div action="#" class="mx-auto  px-4 2xl:px-0">
                <div class="mx-auto max-w-3xl">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Order summary</h2>
                    <form action="{{ route('admin.order.submit') }}" method="POST">
                        @csrf
                        <div class="mt-6 sm:mt-8">
                            <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800">
                                <table class="w-full text-left font-medium text-gray-900 dark:text-white md:table-fixed">
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                        @foreach ($cartItem as $item)
                                            <tr>
                                                <td class="whitespace-nowrap py-4 md:w-[384px]">
                                                    <input type="hidden" name="id[{{ $item->id }}]"
                                                        value="{{ $item->id }}">
                                                    <input type="hidden" name="status[{{ $item->id }}]"
                                                        value="selesai">


                                                    <div class="flex items-center gap-4">
                                                        <a href="#"
                                                            class="flex items-center aspect-square w-10 h-10 shrink-0">
                                                            <img class="rounded-t-lg w-full" style="aspect-ratio: 2 / 2;"
                                                                src="{{ isset($item->product->foto_produk) ? asset('storage/' . $item->product->foto_produk) : '' }}"
                                                                alt="" />
                                                            <img class="hidden h-auto w-full max-h-full dark:block"
                                                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                                                alt="imac image" />
                                                        </a>
                                                        <a href="#"
                                                            class="hover:underline">{{ $item->product->nama_produk }}</a>
                                                    </div>
                                                </td>

                                                <td class="p-4 text-base font-normal text-gray-900 dark:text-white">
                                                    x{{ $item->jumlah }}</td>

                                                <td
                                                    class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">
                                                    @rupiah($item->total_harga)
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-between pt-10">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Total Harga</h2>
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                                    @rupiah($total_jumlah_harga)
                                </h2>
                            </div>

                            <div class="mt-4 space-y-6">
                                <div class="gap-4 sm:flex sm:items-center">
                                    <div class="w-full">
                                        <a href="/admin/pos">
                                            <button type="button"
                                                class="w-full rounded-lg text-center border border-gray-200 bg-white px-5  py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100  ">
                                                Return
                                                to Shopping</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
        </section>
        <section>
            <form action="{{ route('admin.order.submit') }}" method="POST">
                @csrf

                <div class="border p-1 rounded-lg bg-gray-50 flex flex-col   md:right-0 h-screen overflow-hidden"
                    style="height: 90vh; overflow: hidden;">
                    <div class="flex-1 overflow-y-auto custom-scrollbar">
                        <div class="text-center font-semibold text-xl py-5">Total pembayaran</div>
                        @foreach ($cartItem as $item)
                            <input type="hidden" name="id[{{ $item->id }}]" value="{{ $item->id }}">
                            <input type="hidden" name="status[{{ $item->id }}]" value="selesai">
                            <div class="flex justify-between mb-2 mx-3 text-xl items-center gap-1">
                                {{ $item->product->nama_produk }} : <span class="font-bold">@rupiah($item->total_harga)</span>
                            </div>
                        @endforeach
                        <div class="flex justify-between mb-2 mx-3 text-xl items-center gap-1">
                            Uang yang dibayarkan : <span id="paidAmount" class="font-bold"></span>
                        </div>
                        <div class="flex justify-between mb-2 mx-3 text-xl items-center gap-1">
                            Kembalian : <span id="changeAmount" class="font-bold"></span>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-sm">Total : @rupiah($total_jumlah_harga)</div>

                        <input type="number" id="paidInput" aria-describedby="helper-text-explanation"
                            placeholder="Masukkan jumlah uang" oninput="calculateChange()"
                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 "
                            placeholder="90210" />


                    </div>

                    <script>
                        function formatRupiah(amount) {
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(amount);
                        }

                        function calculateChange() {
                            const totalAmount = {{ $total_jumlah_harga }};
                            const paidInput = document.getElementById('paidInput').value;
                            const paidAmount = parseFloat(paidInput) || 0; // Handle NaN if input is empty or invalid
                            const change = paidAmount - totalAmount;

                            document.getElementById('paidAmount').innerText = formatRupiah(paidAmount);
                            document.getElementById('changeAmount').innerText = formatRupiah(change > 0 ? change : 0);
                        }
                    </script>
                    <div class="mt-5">
                        <a href="/admin/pos/order-summary">
                            <div class="w-full">
                                <button type="submit"
                                    class="mt-4 bg-green-500 flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-600 sm:mt-0"
                                    {{ $cartItem->isEmpty() ? 'disabled' : '' }}>
                                    Send the order
                                </button>
                            </div>

                        </a>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
