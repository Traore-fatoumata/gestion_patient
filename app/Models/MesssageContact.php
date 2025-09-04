<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MessageContact
 * 
 * @property int $id
 * @property string $nom
 * @property string $courriel
 * @property string|null $telephone
 * @property string $message
 * @property Carbon $date_envoi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MessageContact extends Model
{
	protected $table = 'message_contact';

	protected $casts = [
		'date_envoi' => 'datetime'
	];

	protected $fillable = [
		'nom',
		'courriel',
		'telephone',
		'message',
		'date_envoi'
	];
}
