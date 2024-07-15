<?php

namespace App\Models;

use App\Models\Recipe;
use App\Models\IngredientCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name_ingredient', 'category_id'];

    public function category()
    {
        return $this->belongsTo(IngredientCategory::class, 'category_id');
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'ingredients_quantity')->withPivot('quantity')->withTimestamps();
    }
}
