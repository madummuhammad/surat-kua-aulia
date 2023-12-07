<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $table='arsip_surat';

    protected $fillable = [
        'letter_no',
        'letter_date',
        'date_received',
        'regarding',
        'department_id',
        'sender_id',
        'id_penerima_surat',
        'letter_file',
        'status',
        'letter_type',
        'komentar_not_approve',
        'komentar_request'
    ];

    protected $hidden = [

    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id','id');
    }

    public function sender()
    {
        return $this->belongsTo(Sender::class, 'sender_id','id');
    }

    public function receiver()
    {
        return $this->belongsTo(PenerimaSurat::class, 'id_penerima_surat','id');
    }
}
