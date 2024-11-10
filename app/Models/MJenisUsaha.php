<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MJenisUsaha extends Model
{
    use HasFactory;
    protected $table = 'm_jenis_usaha';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_usaha'
    ];
}
