<?php
// database/seeders/FournisseurSeeder.php

namespace Database\Seeders;

use App\Models\Fournisseur;
use Illuminate\Database\Seeder;

class FournisseurSeeder extends Seeder
{
    public function run(): void
    {
        $fournisseurs = [
            [
                'nom' => 'Tech Solutions',
                'email' => 'contact@techsolutions.com',
                'telephone' => '0123456789',
                'adresse' => '123 Avenue de la Technologie, Paris',
            ],
            [
                'nom' => 'Bureau Pro',
                'email' => 'info@bureaupro.com',
                'telephone' => '0198765432',
                'adresse' => '45 Rue du Commerce, Lyon',
            ],
            [
                'nom' => 'Electro Plus',
                'email' => 'ventes@electroplus.com',
                'telephone' => '0147258369',
                'adresse' => '78 Boulevard des Innovations, Marseille',
            ],
        ];

        foreach ($fournisseurs as $fournisseur) {
            Fournisseur::create($fournisseur);
        }
    }
}