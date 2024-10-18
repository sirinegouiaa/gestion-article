<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scategories', function (Blueprint $table) {
            $table->id();
            $table -> string('nomscategorie')->unique();
            $table -> string('imagescategorie')->nullable();
            $table->unsignedBigInteger('categorieID')
            ->foreign("categorieID") //cle etranger 
            ->references("id") // esem l'attribut
            ->on("categories") // esm classe 
            ->onDelete("restrinct");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scategories');
    }
};
