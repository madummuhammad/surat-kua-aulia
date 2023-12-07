<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendation extends Model
{
    use HasFactory;
    protected $table='surat_rekomendasi_nikah';
    protected $guarded=[];

    function laki()
    {
        return $this->belongsTo('App\Models\CatinLaki','nik_catin_laki_laki','nik');
    }

    function perempuan()
    {
        return $this->belongsTo('App\Models\CatinPerempuan','nik_catin_perempuan','nik');
    }

    function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai','nik_pegawai','nik');
    }
}
