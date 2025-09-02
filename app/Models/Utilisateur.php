<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Utilisateur
 * 
 * @property int $id
 * @property string $nom_utilisateur
 * @property string $nom
 * @property string $prenom
 * @property string $mot_de_passe_hache
 * @property string $courriel
 * @property string $role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Medecin[] $medecins
 *
 * @package App\Models
 */
class Utilisateur extends Model
{
	protected $table = 'utilisateurs';

	protected $fillable = [
		'nom_utilisateur',
		'nom',
		'prenom',
		'mot_de_passe_hache',
		'courriel',
		'role'
	];

	public function medecins()
	{
		return $this->hasMany(Medecin::class);
	}
}
