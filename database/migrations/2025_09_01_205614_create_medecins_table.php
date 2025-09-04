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
            $table->timestamps();

            $table->string('Nom_Prenom', 250);
            $table->enum('Sexe', ['H', 'F']);
            $table->string('Specialite', 150);
            $table->string('Telephone', 15)->nullable();
            $table->string('Email', 150)->unique()->nullable();
            $table->json('Disponibilites')->nullable();
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
