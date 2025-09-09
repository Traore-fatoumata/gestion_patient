<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specialites')->insert([
            [
                'nom' => 'Cardiologie',
                'description' => 'Spécialité médicale qui traite les maladies du cœur et des vaisseaux sanguins.',
            ],
            [
                'nom' => 'Dermatologie',
                'description' => 'Spécialité médicale qui traite les maladies de la peau, des cheveux et des ongles.',
            ],
            [
                'nom' => 'Pédiatrie',
                'description' => 'Médecine spécialisée dans la santé et le développement des enfants.',
            ],
            [
                'nom' => 'Gynécologie',
                'description' => 'Spécialité médicale qui s’occupe de la santé du système reproducteur féminin.',
            ],
            [
                'nom' => 'Neurologie',
                'description' => 'Spécialité qui traite les maladies du système nerveux (cerveau, moelle épinière, nerfs).',
            ],
            [
                'nom' => 'Chirurgie générale',
                'description' => 'Prise en charge chirurgicale des pathologies nécessitant une opération.',
            ],
        ]);
    }
}
