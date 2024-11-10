<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPelanggan extends Model
{
    use HasFactory;
    protected $table = 'm_pelanggan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'email',
        'nama',
        'nomor_hp',
        'alamat'
    ];
}
