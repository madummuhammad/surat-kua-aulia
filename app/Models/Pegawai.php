<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $primaryKey = 'nik';
    public $incrementing=false;
    protected $keyType='string';
    protected $table='pegawai';
    protected $guarded=[];
}
