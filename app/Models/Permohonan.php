<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;
    protected $table='permohonan';
    protected $guarded=[];


    function user()
    {
        return $this->belongsTo('App\Models\User','nik','nik_user');
    }
}
