<?php

namespace App\Models;

use App\Services\SyndicConfigService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;

    /**
     * Determine if the cotisation is overdue (not paid and due date is past)
     * Overdue if no date_paiement and the due date (end of mois/annee) is before today
     */
    public function getIsOverdueAttribute()
    {
        if ($this->date_paiement) return false;
        $due = \Carbon\Carbon::create($this->annee, $this->mois, 1)->endOfMonth();
        return $due->lt(now());
    }

    protected $fillable = [
        'appartement_id',
        'mois',
        'annee',
        'montant_appartement',
        'montant_garage',
        'montant_boxe'
    ];

    protected $casts = [
        'mois' => 'integer',
        'annee' => 'integer',
        'montant_appartement' => 'decimal:2',
        'montant_garage' => 'decimal:2',
        'montant_boxe' => 'decimal:2',
    ];

    /**
     * Get the apartment that owns this cotisation
     */
    public function appartement()
    {
        return $this->belongsTo(Appartement::class);
    }

    /**
     * Get total amount
     */
    public function getTotalAmountAttribute()
    {
        return $this->montant_appartement + $this->montant_garage + $this->montant_boxe;
    }

    /**
     * Get the status color based on payment using configuration
     */
    public function getStatusColorAttribute()
    {
        return SyndicConfigService::getCotisationStatusColor($this->total_amount);
    }

    /**
     * Get status text for display
     */
    public function getStatusTextAttribute()
    {
        $total = $this->total_amount;
        
        if ($total == 0) {
            return 'Non payé';
        } elseif ($total >= 3000) {
            return 'Payé complet';
        } elseif ($total > 0) {
            return 'Paiement partiel';
        }
        return 'En attente';
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
     * Scope for specific appartement
     */
    public function scopeForAppartement($query, $appartementId)
    {
        return $query->where('appartement_id', $appartementId);
    }
}
