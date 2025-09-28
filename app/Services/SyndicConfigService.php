<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class SyndicConfigService
{
    /**
     * Get default cotisation amounts
     */
    public static function getDefaultCotisationAmounts(): array
    {
        return Config::get('syndic.cotisations.default_amounts', [
            'appartement' => 2000.00,
            'garage' => 500.00,
            'boxe' => 300.00,
        ]);
    }

    /**
     * Get full payment threshold
     */
    public static function getFullPaymentThreshold(): float
    {
        return Config::get('syndic.cotisations.full_payment_threshold', 3000.00);
    }

    /**
     * Get validation rules for cotisations
     */
    public static function getCotisationValidationRules(): array
    {
        $config = Config::get('syndic.cotisations.validation');
        $maxYear = date('Y') + ($config['max_year_offset'] ?? 1);

        return [
            'appartement_id' => 'required|exists:appartements,id',
            'mois' => 'required|integer|min:1|max:12',
            'annee' => "required|integer|min:{$config['min_year']}|max:{$maxYear}",
            'montant_appartement' => "required|numeric|min:{$config['min_amount']}|max:{$config['max_amount']}",
            'montant_garage' => "nullable|numeric|min:{$config['min_amount']}|max:{$config['max_amount']}",
            'montant_boxe' => "nullable|numeric|min:{$config['min_amount']}|max:{$config['max_amount']}",
        ];
    }

    /**
     * Get validation rules for depenses
     */
    public static function getDepenseValidationRules(): array
    {
        $config = Config::get('syndic.depenses.validation');
        $maxYear = date('Y') + ($config['max_year_offset'] ?? 1);
        $uploadConfig = Config::get('syndic.depenses.upload');

        return [
            'expense_type_id' => 'required|exists:expense_types,id',
            'mois' => 'required|integer|min:1|max:12',
            'annee' => "required|integer|min:{$config['min_year']}|max:{$maxYear}",
            'montant' => "required|numeric|min:{$config['min_amount']}|max:{$config['max_amount']}",
            'detail' => 'nullable|string|max:500',
            'nature_depense' => 'nullable|string|max:255',
            'facture_image' => 'nullable|file|max:' . $uploadConfig['max_file_size'] . '|mimes:' . implode(',', $uploadConfig['allowed_extensions']),
        ];
    }

    /**
     * Get building validation rules
     */
    public static function getBuildingValidationRules(): array
    {
        $config = Config::get('syndic.buildings.validation');

        return [
            'nom_immeuble' => 'required|string|max:255',
            'tranche_id' => 'required|exists:tranches,id',
            'nombre_etages' => "nullable|integer|min:1|max:{$config['max_etages']}",
            'nombre_appartements' => "nullable|integer|min:1|max:{$config['max_appartements']}",
            'description' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get pagination settings
     */
    public static function getPaginationPerPage(string $type = 'default'): int
    {
        $key = $type === 'admin' ? 'admin_per_page' : 'per_page';
        return Config::get("syndic.pagination.{$key}", 15);
    }

    /**
     * Format currency amount
     */
    public static function formatCurrency(float $amount): string
    {
        $config = Config::get('syndic.currency');
        $symbol = $config['symbol'] ?? 'DH';
        $position = $config['position'] ?? 'after';
        $decimals = $config['decimal_places'] ?? 2;

        $formatted = number_format($amount, $decimals);

        return $position === 'before' ? $symbol . ' ' . $formatted : $formatted . ' ' . $symbol;
    }

    /**
     * Get year range for forms
     */
    public static function getYearRange(): array
    {
        $config = Config::get('syndic.cotisations.validation');
        $minYear = $config['min_year'] ?? 2020;
        $maxYear = date('Y') + ($config['max_year_offset'] ?? 1);

        return range($maxYear, $minYear);
    }

    /**
     * Get months array for forms
     */
    public static function getMonthsArray(): array
    {
        return __('app.months');
    }

    /**
     * Check if cotisation amount represents full payment
     */
    public static function isFullPayment(float $totalAmount): bool
    {
        return $totalAmount >= static::getFullPaymentThreshold();
    }

    /**
     * Get status color for cotisation based on amount
     */
    public static function getCotisationStatusColor(float $totalAmount): string
    {
        if ($totalAmount == 0) {
            return 'danger'; // Red for zero amount
        } elseif (static::isFullPayment($totalAmount)) {
            return 'success'; // Green for full payment
        }
        
        return 'primary'; // Default color
    }
}