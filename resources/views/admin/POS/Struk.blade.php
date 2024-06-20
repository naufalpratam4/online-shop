<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {

            /* CSS untuk print */
            body {
                font-family: 'Courier New', Courier, monospace;
                font-size: 12px;
                line-height: 1.4;
                max-width: 320px;
                /* Lebar struk thermal umumnya sekitar 80mm */
                margin: 0 auto;
            }

            /* Sembunyikan tombol saat mode cetak */
            .print-hidden {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-white p-4">
    <form action="{{ route('admin.order.submit') }}" method="POST">
        @csrf
        <div class="text-center mb-4">
            <h1 class="text-2xl font-bold">Udang Keju Maknyes</h1>
            <p class="text-sm text-gray-600">Jl. Bukit Bringin Timur E/160, Kota Semarang</p>
            <p class="text-sm text-gray-600">Telp: 085799857403</p>
            <p class="text-sm text-gray-600">Tanggal: {{ now()->format('Y-m-d') }}</p>
        </div>

        <div class="border-t border-b border-gray-300 py-2 mb-4">
            @foreach ($struk as $item)
                <div class="flex justify-between mb-1">
                    <span class="text-sm text-gray-800">{{ $item->product->nama_produk }}</span>
                    <span class="text-sm text-gray-800">@rupiah($item->total_harga)</span>
                    <input type="hidden" name="id[{{ $item->id }}]" value="{{ $item->id }}">
                    <input type="hidden" name="status[{{ $item->id }}]" value="selesai">
                </div>
            @endforeach
            <div class="flex justify-between mb-1">
                <span class="text-sm text-gray-800 font-bold">Total</span>
                <span class="text-sm text-gray-800 font-bold">@rupiah($total_jumlah_harga)</span>

            </div>
        </div>


        <div class="text-center text-sm mb-4">
            <p class="text-gray-600">Terima kasih telah berbelanja di Toko Baju Elegan!</p>
            <p class="text-gray-600">Silakan simpan struk ini sebagai bukti pembayaran.</p>
        </div>

        <!-- Tombol kembali ke beranda -->
        <div class="text-center mt-4 print-hidden">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Kembali ke Beranda
            </button>
        </div>

        <div class="text-center text-xs text-gray-600 mt-4">
            <p>================================</p>
            <p>Powered by Tailwind CSS</p>
        </div>
    </form>

</body>

</html>
