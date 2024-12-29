<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMerchant extends Model
{
    use HasFactory;
    protected $table = 'user_merchant';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'nama_ibu',
        'tgl_lahir',
        'tempat_lahir',
        'gender',
        'agama',
        'status_kawin',
        'provinsi',
        'kota',
        'kecamatan',
        'desa',
        'rt',
        'rw',
        'kode_pos',
        'alamat',
        'saldo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mSatuan()
    {
        return $this->hasMany(MSatuan::class, 'merchant_id');
    }
}
