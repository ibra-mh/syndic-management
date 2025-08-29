<?php

namespace App\Http\Controllers;

use App\Models\Tranche;
use Illuminate\Http\Request;

class TrancheController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tranches = Tranche::with('immeubles')->get();
        return view('admin.tranches.index', compact('tranches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tranches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_tranche' => 'required|string|max:255|unique:tranches'
        ]);

        Tranche::create($validated);

        return redirect()->route('tranches.index')
            ->with('success', 'Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tranche $tranche)
    {
        $tranche->load('immeubles');
        return view('admin.tranches.show', compact('tranche'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tranche $tranche)
    {
        return view('admin.tranches.edit', compact('tranche'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tranche $tranche)
    {
        $validated = $request->validate([
            'nom_tranche' => 'required|string|max:255|unique:tranches,nom_tranche,' . $tranche->id
        ]);

        $tranche->update($validated);

        return redirect()->route('tranches.index')
            ->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tranche $tranche)
    {
        $tranche->delete();

        return redirect()->route('tranches.index')
            ->with('success', 'Section deleted successfully.');
    }
}
