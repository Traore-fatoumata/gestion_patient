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
        Schema::create('element_ordonnance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordonnance_id')->constrained('ordonnances')->onDelete('cascade');
            $table->string('medicament', 100);
            $table->string('dosage', 50)->nullable();
            $table->string('duree', 50)->nullable();
            $table->integer('quantite')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_ordonnance');
    }
};