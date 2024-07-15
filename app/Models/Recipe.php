<?php

namespace App\Models;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_recipe', 
        'instructions', 
        'prep_time', 
        'cook_time', 
        'servings', 
        'calories'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredients_quantity')->withPivot('quantity')->withTimestamps();
    }
}
