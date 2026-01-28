<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use Uuid;
    use HasFactory;
    protected $fillable = ['uuid','nama_penerima', 'kode_pos', 'detail_alamat', 'phone', 'provinsi_id', 'kota_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
}
