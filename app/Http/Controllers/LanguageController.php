<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Change the application language
     */
    public function change(Request $request, $locale)
    {
        // Validate locale
        $supportedLocales = ['fr', 'en'];
        
        if (in_array($locale, $supportedLocales)) {
            Session::put('locale', $locale);
            app()->setLocale($locale);
        }

        return redirect()->back();
    }
}