<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use App\Models\Appartement;
use App\Models\Immeuble;
use App\Models\Tranche;
use App\Services\SyndicConfigService;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cotisation::with(['appartement.immeuble.tranche']);

        // Apply filters
        if ($request->filled('annee')) {
            $query->forYear($request->annee);
        }
        
        if ($request->filled('mois')) {
            $query->forMonth($request->mois);
        }
        
        if ($request->filled('appartement_id')) {
            $query->forAppartement($request->appartement_id);
        }

        $cotisations = $query->orderBy('annee', 'desc')
                           ->orderBy('mois', 'desc')
                           ->paginate(SyndicConfigService::getPaginationPerPage());

        // Get filter options
        $appartements = Appartement::with('immeuble')->get();
        $years = SyndicConfigService::getYearRange();
        $months = SyndicConfigService::getMonthsArray();

        return view('admin.cotisations.index', compact('cotisations', 'appartements', 'years', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tranches = Tranche::with('immeubles.appartements')->get();
        $appartements = Appartement::with('immeuble.tranche')->get();
        $months = SyndicConfigService::getMonthsArray();
        $defaultAmounts = SyndicConfigService::getDefaultCotisationAmounts();

        $data = compact('tranches', 'appartements', 'months', 'defaultAmounts');

        // Check if request is for modal (AJAX)
        if ($request->ajax() || $request->has('modal')) {
            return view('admin.cotisations.create', $data);
        }

        return view('admin.cotisations.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(SyndicConfigService::getCotisationValidationRules());

        // Set defaults for optional fields
        $validated['montant_garage'] = $validated['montant_garage'] ?? 0;
        $validated['montant_boxe'] = $validated['montant_boxe'] ?? 0;

        // Check for duplicate (same apartment, month, year)
        $existing = Cotisation::where('appartement_id', $validated['appartement_id'])
                              ->where('mois', $validated['mois'])
                              ->where('annee', $validated['annee'])
                              ->first();

        if ($existing) {
            return back()->withErrors(['duplicate' => __('app.cotisation.duplicate_error')])->withInput();
        }

        Cotisation::create($validated);

        return redirect()->route('cotisations.index')->with('success', __('app.cotisation.created_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cotisation $cotisation)
    {
        $cotisation->load(['appartement.immeuble.tranche']);
        return view('admin.cotisations.show', compact('cotisation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cotisation $cotisation)
    {
        $tranches = Tranche::with('immeubles.appartements')->get();
        $appartements = Appartement::with('immeuble.tranche')->get();
        $months = SyndicConfigService::getMonthsArray();

        $cotisation->load(['appartement.immeuble.tranche']);

        return view('admin.cotisations.edit', compact('cotisation', 'tranches', 'appartements', 'months'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cotisation $cotisation)
    {
        $validated = $request->validate([
            'appartement_id' => 'required|exists:appartements,id',
            'mois' => 'required|integer|min:1|max:12',
            'annee' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'montant_appartement' => 'required|numeric|min:0',
            'montant_garage' => 'nullable|numeric|min:0',
            'montant_boxe' => 'nullable|numeric|min:0',
        ]);

        // Set defaults for optional fields
        $validated['montant_garage'] = $validated['montant_garage'] ?? 0;
        $validated['montant_boxe'] = $validated['montant_boxe'] ?? 0;

        // Check for duplicate (excluding current record)
        $existing = Cotisation::where('appartement_id', $validated['appartement_id'])
                              ->where('mois', $validated['mois'])
                              ->where('annee', $validated['annee'])
                              ->where('id', '!=', $cotisation->id)
                              ->first();

        if ($existing) {
            return back()->withErrors(['duplicate' => 'Une cotisation existe déjà pour cet appartement ce mois-ci.'])->withInput();
        }

        $cotisation->update($validated);

        return redirect()->route('cotisations.index')->with('success', 'Cotisation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cotisation $cotisation)
    {
        $cotisation->delete();
        return redirect()->route('cotisations.index')->with('success', 'Cotisation supprimée avec succès.');
    }

    /**
     * Get appartements by immeuble (AJAX)
     */
    public function getAppartementsByImmeuble(Request $request)
    {
        $appartements = Appartement::where('immeuble_id', $request->immeuble_id)->get();
        return response()->json($appartements);
    }

    /**
     * Get immeubles by tranche (AJAX)
     */
    public function getImmeublesbyTranche(Request $request)
    {
        $immeubles = Immeuble::where('tranche_id', $request->tranche_id)->get();
        return response()->json($immeubles);
    }
}
