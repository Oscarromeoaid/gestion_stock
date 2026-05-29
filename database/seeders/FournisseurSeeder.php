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
            // Technologie
            [
                'nom' => 'Tech Solutions',
                'email' => 'contact@techsolutions.com',
                'telephone' => '0123456789',
                'adresse' => '123 Avenue de la Technologie, 75001 Paris',
            ],
            [
                'nom' => 'Electro Plus',
                'email' => 'ventes@electroplus.com',
                'telephone' => '0147258369',
                'adresse' => '78 Boulevard des Innovations, 13001 Marseille',
            ],
            [
                'nom' => 'Digital World',
                'email' => 'commercial@digitalworld.fr',
                'telephone' => '0456789123',
                'adresse' => '56 Rue Numérique, 69002 Lyon',
            ],
            [
                'nom' => 'Mobile Store',
                'email' => 'info@mobilestore.fr',
                'telephone' => '0534567890',
                'adresse' => '89 Avenue des Téléphones, 31000 Toulouse',
            ],
            
            // Bureau
            [
                'nom' => 'Bureau Pro',
                'email' => 'info@bureaupro.com',
                'telephone' => '0198765432',
                'adresse' => '45 Rue du Commerce, 69003 Lyon',
            ],
            [
                'nom' => 'Office Supplies',
                'email' => 'contact@officesupplies.fr',
                'telephone' => '0187654321',
                'adresse' => '12 Place de la Mairie, 33000 Bordeaux',
            ],
            [
                'nom' => 'Mobilier Expert',
                'email' => 'ventes@mobilierexpert.fr',
                'telephone' => '0476543210',
                'adresse' => '90 Rue des Meubles, 59000 Lille',
            ],
            
            // Alimentation
            [
                'nom' => 'Food Distribution',
                'email' => 'commandes@fooddistrib.fr',
                'telephone' => '0298765432',
                'adresse' => '34 Avenue des Saveurs, 44000 Nantes',
            ],
            [
                'nom' => 'Boissons & Cie',
                'email' => 'contact@boissons-cie.fr',
                'telephone' => '0312345678',
                'adresse' => '67 Rue de la Soif, 67000 Strasbourg',
            ],
            
            // Entretien
            [
                'nom' => 'Clean Services',
                'email' => 'info@cleanservices.fr',
                'telephone' => '0423456789',
                'adresse' => '23 Boulevard Propre, 06000 Nice',
            ],
            [
                'nom' => 'Hygiene Pro',
                'email' => 'ventes@hygienepro.fr',
                'telephone' => '0534567891',
                'adresse' => '45 Rue de la Santé, 35000 Rennes',
            ],
            
            // Divers
            [
                'nom' => 'Securitech',
                'email' => 'commercial@securitech.fr',
                'telephone' => '0645678912',
                'adresse' => '78 Avenue Sécurité, 54000 Nancy',
            ],
            [
                'nom' => 'Outillage France',
                'email' => 'contact@outillagefrance.fr',
                'telephone' => '0756789123',
                'adresse' => '12 Rue des Artisans, 21000 Dijon',
            ],
            [
                'nom' => 'Pack Express',
                'email' => 'info@packexpress.fr',
                'telephone' => '0867891234',
                'adresse' => '56 Zone Industrielle, 76000 Rouen',
            ],
            [
                'nom' => 'Green Office',
                'email' => 'contact@greenoffice.fr',
                'telephone' => '0978912345',
                'adresse' => '90 Avenue Écologique, 34000 Montpellier',
            ],
        ];

        foreach ($fournisseurs as $fournisseur) {
            Fournisseur::create($fournisseur);
        }
    }
}