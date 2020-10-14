<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = [
        'notadinas_id', 'no_taagihan', 'jumlah_tagihan', 'keterangan',
    ];
}
