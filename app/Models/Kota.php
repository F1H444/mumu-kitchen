<?php


namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use Uuid;
    protected $fillable = ['nama_kota','provinsi_id'];

    public function Provinsi()
    {
        return $this->belongsTo('App\Models\provinsi', 'provinsi_id');
    }
}
