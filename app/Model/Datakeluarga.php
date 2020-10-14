<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Datakeluarga extends Model
{
    protected $fillable = [
        'pegawai_id', 'nik', 'nama', 'status', 'keterangan',
    ];
}
