<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserKaryawan extends Model
{
    use HasFactory;
    protected $table = 'merchant_rekening';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'nomina_gaji',
        'jabatan'
    ];
}
