<?php

namespace App\Models;
use App\Traits\Uuid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use Uuid;
    use HasFactory;

    protected $fillable = ['nama_kategori','gambar','produk_id'];

    public function Produk()
    {
        return $this->hasMany('App\Models\produk', 'produk_id');
    }
}
