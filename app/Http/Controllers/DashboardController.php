<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Mouvement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $totalProduits = Produit::count();
        $valeurTotaleStock = Produit::sum(DB::raw('quantite * prix'));
        $produitsStockBas = Produit::whereColumn('quantite', '<=', 'seuil_alerte')->count();
        
        // Produits avec stock bas
        $alertesStockBas = Produit::with(['categorie', 'fournisseur'])
            ->whereColumn('quantite', '<=', 'seuil_alerte')
            ->orderBy('quantite', 'asc')
            ->limit(5)
            ->get();
        
        // Derniers mouvements
        $derniersMouvements = Mouvement::with(['produit', 'user'])
            ->orderBy('date_mouvement', 'desc')
            ->limit(10)
            ->get();
        
        // Statistiques par catégorie
        $statsCategories = DB::table('produits')
            ->join('categories', 'produits.categorie_id', '=', 'categories.id')
            ->select('categories.nom', DB::raw('COUNT(*) as total'), DB::raw('SUM(quantite * prix) as valeur'))
            ->groupBy('categories.id', 'categories.nom')
            ->get();

        // Données pour les graphiques
        
        // 1. Répartition valeur par catégorie (Pie Chart)
        $categoriesLabels = $statsCategories->pluck('nom')->toArray();
        $categoriesValeurs = $statsCategories->pluck('valeur')->toArray();
        
        // 2. Mouvements des 7 derniers jours (Line Chart)
        $derniersSeptJours = [];
        $entreesParJour = [];
        $sortiesParJour = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $derniersSeptJours[] = Carbon::now()->subDays($i)->format('d/m');
            
            $entrees = Mouvement::whereDate('date_mouvement', $date)
                ->where('type', 'entree')
                ->sum('quantite');
            $entreesParJour[] = $entrees;
            
            $sorties = Mouvement::whereDate('date_mouvement', $date)
                ->where('type', 'sortie')
                ->sum('quantite');
            $sortiesParJour[] = $sorties;
        }
        
        // 3. Top 5 produits par valeur de stock (Bar Chart)
        $topProduits = Produit::select('nom', DB::raw('quantite * prix as valeur'))
            ->orderBy('valeur', 'desc')
            ->limit(5)
            ->get();
        
        $topProduitsNoms = $topProduits->pluck('nom')->toArray();
        $topProduitsValeurs = $topProduits->pluck('valeur')->toArray();

        return view('dashboard', compact(
            'totalProduits',
            'valeurTotaleStock',
            'produitsStockBas',
            'alertesStockBas',
            'derniersMouvements',
            'statsCategories',
            'categoriesLabels',
            'categoriesValeurs',
            'derniersSeptJours',
            'entreesParJour',
            'sortiesParJour',
            'topProduitsNoms',
            'topProduitsValeurs'
        ));
    }
}