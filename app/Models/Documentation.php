<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table='arsip_dokumentasi';

    function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
