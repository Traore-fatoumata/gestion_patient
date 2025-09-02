<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Consultation
 * 
 * @property int $id
 * @property int|null $rendez_vous_id
 * @property int $patient_id
 * @property int $medecin_id
 * @property Carbon $date
 * @property string|null $diagnostic
 * @property string|null $traitement
 * @property string|null $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Medecin $medecin
 * @property Patient $patient
 * @property RendezVou|null $rendez_vou
 * @property Collection|Ordonnance[] $ordonnances
 *
 * @package App\Models
 */
class Consultation extends Model
{
	protected $table = 'consultations';

	protected $casts = [
		'rendez_vous_id' => 'int',
		'patient_id' => 'int',
		'medecin_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'rendez_vous_id',
		'patient_id',
		'medecin_id',
		'date',
		'diagnostic',
		'traitement',
		'notes'
	];

	public function medecin()
	{
		return $this->belongsTo(Medecin::class);
	}

	public function patient()
	{
		return $this->belongsTo(Patient::class);
	}

	public function rendez_vou()
	{
		return $this->belongsTo(RendezVou::class, 'rendez_vous_id');
	}

	public function ordonnances()
	{
		return $this->hasMany(Ordonnance::class);
	}
}
