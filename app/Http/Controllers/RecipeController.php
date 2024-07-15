<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        return Recipe::with('ingredients')->get();
    }

    public function show($id)
    {
        return Recipe::with('ingredients')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_recipe' => 'required|string|max:255',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer',
            'cook_time' => 'nullable|integer',
            'servings' => 'nullable|integer',
            'calories' => 'nullable|integer',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|integer|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|integer|min:1',
        ]);

        $recipe = Recipe::create($request->only([
            'name_recipe',
            'instructions',
            'prep_time',
            'cook_time',
            'servings',
            'calories',
        ]));

        $recipe->ingredients()->attach(
            collect($request->ingredients)->mapWithKeys(function ($ingredient) {
                return [$ingredient['id'] => ['quantity' => $ingredient['quantity']]];
            })
        );

        return response()->json($recipe->load('ingredients'), 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_recipe' => 'required|string|max:255',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer',
            'cook_time' => 'nullable|integer',
            'servings' => 'nullable|integer',
            'calories' => 'nullable|integer',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|integer|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|integer|min:1',
        ]);

        $recipe = Recipe::findOrFail($id);
        $recipe->update($request->only([
            'name_recipe',
            'instructions',
            'prep_time',
            'cook_time',
            'servings',
            'calories',
        ]));

        $recipe->ingredients()->sync(
            collect($request->ingredients)->mapWithKeys(function ($ingredient) {
                return [$ingredient['id'] => ['quantity' => $ingredient['quantity']]];
            })
        );

        return response()->json($recipe->load('ingredients'), 200);
    }

    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->ingredients()->detach();
        $recipe->delete();

        return response()->json(null, 204);
    }
}
