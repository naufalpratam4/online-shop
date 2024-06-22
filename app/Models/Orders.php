<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'total', 'status'];
    protected $table = 'orders';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
    public function items()
    {
        return $this->hasMany(order_item::class, 'order_id');
    }
}
