<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkuranProduk extends Model
{
    use Uuid;
    use HasFactory;
    protected $fillable = ['produk_id', 'ukuran_id', 'stock'];

    public function Produk()
    {
        return $this->belongsTo('App\Models\Produk', 'produk_id');
    }

    public function Ukuran()
    {
        return $this->belongsTo('App\Models\Ukuran', 'ukuran_id');
    }
}
