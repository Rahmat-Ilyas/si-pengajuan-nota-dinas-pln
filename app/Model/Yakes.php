<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Yakes extends Authenticatable
{
    use Notifiable;

    protected $guard = 'yakes';

    protected $fillable = [
        'nama_yakes', 'alamat', 'telpon',   'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
