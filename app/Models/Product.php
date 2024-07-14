<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['nama_produk', 'deskripsi', 'harga', 'kategori_id', 'visible', 'foto_produk', 'stock'];
    protected $table = 'products';

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
