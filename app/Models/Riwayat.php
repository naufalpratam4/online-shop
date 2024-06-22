<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'order_id', 'action'];
    protected $table = 'Riwayats';
    public function orderAdmin()
    {
        return $this->belongsTo(OrderAdmin::class, 'id');
    }
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
