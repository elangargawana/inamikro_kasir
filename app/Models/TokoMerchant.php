<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokoMerchant extends Model
{
    use HasFactory;
    protected $table = 'toko_merchant';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'nama_toko',
        'provinsi',
        'kota',
        'kecamatan',
        'desa',
        'rt',
        'rw',
        'kode_pos',
        'alamat',
        'jenis_usaha_id',
        'kategori_usaha_id',
        'omset',
        'lokasi_usaha',
        'lokasi_usaha_lain',
        'media_sosial',
        'pajak_umkm',
        'biaya_admin',
        'is_qris',
        'is_nib',
        'is_spdm',
        'is_halal',
        'is_haki'
    ];
}
