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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_etudiant');
            $table->string('prenom_etudiant');
            $table->string('date_de_naissance');
            $table->string('lieu_de_naissance');
            $table->string('numero_piece');
            $table->string('annee_scolaire');
            $table->foreignId('classe_id')->nullable()->constrained()->cascadeOnUpdate()->onDelete('set null');
            $table->string('etat');
            $table->string('deletable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
