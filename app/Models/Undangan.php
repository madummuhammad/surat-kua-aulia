<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    use HasFactory;
    protected $table='undangan';
    protected $guarded=[];

    function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai','nik_pegawai','nik');
    }
}
