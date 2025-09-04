<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Medecin
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $Nom_Prenom
 * @property string $Sexe
 * @property string $Specialite
 * @property string|null $Telephone
 * @property string|null $Email
 * @property array|null $Disponibilites
 *
 * @package App\Models
 */
class Medecin extends Model
{
	protected $table = 'medecins';

	protected $casts = [
		'Disponibilites' => 'json'
	];

	protected $fillable = [
		'Nom_Prenom',
		'Sexe',
		'Specialite',
		'Telephone',
		'Email',
		'Disponibilites'
	];

	//Relation entre Medecin et Consultation
	// 1 vers N
	public function consultations()
	{
		return $this->hasMany(Consultation::class);	
	}

	//Relation entre Medecin et RendezVous
	// 1 vers N
	public function rendez__vous()
	{
		return $this->hasMany(rendezVous::class);	
	}

	//Relation entre Medecin et Utilisateur
	
	public function Usere()
	{
		return $this->belongsTo(Utilisateurs::class, 'utilisateur_id');
	}
}
