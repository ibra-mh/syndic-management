<?php

namespace App\Http\Controllers;

use App\Models\Appartement;
use App\Models\Immeuble;
use App\Models\Tranche;
use Illuminate\Http\Request;

class AppartementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Appartement::with(['immeuble.tranche']);

        // Apply filters
        if ($request->filled('tranche_id')) {
            $query->whereHas('immeuble', function($q) use ($request) {
                $q->where('tranche_id', $request->tranche_id);
            });
        }
        
        if ($request->filled('immeuble_id')) {
            $query->where('immeuble_id', $request->immeuble_id);
        }

        if ($request->filled('nom_app')) {
            $query->where('nom_app', 'like', '%' . $request->nom_app . '%');
        }

        $appartements = $query->orderBy('immeuble_id')
                             ->orderBy('nom_app')
                             ->paginate(15);

        // Get filter options
        $tranches = Tranche::all();
        $immeubles = Immeuble::all();

        return view('admin.appartements.index', compact('appartements', 'tranches', 'immeubles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tranches = Tranche::all();
        $immeubles = Immeuble::all();

        // Check if request is for modal
        if ($request->ajax() || $request->has('modal')) {
            return view('admin.appartements.create-modal', compact('tranches', 'immeubles'));
        }

        return view('admin.appartements.create', compact('tranches', 'immeubles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'immeuble_id' => 'required|exists:immeubles,id',
            'nom_app' => 'required|string|max:255',
        ]);

        Appartement::create($validated);

        return redirect()->route('appartements.index')
            ->with('success', 'Appartement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appartement $appartement)
    {
        $appartement->load(['immeuble.tranche', 'cotisations']);
        
        return view('admin.appartements.show', compact('appartement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Appartement $appartement)
    {
        $tranches = Tranche::all();
        $immeubles = Immeuble::all();

        // Check if request is for modal
        if ($request->ajax() || $request->has('modal')) {
            return view('admin.appartements.edit-modal', compact('appartement', 'tranches', 'immeubles'));
        }

        return view('admin.appartements.edit', compact('appartement', 'tranches', 'immeubles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appartement $appartement)
    {
        $validated = $request->validate([
            'immeuble_id' => 'required|exists:immeubles,id',
            'nom_app' => 'required|string|max:255',
        ]);

        $appartement->update($validated);

        return redirect()->route('appartements.index')
            ->with('success', 'Appartement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appartement $appartement)
    {
        $appartement->delete();

        return redirect()->route('appartements.index')
            ->with('success', 'Appartement supprimé avec succès.');
    }
}
