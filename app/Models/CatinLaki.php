<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatinLaki extends Model
{
    use HasFactory;
    protected $primaryKey = 'nik';
    public $incrementing=false;
    protected $keyType='string';
    protected $table='catin_laki_laki';
    protected $guarded=[];
}
