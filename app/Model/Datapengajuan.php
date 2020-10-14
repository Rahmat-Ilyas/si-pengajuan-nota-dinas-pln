<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Datapengajuan extends Model
{
    protected $fillable = [
        'pegawai_id', 'nama_pasien', 'status', 'hub_keluarga', 'pengaju', 'progres', 'foto_kuitansi',
    ];
}