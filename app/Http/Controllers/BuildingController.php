<?php

namespace App\Http\Controllers;

use App\Models\Immeuble;
use App\Models\Tranche;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Immeuble::with('tranche')->latest()->paginate(10);
        return view('admin.buildings.index', compact('buildings'));
    }

    public function create()
    {
        $tranches = Tranche::all();
        if (request()->ajax()) {
            return view('admin.buildings.create', compact('tranches'));
        }
        return view('admin.buildings.create', compact('tranches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_immeuble' => 'required|string|max:255',
            'tranche_id' => 'required|exists:tranches,id',
        ]);
        Immeuble::create($validated);
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Building added successfully.', 'redirect' => route('buildings.index')]);
        }
        return redirect()->route('buildings.index')->with('success', 'Building added successfully.');
    }

    public function edit(Immeuble $building)
    {
        $tranches = Tranche::all();
        return view('admin.buildings.edit', ['building' => $building, 'tranches' => $tranches]);
    }

    public function update(Request $request, Immeuble $building)
    {
        $validated = $request->validate([
            'nom_immeuble' => 'required|string|max:255',
            'tranche_id' => 'required|exists:tranches,id',
        ]);
        $building->update($validated);
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Building updated successfully.', 'redirect' => route('buildings.index')]);
        }
        return redirect()->route('buildings.index')->with('success', 'Building updated successfully.');
    }

    public function destroy(Immeuble $building)
    {
        $building->delete();
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Building deleted successfully.', 'redirect' => route('buildings.index')]);
        }
        return redirect()->route('buildings.index')->with('success', 'Building deleted successfully.');
    }
}
