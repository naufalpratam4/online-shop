<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jastip extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['nama_cus', 'user_id', 'no_wa', 'kategori', 'pengantaran', 'alamat', 'deskripsi', 'total_harga', 'status'];
    protected $table = 'jastips';
}
