<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class IngredientController extends Controller
{
    // Affiche tous les ingrédients
    public function index()
    {
        return response()->json(Ingredient::with('category')->get(), 200);
    }

    // Affiche un ingrédient spécifique
    public function show($id)
    {
        $ingredient = Ingredient::with('category')->find($id);

        if (is_null($ingredient)) {
            return response()->json(['message' => 'Ingrédient non trouvé'], 404);
        }

        return response()->json($ingredient, 200);
    }

    // Crée un nouvel ingrédient
    public function store(Request $request)
    {
        $request->validate([
            'name_ingredient' => 'required|string|max:255',
            'category_id' => 'nullable|exists:ingredient_categories,id',
        ]);

        $ingredient = Ingredient::create($request->all());

        return response()->json($ingredient->load('category'), 201);
    }

    // Met à jour un ingrédient existant
    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::find($id);

        if (is_null($ingredient)) {
            return response()->json(['message' => 'Ingrédient non trouvé'], 404);
        }

        $request->validate([
            'name_ingredient' => 'sometimes|required|string|max:255',
            'category_id' => 'nullable|exists:ingredient_categories,id',
        ]);

        $ingredient->update($request->all());

        return response()->json($ingredient->load('category'), 200);
    }

    // Supprime un ingrédient
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);

        if (is_null($ingredient)) {
            return response()->json(['message' => 'Ingrédient non trouvé'], 404);
        }

        $ingredient->delete();

        return response()->json(null, 204);
    }
}
