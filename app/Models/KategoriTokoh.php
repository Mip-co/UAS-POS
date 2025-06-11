<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriTokoh extends Model
{
    use HasFactory;

    protected $table = 'kategori_tokohs';

    protected $fillable = [
        'nama',
    ];

    public function testimonis()
    {
        return $this->hasMany(Testimoni::class, 'kategori_tokoh_id');
    }
}
