<?php

namespace App\Models;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IngredientCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name_ingredient_category'];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class, 'category_id');
    }
}
