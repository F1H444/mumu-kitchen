<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use Uuid;
    use HasFactory;

    protected $fillable = ['sub_total', 'kuantitas', 'produk_id', 'pembayaran_id', 'ukuran_produk_id'];

    public function pembayaran()
    {
        return $this->belongsTo('\App\Models\Pembayaran', 'pembayaran_id');
    }

    public function produk()
    {
        return $this->belongsTo('\App\Models\Produk', 'produk_id');
    }

    public function ukuran()
    {
        return $this->belongsTo(UkuranProduk::class, 'ukuran_produk_id');
    }
}
