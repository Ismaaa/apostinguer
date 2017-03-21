<?php

namespace App;

use Illuminate\Notifications\Notifiable;

class Metode extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ID_Usuari', 'Address', 'Metode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
