<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Specialite
 * 
 * @property int $id
 * @property string $nom
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Medecin[] $medecins
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class Specialite extends Model
{
	protected $table = 'specialites';

	protected $fillable = [
		'nom',
		'description'
	];

	public function medecins()
	{
		return $this->hasMany(Medecin::class);
	}

	public function services()
	{
		return $this->hasMany(Service::class);
	}
}
