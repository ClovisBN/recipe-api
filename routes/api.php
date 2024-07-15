<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;


Route::apiResource('recipes', RecipeController::class);
Route::apiResource('ingredients', IngredientController::class);
