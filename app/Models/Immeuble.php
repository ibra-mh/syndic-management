<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immeuble extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_immeuble',
        'tranche_id',
        'nombre_etages',
        'nombre_appartements',
        'description',
        'status'
    ];

    protected $casts = [
        'nombre_etages' => 'integer',
        'nombre_appartements' => 'integer',
        'status' => 'string',
    ];

    /**
     * Get the section this building belongs to
     */
    public function tranche()
    {
        return $this->belongsTo(Tranche::class);
    }

    /**
     * Get the apartments in this building
     */
    public function appartements()
    {
        return $this->hasMany(Appartement::class);
    }

    /**
     * Scope for active buildings
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'actif');
    }

    /**
     * Get occupied apartments count
     */
    public function getOccupiedAppartementsCountAttribute()
    {
        return $this->appartements()->where('status', 'occupé')->count();
    }

    /**
     * Get vacant apartments count
     */
    public function getVacantAppartementsCountAttribute()
    {
        return $this->appartements()->where('status', 'vacant')->count();
    }
}
