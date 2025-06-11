<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisProduk extends Model
{
    use HasFactory;

    protected $table = 'jenis_produks';

    protected $fillable = [
        'nama',
    ];

    public function produks()
    {
        return $this->hasMany(Produk::class, 'jenis_produk_id');
    }
}
