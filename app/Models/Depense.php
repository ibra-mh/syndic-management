<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_type_id',
        'annee',
        'mois',
        'montant',
        'detail',
        'nature_depense',
        'facture_image'
    ];

    protected $casts = [
        'annee' => 'integer',
        'mois' => 'integer',
        'montant' => 'decimal:2',
    ];

    /**
     * Get the expense type
     */
    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class);
    }

    /**
     * Get the full path to the invoice image
     */
    public function getFactureImageUrlAttribute()
    {
        if ($this->facture_image) {
            return asset('storage/' . $this->facture_image);
        }
        return null;
    }

    /**
     * Check if expense has an invoice image
     */
    public function hasFactureImage()
    {
        return !empty($this->facture_image) && file_exists(storage_path('app/public/' . $this->facture_image));
    }

    /**
     * Scope for specific year
     */
    public function scopeForYear($query, $year)
    {
        return $query->where('annee', $year);
    }

    /**
     * Scope for specific month
     */
    public function scopeForMonth($query, $month)
    {
        return $query->where('mois', $month);
    }

    /**
     * Scope for specific expense type
     */
    public function scopeForExpenseType($query, $expenseTypeId)
    {
        return $query->where('expense_type_id', $expenseTypeId);
    }
}
