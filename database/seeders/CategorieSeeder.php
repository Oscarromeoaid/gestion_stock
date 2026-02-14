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
            ['nom' => 'Électronique', 'description' => 'Appareils et composants électroniques'],
            ['nom' => 'Informatique', 'description' => 'Ordinateurs, périphériques et accessoires'],
            ['nom' => 'Mobilier', 'description' => 'Meubles de bureau et équipements'],
            ['nom' => 'Fournitures', 'description' => 'Fournitures de bureau et consommables'],
            ['nom' => 'Alimentaire', 'description' => 'Produits alimentaires et boissons'],
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }
    }
}