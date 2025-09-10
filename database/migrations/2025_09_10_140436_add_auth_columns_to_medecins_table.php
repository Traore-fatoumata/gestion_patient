<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medecins', function (Blueprint $table) {
            // Ajout sans supprimer les données existantes
            $table->string('telephone')->nullable()->after('prenom');
            $table->string('password')->nullable()->after('telephone');
            $table->rememberToken()->nullable()->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->dropColumn(['telephone', 'password', 'remember_token']);
        });
    }
};
