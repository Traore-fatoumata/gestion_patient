<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Patient
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $Nom
 * @property string $Prenom
 * @property string $Sexe
 * @property Carbon $Date_de_Naissance
 * @property string $Adresse
 * @property string|null $Telephone
 * @property string|null $Email
 * @property string $Profession
 * @property string|null $Antecedents_Medicaux
 * @property string $Numero_Dossier
 *
 * @package App\Models
 */
class Patient extends Model
{
	protected $table = 'patients';

	protected $casts = [
		'Date_de_Naissance' => 'datetime'
	];

	protected $fillable = [
		'Nom',
		'Prenom',
		'Sexe',
		'Date_de_Naissance',
		'Adresse',
		'Telephone',
		'Email',
		'Profession',
		'Antecedents_Medicaux',
		'Numero_Dossier'
	];

	//Cette fonction est pour la relation entre Patient et RendezVous
	//1 Patient peut avoir plusieurs RendezVous
	public function rendez_Vous()
	{
		return $this->hasMany(rendezVous::class);	
	} 

	//Cette fonction est pour la relation entre Patient et Consultation
	//1 Patient peut avoir plusieurs Consultation
	public function consultationss()
	{
		return $this->hasMany(consultation::class);
	}

	//relation entre patient et utilisateur
	//De 0 à 1
	public function user()
	{
		return $this->belongsTo(utilisateur::class);
	}

	//relation entre patient et facture
	// De 1 à N
	public function factures()
	{
		return $this->hasMany(facture::class);
	}
}
