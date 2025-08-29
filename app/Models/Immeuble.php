<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immeuble extends Model
{
    use HasFactory;

    protected $fillable = ['nom_immeuble', 'tranche_id'];

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
}
