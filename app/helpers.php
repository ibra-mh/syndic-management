<?php

if (!function_exists('format_currency')) {
    /**
     * Format currency amount using syndic configuration
     */
    function format_currency($amount)
    {
        return \App\Services\SyndicConfigService::formatCurrency($amount);
    }
}

if (!function_exists('get_months_array')) {
    /**
     * Get localized months array
     */
    function get_months_array()
    {
        return \App\Services\SyndicConfigService::getMonthsArray();
    }
}

if (!function_exists('get_default_amounts')) {
    /**
     * Get default cotisation amounts
     */
    function get_default_amounts()
    {
        return \App\Services\SyndicConfigService::getDefaultCotisationAmounts();
    }
}