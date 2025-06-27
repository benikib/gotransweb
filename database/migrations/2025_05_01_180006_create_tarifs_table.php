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
        // Schema::create('tarifs', function (Blueprint $table) {
        //     $table->id();
        //     $table->string("nom")->nullable();
        //     $table->integer('kilo_tarif');
        //     $table->integer('prix_tarif');
        //     $table->timestamps();
        // });
    Schema::create('tarifs', function (Blueprint $table) {
    $table->id();
    $table->String('type')->default('kilo'); // Type de tarif (ex: "au kilo", "au volume", etc.)
    $table->string('nom');
    $table->integer('valeur')->nullable(); // Poids en kg pour les tarifs au kilo
    $table->decimal('prix', );
    $table->String('devise')->default('$'); // Devise du tarif, par défaut en dirhams marocains (MAD)
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifs');
    }
};
