<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MBank extends Model
{
    use HasFactory;
    protected $table = 'm_bank';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_bank'
    ];
}
