<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notadinas extends Model
{
    protected $fillable = [
        'pengajuan_id', 'no_nota', 'tggl_nota', 'nama_dokter', 'total_tagihan',
    ];
}
