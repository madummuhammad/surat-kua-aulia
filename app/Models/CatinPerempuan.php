<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatinPerempuan extends Model
{
    use HasFactory;
    protected $primaryKey = 'nik';
    public $incrementing=false;
    protected $keyType='string';
    protected $table='catin_perempuan';
    protected $guarded=[];
}
