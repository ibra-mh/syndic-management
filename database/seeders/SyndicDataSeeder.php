<?php

namespace Database\Seeders;

use App\Models\Tranche;
use App\Models\Immeuble;
use App\Models\Appartement;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SyndicDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample tranches (sections)
        $tranche1 = Tranche::create([
            'nom_tranche' => 'Secteur A',
            'description' => 'Premier secteur résidentiel',
            'status' => 'actif'
        ]);

        $tranche2 = Tranche::create([
            'nom_tranche' => 'Secteur B',
            'description' => 'Deuxième secteur résidentiel',
            'status' => 'actif'
        ]);

        $tranche3 = Tranche::create([
            'nom_tranche' => 'Secteur C',
            'description' => 'Troisième secteur résidentiel',
            'status' => 'actif'
        ]);

        // Create sample immeubles (buildings)
        $immeuble1 = Immeuble::create([
            'nom_immeuble' => 'Résidence Les Roses',
            'tranche_id' => $tranche1->id,
            'nombre_etages' => 5,
            'nombre_appartements' => 20,
            'description' => 'Immeuble moderne avec ascenseur',
            'status' => 'actif'
        ]);

        $immeuble2 = Immeuble::create([
            'nom_immeuble' => 'Villa Jasmin',
            'tranche_id' => $tranche1->id,
            'nombre_etages' => 4,
            'nombre_appartements' => 16,
            'description' => 'Villa familiale avec jardin',
            'status' => 'actif'
        ]);

        $immeuble3 = Immeuble::create([
            'nom_immeuble' => 'Complexe Palmier',
            'tranche_id' => $tranche2->id,
            'nombre_etages' => 6,
            'nombre_appartements' => 24,
            'description' => 'Grand complexe résidentiel',
            'status' => 'actif'
        ]);

        $immeuble4 = Immeuble::create([
            'nom_immeuble' => 'Tour Horizon',
            'tranche_id' => $tranche3->id,
            'nombre_etages' => 8,
            'nombre_appartements' => 32,
            'description' => 'Tour moderne avec vue panoramique',
            'status' => 'actif'
        ]);

        // Create sample proprietaires (property owners)
        $proprietaires = [
            User::create([
                'name' => 'Ahmed Bennani',
                'email' => 'ahmed.bennani@example.com',
                'password' => bcrypt('password'),
                'role' => 'client'
            ]),
            User::create([
                'name' => 'Fatima Alaoui',
                'email' => 'fatima.alaoui@example.com',
                'password' => bcrypt('password'),
                'role' => 'client'
            ]),
            User::create([
                'name' => 'Youssef Tazi',
                'email' => 'youssef.tazi@example.com',
                'password' => bcrypt('password'),
                'role' => 'client'
            ]),
            User::create([
                'name' => 'Aicha Mansouri',
                'email' => 'aicha.mansouri@example.com',
                'password' => bcrypt('password'),
                'role' => 'client'
            ])
        ];

        // Create sample apartments
        $appartements = [
            // Résidence Les Roses
            ['immeuble' => $immeuble1, 'numero' => 'A101', 'etage' => 1, 'surface' => 85.5, 'proprietaire' => $proprietaires[0]],
            ['immeuble' => $immeuble1, 'numero' => 'A102', 'etage' => 1, 'surface' => 90.0, 'proprietaire' => $proprietaires[1]],
            ['immeuble' => $immeuble1, 'numero' => 'A201', 'etage' => 2, 'surface' => 85.5, 'proprietaire' => null],
            ['immeuble' => $immeuble1, 'numero' => 'A202', 'etage' => 2, 'surface' => 90.0, 'proprietaire' => $proprietaires[2]],
            
            // Villa Jasmin
            ['immeuble' => $immeuble2, 'numero' => 'B101', 'etage' => 1, 'surface' => 75.0, 'proprietaire' => $proprietaires[3]],
            ['immeuble' => $immeuble2, 'numero' => 'B102', 'etage' => 1, 'surface' => 80.0, 'proprietaire' => null],
            ['immeuble' => $immeuble2, 'numero' => 'B201', 'etage' => 2, 'surface' => 75.0, 'proprietaire' => $proprietaires[0]],
            
            // Complexe Palmier
            ['immeuble' => $immeuble3, 'numero' => 'C101', 'etage' => 1, 'surface' => 95.0, 'proprietaire' => $proprietaires[1]],
            ['immeuble' => $immeuble3, 'numero' => 'C102', 'etage' => 1, 'surface' => 100.0, 'proprietaire' => $proprietaires[2]],
            ['immeuble' => $immeuble3, 'numero' => 'C201', 'etage' => 2, 'surface' => 95.0, 'proprietaire' => null],
            
            // Tour Horizon
            ['immeuble' => $immeuble4, 'numero' => 'D101', 'etage' => 1, 'surface' => 110.0, 'proprietaire' => $proprietaires[3]],
            ['immeuble' => $immeuble4, 'numero' => 'D102', 'etage' => 1, 'surface' => 115.0, 'proprietaire' => $proprietaires[0]],
            ['immeuble' => $immeuble4, 'numero' => 'D201', 'etage' => 2, 'surface' => 110.0, 'proprietaire' => null],
        ];

        foreach ($appartements as $apt) {
            Appartement::create([
                'numero' => $apt['numero'],
                'etage' => $apt['etage'],
                'surface' => $apt['surface'],
                'status' => $apt['proprietaire'] ? 'occupé' : 'vacant',
                'immeuble_id' => $apt['immeuble']->id,
                'proprietaire_id' => $apt['proprietaire']?->id
            ]);
        }
    }
}
