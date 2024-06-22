@extends('admin.index')
@section('content')
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
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
                                                <input type="hidden" name="status[{{ $item->id }}]" value="selesai">


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

                                            <td class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">
                                                @rupiah($item->total_harga)
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-between pt-10">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Total Harga</h2>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">@rupiah($total_jumlah_harga)
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


                                <div class="w-full">

                                    <button type="submit"
                                        class="mt-4 bg-green-500 flex w-full items-center justify-center rounded-lg bg-primary-700  px-5 py-2.5 text-sm font-medium text-white hover:bg-green-600  sm:mt-0">Send
                                        the order</button>

                                </div>
                            </div>
                        </div>
                </form>
            </div>
    </section>
@endsection
