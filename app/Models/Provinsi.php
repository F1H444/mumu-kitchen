<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use Uuid;
    use HasFactory;
    protected $fillable = ['nama_provinsi' ,'kota_id'];

    public function Kota()
    {
        return $this->hasMany('App\Models\kota', 'kota_id');
    }
}
