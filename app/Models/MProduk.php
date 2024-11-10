<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MProduk extends Model
{
    use HasFactory;
    protected $table = 'm_produk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'merchant_id',
        'kategori_produk_id',
        'code',
        'nama_produk',
        'satuan_id',
        'stok',
        'harga_jual',
        'harga_modal',
        'kadaluwarsa'
    ];
}
