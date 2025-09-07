<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Medecin
 * 
 * @property int $id
 * @property int|null $utilisateur_id
 * @property string $nom
 * @property string $prenom
 * @property int $specialite_id
 * @property string|null $biographie
 * @property string|null $photo_url
 * @property string|null $annees_experience
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Specialite $specialite
 * @property Utilisateur|null $utilisateur
 * @property Collection|Consultation[] $consultations
 * @property Collection|RendezVous[] $rendez_vous
 *
 * @package App\Models
 */
class Medecin extends Model
{
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
		'annees_experience'
	];

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
}
