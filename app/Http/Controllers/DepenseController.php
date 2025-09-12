<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DepenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Depense::with('expenseType');

        // Apply filters
        if ($request->filled('annee')) {
            $query->forYear($request->annee);
        }
        
        if ($request->filled('mois')) {
            $query->forMonth($request->mois);
        }
        
        if ($request->filled('expense_type_id')) {
            $query->where('expense_type_id', $request->expense_type_id);
        }

        if ($request->filled('nature_depense')) {
            $query->where('nature_depense', 'like', '%' . $request->nature_depense . '%');
        }

        $depenses = $query->orderBy('annee', 'desc')
                         ->orderBy('mois', 'desc')
                         ->paginate(15);

        // Get filter options
        $expenseTypes = ExpenseType::all();
        $years = range(date('Y'), date('Y') - 5);
        $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        return view('admin.depenses.index', compact('depenses', 'expenseTypes', 'years', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $expenseTypes = ExpenseType::all();
        $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        // Check if request is for modal
        if ($request->ajax() || $request->has('modal')) {
            return view('admin.depenses.create', compact('expenseTypes', 'months'));
        }

        return view('admin.depenses.create', compact('expenseTypes', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_type_id' => 'required|exists:expense_types,id',
            'annee' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'mois' => 'required|integer|min:1|max:12',
            'montant' => 'required|numeric|min:0',
            'detail' => 'nullable|string',
            'nature_depense' => 'required|string|max:255',
            'facture_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('facture_image')) {
            $imagePath = $request->file('facture_image')->store('factures', 'public');
            $validated['facture_image'] = $imagePath;
        }

        Depense::create($validated);

        return redirect()->route('depenses.index')
            ->with('success', 'Dépense créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        $depense->load('expenseType');
        return view('admin.depenses.show', compact('depense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depense $depense)
    {
        $expenseTypes = ExpenseType::all();
        $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        return view('admin.depenses.edit', compact('depense', 'expenseTypes', 'months'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Depense $depense)
    {
        $validated = $request->validate([
            'expense_type_id' => 'required|exists:expense_types,id',
            'annee' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'mois' => 'required|integer|min:1|max:12',
            'montant' => 'required|numeric|min:0',
            'detail' => 'nullable|string',
            'nature_depense' => 'required|string|max:255',
            'facture_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('facture_image')) {
            // Delete old image if exists
            if ($depense->facture_image) {
                Storage::disk('public')->delete($depense->facture_image);
            }
            
            $imagePath = $request->file('facture_image')->store('factures', 'public');
            $validated['facture_image'] = $imagePath;
        }

        $depense->update($validated);

        return redirect()->route('depenses.index')
            ->with('success', 'Dépense mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        // Delete associated image
        if ($depense->facture_image) {
            Storage::disk('public')->delete($depense->facture_image);
        }

        $depense->delete();

        return redirect()->route('depenses.index')
            ->with('success', 'Dépense supprimée avec succès.');
    }
}
