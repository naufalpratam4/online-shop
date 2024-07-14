<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Riwayat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DataTransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua data dan kelompokkan
        $riwayatGrouped = Riwayat::with('order')->orderBy('order_id')->get()->groupBy('order_id');

        $riwayatMerged = $riwayatGrouped->map(function ($group, $index) {
            return [

                'nomor_order' => $group->first()->order->nomor_order,
                'user_name' => $group->first()->user->name,
                'created_at' => $group->first()->created_at->format('d-m-Y'),
                'total' => $group->first()->order->total,
            ];
        });

        // Ubah koleksi menjadi array
        $riwayatArray = $riwayatMerged->values()->toArray();

        // Kembalikan koleksi yang akan diekspor
        return collect($riwayatArray);
    }

    public function headings(): array
    {
        return [

            'Nomor Order',
            'User Name',
            'Tanggal',
            'Total',
        ];
    }

    public function map($row): array
    {
        return [

            $row['nomor_order'],
            $row['user_name'],
            $row['created_at'],
            $row['total'],
        ];
    }
}
