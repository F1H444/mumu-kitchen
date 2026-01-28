<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use Uuid;
    use HasFactory;
    protected $fillable = ['user_id', 'pengiriman_id', 'no_invoice', 'no_pemesanan', 'bukti_pembayaran', 'catatan', 'harga', 'payment_status', 'status', 'snap_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class);
    }


    public function pesanan()
    {
        return $this->hasMany('\App\Models\Pesanan');
    }
}
