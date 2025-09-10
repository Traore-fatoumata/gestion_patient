<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;

class Medecin extends Authenticatable
{
    use Notifiable;

    protected $table = 'medecins';

    protected $casts = [
        'utilisateur_id' => 'int',
        'specialite_id' => 'int'
    ];

    protected $fillable = [
        'utilisateur_id',
        'nom',
        'prenom',
        'specialite_id',
        'biographie',
        'photo_url',
        'annees_experience',
        'telephone',
        'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function rendez_vous()
    {
        return $this->hasMany(RendezVous::class);
    }

    public function setPasswordAttribute($value)
{
    $this->attributes['password'] = $value ? bcrypt($value) : bcrypt('default123');
}

}
