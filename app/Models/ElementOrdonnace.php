<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementOrdonnance extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordonnance_id',
        'medicament',
        'posologie',
        'duree',
    ];

    public function ordonnance()
    {
        return $this->belongsTo(Ordonnance::class);
    }
}
