<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Datadokter extends Model
{
    protected $fillable = [
        'yakes_id', 'nip', 'nama_dokter', 'status', 'keterangan',
    ];
}
