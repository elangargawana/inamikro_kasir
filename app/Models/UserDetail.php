<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $table = 'user_detail';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'nomor_hp',
        'pin',
        'nomor_ktp',
        'url_ktp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
