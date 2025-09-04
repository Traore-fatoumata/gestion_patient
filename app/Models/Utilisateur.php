<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Utilisateur extends Authenticatable
{
    //
    use HasRoles;

    protected $table = 'utilisateurs';

    protected $guard_name = 'web'; // Spécifie le guard pour Spatie

    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function medecin()
    {
        return $this->hasOne(Medecin::class, 'utilisateur_id');
    }
}
