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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('Nom',100);
            $table->string('Prenom',250);
            $table->enum('Sexe',['H','F']);
            $table->date('Date_de_Naissance');
            $table->string('Adresse',250);
            $table->string('Telephone',15)->nullable();
            $table->string('Email', 150)->unique()->nullable();
            $table->string('Profession',100);
            $table->text('Antecedents_Medicaux')->nullable();
            $table->string('Numero_Dossier',50)->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
