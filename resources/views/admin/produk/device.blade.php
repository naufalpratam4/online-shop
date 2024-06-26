<div
    class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] h-[600px] w-[300px]">
    <div class="h-[32px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[72px] rounded-s-lg"></div>
    <div class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[124px] rounded-s-lg"></div>
    <div class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[178px] rounded-s-lg"></div>
    <div class="h-[64px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -end-[17px] top-[142px] rounded-e-lg"></div>
    <div class="rounded-[2rem] overflow-hidden w-[272px] h-[572px] bg-white dark:bg-gray-800">
        <div class="h-full bg-gray-100 p-4">
            <div class="flex justify-center">
                <img class="rounded-t-lg w-full" style="aspect-ratio: 3 / 2;"
                    src="{{ isset($produkId->foto_produk) ? asset('storage/' . $produkId->foto_produk) : 'https://curie.pnnl.gov/sites/default/files/default_images/default-image_0.jpeg' }}"
                    alt="" />
            </div>
            <div class="font-semibold pt-2">
                @if ($produkId)
                    {{ $produkId->nama_produk ? $produkId->nama_produk : '' }}
                @endif
            </div>
            <div class="flex justify-between text-sm pt-2">
                <div>
                    @if ($produkId)
                        @rupiah($produkId->harga)
                    @endif
                </div>
                @if ($produkId)
                    <div>Stock : {{ $produkId->stock ? $produkId->stock : '0' }}</div>
                @endif
            </div>
            <div class="text-sm pb-2">
                @if ($produkId)
                    Kategori :
                    {{ $produkId->kategori_id ? $produkId->kategori->nama_kategori : 'Tidak ada kategori' }}
                @endif
            </div>
            <hr>
            <div class="text-xs pt-2">
                @if ($produkId)
                    {{ $produkId->deskripsi ? $produkId->deskripsi : 'Tidak ada deskripsi' }}
                @endif
            </div>
        </div>


    </div>
</div>
