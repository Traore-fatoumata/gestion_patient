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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rendez_vous_id')->nullable()->constrained('rendez_vous')->onDelete('set null');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('restrict');
            $table->foreignId('medecin_id')->constrained('medecins')->onDelete('restrict');
            $table->date('date');
            $table->text('diagnostic')->nullable();
            $table->text('traitement')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
