<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ordonnance
 * 
 * @property int $id
 * @property int $consultation_id
 * @property Carbon $date
 * @property string|null $instructions
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Consultation $consultation
 * @property Collection|ElementOrdonnance[] $element_ordonnances
 *
 * @package App\Models
 */
class Ordonnance extends Model
{
	protected $table = 'ordonnances';

	protected $casts = [
		'consultation_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'consultation_id',
		'date',
		'instructions'
	];

	public function consultation()
	{
		return $this->belongsTo(Consultation::class);
	}

	public function element_ordonnances()
	{
		return $this->hasMany(ElementOrdonnance::class);
	}
}
