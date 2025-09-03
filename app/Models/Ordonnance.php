<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    // Champs pouvant être remplis via create() ou update()
    protected $fillable = [
        'consultation_id',
        'date',
        'instructions',
    ];

    // Relation avec la consultation
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    // Relation avec les éléments de l'ordonnance
    public function elements()
    {
        return $this->hasMany(ElementOrdonnance::class, 'ordonnance_id');
    }
}
