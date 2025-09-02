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
        Schema::create('medecins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs')->onDelete('set null');
            $table->string('nom');
            $table->string('prenom');
            $table->foreignId('specialite_id')->constrained('specialites')->onDelete('restrict');
            $table->text('biographie')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('annees_experience')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecins');
    }
};
