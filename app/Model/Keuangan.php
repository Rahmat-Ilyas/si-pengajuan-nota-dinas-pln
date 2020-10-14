<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Keuangan extends Authenticatable
{
    use Notifiable;

    protected $guard = 'keuangan';

    protected $fillable = [
        'nama', 'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
