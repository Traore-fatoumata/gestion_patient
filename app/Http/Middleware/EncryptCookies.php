<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    // Liste des cookies qui ne doivent pas être chiffrés
    protected $except = [
        //
    ];
}
