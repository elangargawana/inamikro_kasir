<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSatuan extends Model
{
    use HasFactory;
    protected $table = 'm_satuan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'merchant_id',
        'nama_satuan'
    ];
}
