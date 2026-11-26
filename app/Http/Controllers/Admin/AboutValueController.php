<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutValue;
use Illuminate\Http\Request;

class AboutValueController extends Controller
{
    public function index()
    {
        return view('admin.valeurs.index', [
            'values' => AboutValue::orderBy('ordre')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.valeurs.form', [
            'value' => new AboutValue(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateValue($request);

        // Ordre facultatif : s'il est vide, la valeur est placée en dernier
        $validated['ordre'] = $validated['ordre'] ?? ((int) AboutValue::max('ordre') + 1);

        AboutValue::create($validated);

        return redirect()->route('admin.valeurs.index')->with('success', 'Valeur ajoutée avec succès.');
    }

    public function edit(AboutValue $valeur)
    {
        return view('admin.valeurs.form', [
            'value' => $valeur,
        ]);
    }

    public function update(Request $request, AboutValue $valeur)
    {
        $validated = $this->validateValue($request);

        // Ordre facultatif : s'il est vide, on garde l'ordre actuel
        $validated['ordre'] = $validated['ordre'] ?? $valeur->ordre ?? 0;

        $valeur->update($validated);

        return redirect()->route('admin.valeurs.index')->with('success', 'Valeur mise à jour avec succès.');
    }

    public function destroy(AboutValue $valeur)
    {
        $valeur->delete();

        return redirect()->route('admin.valeurs.index')->with('success', 'Valeur supprimée.');
    }

    private function validateValue(Request $request): array
    {
        return $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'ordre' => 'nullable|integer',
        ]);
    }
}