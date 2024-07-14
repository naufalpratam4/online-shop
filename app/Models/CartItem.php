<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'cart_id',
        'product_id',
        'jumlah',
        'total_harga'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
