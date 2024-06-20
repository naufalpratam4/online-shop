<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $fillable = ['order_id'];
    protected $table = 'Riwayats';
    public function orderAdmin()
    {
        return $this->belongsTo(OrderAdmin::class, 'id');
    }
}
