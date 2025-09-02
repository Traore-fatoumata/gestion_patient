<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * 
 * @property int $id
 * @property string $nom
 * @property string|null $description
 * @property int|null $specialite_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Specialite|null $specialite
 *
 * @package App\Models
 */
class Service extends Model
{
	protected $table = 'service';

	protected $casts = [
		'specialite_id' => 'int'
	];

	protected $fillable = [
		'nom',
		'description',
		'specialite_id'
	];

	public function specialite()
	{
		return $this->belongsTo(Specialite::class);
	}
}
