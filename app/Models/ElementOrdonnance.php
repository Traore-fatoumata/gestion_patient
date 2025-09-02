<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ElementOrdonnance
 * 
 * @property int $id
 * @property int $ordonnance_id
 * @property string $medicament
 * @property string|null $dosage
 * @property string|null $duree
 * @property int|null $quantite
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Ordonnance $ordonnance
 *
 * @package App\Models
 */
class ElementOrdonnance extends Model
{
	protected $table = 'element_ordonnance';

	protected $casts = [
		'ordonnance_id' => 'int',
		'quantite' => 'int'
	];

	protected $fillable = [
		'ordonnance_id',
		'medicament',
		'dosage',
		'duree',
		'quantite'
	];

	public function ordonnance()
	{
		return $this->belongsTo(Ordonnance::class);
	}
}
