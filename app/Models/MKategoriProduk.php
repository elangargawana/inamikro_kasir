<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKategoriProduk extends Model
{
    use HasFactory;
    protected $table = 'm_kategori_produk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'merchant_id',
        'nama_kategori'
    ];
}
