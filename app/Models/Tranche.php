<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tranche extends Model
{
    use HasFactory;

    protected $fillable = ['nom_tranche'];

    /**
     * Get the buildings that belong to this section
     */
    public function immeubles()
    {
        return $this->hasMany(Immeuble::class);
    }
}
