<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name_recipe');
            $table->text('instructions');
            $table->integer('prep_time')->nullable(); // Temps de préparation en minutes
            $table->integer('cook_time')->nullable(); // Temps de cuisson en minutes
            $table->integer('servings')->nullable(); // Nombre de portions
            $table->integer('calories')->nullable(); // Valeur calorique
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
