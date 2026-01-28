<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use Uuid;
    use HasFactory;
    protected $fillable = ['nama_produk', 'gambar', 'deskripsi', 'harga', 'stok', 'kategori_id', 'ukuran_id'];
    protected $appends = ['terjual'];

    public function Kategori()
    {
        return $this->belongsTo('App\Models\kategori', 'kategori_id');
    }

    public function ukuran()
    {
        return $this->belongsToMany('App\Models\Ukuran', 'ukuran_produks')->withPivot(['stock', 'id']);
    }

    public function pesanan()
    {
        return $this->hasMany('App\Models\Pesanan');
    }


    public function getStockAttribute()
    {
        $stock = 0;
        foreach ($this->ukuran as $ukuran) {
            $stock += $ukuran->pivot->stock;
        }
        return $stock;
    }

    public function getTerjualAttribute()
    {
        return $this->pesanan()->whereHas('pembayaran', function ($q) {
            $q->where('status', '!=', 'pesananbatal');
        })->sum('kuantitas');
    }
}
