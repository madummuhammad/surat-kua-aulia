<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaSurat extends Model
{
    use HasFactory;
    protected $table='penerima_surat';
    protected $guarded=[];
}
