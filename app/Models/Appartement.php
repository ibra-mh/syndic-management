<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartement extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'etage',
        'surface',
        'status',
        'immeuble_id',
        'proprietaire_id'
    ];

    protected $casts = [
        'etage' => 'integer',
        'surface' => 'decimal:2',
        'status' => 'string',
    ];

    /**
     * Get the building that owns the apartment
     */
    public function immeuble()
    {
        return $this->belongsTo(Immeuble::class);
    }

    /**
     * Get the owner of the apartment
     */
    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'proprietaire_id');
    }

    /**
     * Get the cotisations for this apartment
     */
    public function cotisations()
    {
        return $this->hasMany(Cotisation::class);
    }

    /**
     * Scope for occupied apartments
     */
    public function scopeOccupied($query)
    {
        return $query->where('status', 'occupé');
    }

    /**
     * Scope for vacant apartments
     */
    public function scopeVacant($query)
    {
        return $query->where('status', 'vacant');
    }

    /**
     * Get full apartment identifier
     */
    public function getFullIdentifierAttribute()
    {
        return $this->immeuble->nom_immeuble . ' - Apt ' . $this->numero . ' (Étage ' . $this->etage . ')';
    }
}
