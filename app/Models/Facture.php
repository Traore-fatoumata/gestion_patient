<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Facture
 * 
 * @property int $id
 * @property string $numero
 * @property int $patient_id
 * @property float $montant
 * @property Carbon $date_emission
 * @property string $statut
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Patient $patient
 */
class Facture extends Model
{
    use HasFactory;

    protected $table = 'factures';

    protected $casts = [
        'patient_id' => 'int',
        'montant' => 'float',
        'date_emission' => 'datetime'
    ];

    protected $fillable = [
        'numero',
        'patient_id',
        'montant',
        'date_emission',
        'statut',
        'description'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}