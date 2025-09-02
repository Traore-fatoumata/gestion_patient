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
             $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->date('date_naissance')->nullable();
            $table->enum('genre', ['homme', 'femme', 'autre'])->nullable();
            $table->text('adresse')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('courriel', 100)->nullable();
            $table->string('groupe_sanguin', 5)->nullable();
            $table->text('antecedents_medicaux')->nullable();
            $table->timestamps();
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
