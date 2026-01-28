<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use Uuid;
    use HasFactory;
    protected $table = 'pengirimans';
    protected $guarded = ['id'];


    public function Kota()
    {
        return $this->belongsTo('\App\Models\Kota', 'kota_id');
    }

    public function Provinsi()
    {
        return $this->belongsTo('\App\Models\Provinsi', 'provinsi_id');
    }

    public function Pembayaran()
    {
        return $this->hasOne('\App\Models\Pembayaran');
    }
}
