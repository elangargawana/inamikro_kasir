<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantRekening extends Model
{
    use HasFactory;
    protected $table = 'merchant_rekening';
    protected $primaryKey = 'id';
    protected $fillable = [
        'merchant_id',
        'bank_id',
        'nomor_rekening'
    ];
}
