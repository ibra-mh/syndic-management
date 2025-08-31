<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenseTypes = [
            [
                'nom_type' => 'Entretien',
                'description' => 'Frais d\'entretien général des bâtiments'
            ],
            [
                'nom_type' => 'Électricité',
                'description' => 'Factures d\'électricité des parties communes'
            ],
            [
                'nom_type' => 'Eau',
                'description' => 'Factures d\'eau et assainissement'
            ],
            [
                'nom_type' => 'Chauffage',
                'description' => 'Frais de chauffage collectif'
            ],
            [
                'nom_type' => 'Ascenseur',
                'description' => 'Maintenance et réparation des ascenseurs'
            ],
            [
                'nom_type' => 'Sécurité',
                'description' => 'Services de sécurité et gardiennage'
            ],
            [
                'nom_type' => 'Nettoyage',
                'description' => 'Nettoyage des parties communes'
            ],
            [
                'nom_type' => 'Réparations',
                'description' => 'Réparations diverses dans l\'immeuble'
            ],
            [
                'nom_type' => 'Assurance',
                'description' => 'Assurance de l\'immeuble'
            ],
            [
                'nom_type' => 'Jardinage',
                'description' => 'Entretien des espaces verts'
            ]
        ];

        foreach ($expenseTypes as $type) {
            ExpenseType::create($type);
        }
    }
}
