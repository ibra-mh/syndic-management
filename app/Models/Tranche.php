<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tranche extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_tranche',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the buildings that belong to this section
     */
    public function immeubles()
    {
        return $this->hasMany(Immeuble::class);
    }

    /**
     * Scope for active sections
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'actif');
    }

    /**
     * Get apartments count through buildings
     */
    public function getAppartementsCountAttribute()
    {
        return $this->immeubles->sum('appartements_count');
    }
}
