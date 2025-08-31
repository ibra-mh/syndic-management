<?php

namespace App\Http\Controllers;

use App\Models\Immeuble;
use App\Models\Tranche;
use Illuminate\Http\Request;

class ImmeubleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $immeubles = Immeuble::with(['tranche', 'appartements'])
            ->withCount('appartements')
            ->latest()
            ->paginate(10);

        return view('admin.immeubles.index', compact('immeubles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tranches = Tranche::all();
        return view('admin.immeubles.create', compact('tranches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_immeuble' => 'required|string|max:255',
            'tranche_id' => 'required|exists:tranches,id',
            'nombre_etages' => 'required|integer|min:1',
            'nombre_appartements' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|in:actif,inactif'
        ]);

        Immeuble::create($validated);

        return redirect()->route('immeubles.index')
            ->with('success', 'Immeuble ajouté avec succès.');
    }

    public function show(Immeuble $immeuble)
    {
        $immeuble->load(['tranche', 'appartements.proprietaire']);
        return view('admin.immeubles.show', compact('immeuble'));
    }

    public function edit(Immeuble $immeuble)
    {
        $tranches = Tranche::all();
        return view('admin.immeubles.edit', compact('immeuble', 'tranches'));
    }

    public function update(Request $request, Immeuble $immeuble)
    {
        $validated = $request->validate([
            'nom_immeuble' => 'required|string|max:255',
            'tranche_id' => 'required|exists:tranches,id',
            'nombre_etages' => 'required|integer|min:1',
            'nombre_appartements' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|in:actif,inactif'
        ]);

        $immeuble->update($validated);

        return redirect()->route('immeubles.show', $immeuble->id)
            ->with('success', 'Immeuble modifié avec succès.');
    }

    public function destroy(Immeuble $immeuble)
    {
        $immeuble->delete();

        return redirect()->route('immeubles.index')
            ->with('success', 'Immeuble supprimé avec succès.');
    }
}
