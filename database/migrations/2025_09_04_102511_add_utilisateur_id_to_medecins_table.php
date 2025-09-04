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
        Schema::table('medecins', function (Blueprint $table) {
            //
            $table->foreignId('utilisateur_id')
            ->nullable()  // Permet d'accepter des valeurs nulles
            ->constrained('utilisateurs') // Référence la table 'Utilisateurs'
            ->onDelete('cascade'); // Si l'utilisateur est supprimé, le médecin associé le sera aussi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medecins', function (Blueprint $table) {
            //
            $table->dropForeign(['utilisateur_id']);
            $table->dropColumn('utilisateur_id');
        });
    }
};
