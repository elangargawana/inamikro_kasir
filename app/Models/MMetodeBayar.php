<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMetodeBayar extends Model
{
    use HasFactory;
    protected $table = 'm_metode_bayar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_metode',
        'deskripsi'
    ];
}
