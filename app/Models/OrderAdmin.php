<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAdmin extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['no_transaksi', 'admin_id', 'product_id', 'tanggal', 'jumlah', 'total_harga', 'status'];
    protected $table = 'order_admins';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
