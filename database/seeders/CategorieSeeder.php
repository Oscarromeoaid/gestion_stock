<?php
// database/seeders/CategorieSeeder.php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Technologie
            ['nom' => 'Électronique', 'description' => 'Appareils et composants électroniques'],
            ['nom' => 'Informatique', 'description' => 'Ordinateurs, périphériques et accessoires'],
            ['nom' => 'Téléphonie', 'description' => 'Smartphones, tablettes et accessoires'],
            ['nom' => 'Audio & Vidéo', 'description' => 'Équipements audio, vidéo et streaming'],
            ['nom' => 'Réseaux', 'description' => 'Routeurs, switches et équipements réseau'],
            
            // Bureau
            ['nom' => 'Mobilier', 'description' => 'Meubles de bureau et équipements'],
            ['nom' => 'Fournitures', 'description' => 'Fournitures de bureau et consommables'],
            ['nom' => 'Papeterie', 'description' => 'Papiers, cahiers et classement'],
            ['nom' => 'Impression', 'description' => 'Imprimantes, cartouches et consommables'],
            
            // Alimentation
            ['nom' => 'Alimentaire', 'description' => 'Produits alimentaires et boissons'],
            ['nom' => 'Boissons', 'description' => 'Boissons chaudes et froides'],
            ['nom' => 'Snacks', 'description' => 'Collations et en-cas'],
            
            // Entretien
            ['nom' => 'Entretien', 'description' => 'Produits d\'entretien et nettoyage'],
            ['nom' => 'Hygiène', 'description' => 'Produits d\'hygiène et sanitaires'],
            
            // Divers
            ['nom' => 'Vêtements', 'description' => 'Vêtements professionnels et EPI'],
            ['nom' => 'Outillage', 'description' => 'Outils et équipements techniques'],
            ['nom' => 'Sécurité', 'description' => 'Équipements de protection et sécurité'],
            ['nom' => 'Décoration', 'description' => 'Éléments décoratifs et plantes'],
            ['nom' => 'Stockage', 'description' => 'Solutions de rangement et stockage'],
            ['nom' => 'Emballage', 'description' => 'Matériel d\'emballage et expédition'],
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }
    }
}