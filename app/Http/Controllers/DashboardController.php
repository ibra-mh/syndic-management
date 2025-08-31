<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use App\Models\Depense;
use App\Models\ExpenseType;
use App\Models\Appartement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return $this->admin(request());
        }
        
        // For regular users, show a simple dashboard
        return view('dashboard');
    }
    
    public function admin(Request $request)
    {
        // Calculer les statistiques
        $totalCotisations = Cotisation::sum('montant_garage') + Cotisation::sum('montant_boxe') + Cotisation::sum('montant_appartement');
        $totalDepenses = Depense::sum('montant');
        $totalAppartements = Appartement::count();
        
        // Récupérer les types de dépenses pour le filtre
        $expenseTypes = ExpenseType::all();
        
        // Filtrer les dépenses selon le type sélectionné
        $depensesQuery = Depense::with('expenseType');
        
        if ($request->has('type_filter') && $request->type_filter) {
            $depensesQuery->where('expense_type_id', $request->type_filter);
        }
        
        $depenses = $depensesQuery->latest()->paginate(10);
        
        // Calculer le total des dépenses filtrées
        $totalDepensesFiltered = null;
        if ($request->has('type_filter') && $request->type_filter) {
            $totalDepensesFiltered = $depensesQuery->sum('montant');
        }
        
        return view('admin.dashboard', compact(
            'totalCotisations',
            'totalDepenses',
            'totalAppartements',
            'expenseTypes',
            'depenses',
            'totalDepensesFiltered'
        ));
    }
}
