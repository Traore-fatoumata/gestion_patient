<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RendezVous
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $medecin_id
 * @property Carbon $date_heure
 * @property string|null $raison
 * @property string $statut
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Medecin $medecin
 * @property Patient $patient
 * @property Collection|Consultation[] $consultations
 *
 * @package App\Models
 */
class RendezVous extends Model
{
	protected $table = 'rendez_vous';

	protected $casts = [
		'nom_complet' => 'string',
		'medecin_id' => 'int',
		'emqil'=>'string',
		'date_heure' => 'datetime'
	];

	protected $fillable = [
		'nom_complet',
		'medecin_id',
		'email',
		'telephone',
		'date_heure',
		'raison',
		'statut'
	];

	public function medecin()
	{
		return $this->belongsTo(Medecin::class);
	}

	// public function patient()
	// {
	// 	return $this->belongsTo(Patient::class);
	// }

	public function consultations()
	{
		return $this->hasMany(Consultation::class, 'rendez_vous_id');
	}
}
