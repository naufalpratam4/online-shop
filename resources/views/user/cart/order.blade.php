@extends('welcome')
@section('content')
    <form action="{{ route('user.order.checkout') }}" method="POST">
        @csrf
        <div class="container mx-auto p-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold mb-4">Continuou Checkout</h1>
                <div class="border-b pb-4 mb-4">
                    <h2 class="text-xl font-semibold">Customer Information</h2>
                    <p class="mt-2"><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Address:</strong>{{ $user->alamat }}</p>
                </div>
                <div class="border-b pb-4 mb-4">
                    <h2 class="text-xl font-semibold">Order Summary</h2>
                    <ul class="mt-2">
                        @foreach ($cartItem as $item)
                            <li class="flex justify-between py-2">
                                <span>{{ $item->product->nama_produk }}</span>
                                <span>x{{ $item->jumlah }}</span>
                                <span>@rupiah($item->product->harga)</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex justify-between text-xl font-bold">
                    <span>Total</span>
                    <span>@rupiah($total_jumlah_harga)</span>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 rounded-lg text-white mt-2">Submit</button>
            </div>
        </div>
    </form>
@endsection
