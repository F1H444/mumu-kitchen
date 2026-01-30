<?php

namespace App\Models;

use App\Traits\Uuid;


use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use Uuid;
    protected $fillable = ['produk_id', 'user_id', 'kuantitas'];
    protected $appends = ['subtotal'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->kuantitas * $this->produk->harga;
    }
}
