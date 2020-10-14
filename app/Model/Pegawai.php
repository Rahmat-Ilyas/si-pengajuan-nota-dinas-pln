<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    use Notifiable;

    protected $guard = 'pegawai';

    protected $fillable = [
        'nip', 'nama', 'email', 'jenis_kelamin', 'tggl_lahir', 'jabatan', 'unit', 'status', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
