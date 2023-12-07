<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeArchive extends Model
{
    use HasFactory;
    protected $table='arsip_karyawan';
    protected $guarded=[];

    function employee()
    {
        return $this->belongsTo('App\Models\Employee','id_karyawan','id');
    }

    function department()
    {
        return $this->belongsTo('App\Models\Department','department_id','id');
    }

    function category()
    {
        return $this->belongsTo('App\Models\Category','id_kategori_arsip','id');
    }
}
