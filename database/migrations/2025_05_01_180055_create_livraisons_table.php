<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->enum('status', ['en_attente','en_cours', 'livree', 'annulee']);
            $table->string('code');
            $table->float('montant');
            $table->foreignId('expedition_id')->constrained('expeditions')->onDelete('cascade');
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');

            $table->foreignId('client_expediteur_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('client_destinateur_id')->constrained('clients')->onDelete('cascade');

            $table->foreignId('vehicule_id')->constrained('vehicules')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
