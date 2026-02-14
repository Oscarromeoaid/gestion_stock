<?php
// database/seeders/ProduitSeeder.php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $produits = [
            [
                'nom' => 'Ordinateur Portable Dell XPS 15',
                'sku' => 'DELL-XPS-15-001',
                'description' => 'Ordinateur portable haute performance',
                'prix' => 1299.99,
                'quantite' => 15,
                'seuil_alerte' => 5,
                'categorie_id' => 2,
                'fournisseur_id' => 1,
            ],
            [
                'nom' => 'Souris Logitech MX Master 3',
                'sku' => 'LOG-MX3-002',
                'description' => 'Souris ergonomique sans fil',
                'prix' => 99.99,
                'quantite' => 50,
                'seuil_alerte' => 10,
                'categorie_id' => 2,
                'fournisseur_id' => 1,
            ],
            [
                'nom' => 'Chaise de Bureau Ergonomique',
                'sku' => 'CHAIR-ERG-003',
                'description' => 'Chaise de bureau avec support lombaire',
                'prix' => 299.99,
                'quantite' => 8,
                'seuil_alerte' => 3,
                'categorie_id' => 3,
                'fournisseur_id' => 2,
            ],
            [
                'nom' => 'Ramette Papier A4',
                'sku' => 'PAPER-A4-004',
                'description' => 'Ramette de 500 feuilles A4 80g',
                'prix' => 4.99,
                'quantite' => 200,
                'seuil_alerte' => 50,
                'categorie_id' => 4,
                'fournisseur_id' => 2,
            ],
            [
                'nom' => 'Écran LG 27 pouces 4K',
                'sku' => 'LG-27-4K-005',
                'description' => 'Moniteur LED 27 pouces UHD',
                'prix' => 449.99,
                'quantite' => 3,
                'seuil_alerte' => 5,
                'categorie_id' => 1,
                'fournisseur_id' => 3,
            ],
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }
    }
}