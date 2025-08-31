<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_type',
        'description'
    ];

    /**
     * Get the expenses for this type
     */
    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }
}
