<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenseTypes = ExpenseType::withCount('depenses')
            ->latest()
            ->paginate(10);
        
        return view('admin.expense-types.index', compact('expenseTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Check if request is for modal
        if ($request->ajax() || $request->has('modal')) {
            return view('admin.expense-types.create-modal');
        }

        return view('admin.expense-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'required|string|max:255|unique:expense_types',
            'description' => 'nullable|string'
        ]);

        ExpenseType::create($validated);

        return redirect()->route('expense-types.index')
            ->with('success', 'Type de dépense créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseType $expenseType)
    {
        $expenseType->load(['depenses' => function($query) {
            $query->latest()->take(10);
        }]);
        
        return view('admin.expense-types.show', compact('expenseType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseType $expenseType)
    {
        return view('admin.expense-types.edit', compact('expenseType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExpenseType $expenseType)
    {
        $validated = $request->validate([
            'nom_type' => 'required|string|max:255|unique:expense_types,nom_type,' . $expenseType->id,
            'description' => 'nullable|string'
        ]);

        $expenseType->update($validated);

        return redirect()->route('expense-types.index')
            ->with('success', 'Type de dépense modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseType $expenseType)
    {
        if ($expenseType->depenses()->count() > 0) {
            return redirect()->route('expense-types.index')
                ->with('error', 'Impossible de supprimer ce type car il contient des dépenses.');
        }

        $expenseType->delete();

        return redirect()->route('expense-types.index')
            ->with('success', 'Type de dépense supprimé avec succès.');
    }
}
