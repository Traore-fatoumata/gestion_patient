<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Patient
 * 
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property Carbon|null $date_naissance
 * @property string|null $genre
 * @property string|null $adresse
 * @property string|null $telephone
 * @property string|null $courriel
 * @property string|null $groupe_sanguin
 * @property string|null $antecedents_medicaux
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Consultation[] $consultations
 * @property Collection|RendezVou[] $rendez_vous
 *
 * @package App\Models
 */




class Patient extends Authenticatable
{
    use Notifiable;

    protected $table = 'patients';

    protected $casts = [
        'date_naissance' => 'datetime'
    ];

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'genre',
        'adresse',
        'telephone',
        'courriel',
        'groupe_sanguin',
        'antecedents_medicaux',
        'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

	public function setPasswordAttribute($value)
{
    $this->attributes['password'] = $value ? bcrypt($value) : bcrypt('default123');
}

}
