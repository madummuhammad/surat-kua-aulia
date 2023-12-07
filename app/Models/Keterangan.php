<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keterangan extends Model
{
    use HasFactory;
    protected $table='surat_keterangan_nikah_tidak_tercatat';
    protected $guarded=[];

    function laki()
    {
        return $this->belongsTo('App\Models\Suami','nik_suami','nik');
    }

    function perempuan()
    {
        return $this->belongsTo('App\Models\Istri','nik_istri','nik');
    }

    function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai','nik_pegawai','nik');
    }
}
