<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //création des permissions pour le rôle admin
        $permissions = [
            'gerer utilisateurs',
            'gerer medecins',
            'gerer patients',
            'gerer rendezvous',
            'gerer consultations',
            'gerer ordonnances',
            'gerer factures',
            'voir statistiques',
            'voir ses rendez-vous',
            'voir ses consultations'
        ];
        foreach($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);//firstOrCreate verifie si la permission(ou role) existe déjà avant de la créer
        }

        // Créer le rôle admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $medecinRole = Role::firstOrCreate(['name' => 'medecin']);
        $secretaireRole = Role::firstOrCreate(['name' => 'secretaire']);
        $patientRole = Role::firstOrCreate(['name' => 'patient']);

        // Assigner toutes les permissions au rôle admin
        $adminRole->syncPermissions(Permission::all());

        // Assigner des permissions spécifiques au rôle medecin
        $medecinRole->syncPermissions([
            'gerer patients',
            'gerer consultations',
            'gerer ordonnances',
        ]);

        // Assigner des permissions spécifiques au rôle secretaire
        $secretaireRole->syncPermissions([
            'gerer rendezvous',
            'gerer factures'
        ]);

        // Assigner des permissions spécifiques au rôle patient
        $patientRole->syncPermissions([
            'voir ses rendez-vous',
            'voir ses consultations'
        ]);
    }
}
