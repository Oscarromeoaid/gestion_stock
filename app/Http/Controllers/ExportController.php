<?php
// app/Http/Controllers/ExportController.php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Mouvement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\ProduitsExport;
use App\Exports\MouvementsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Export liste des produits en PDF
     */
    public function exportProduitsPdf(Request $request)
    {
        $query = Produit::with(['categorie', 'fournisseur']);

        // Appliquer les filtres si présents
        if ($request->filled('categorie_id')) {
            $query->where('categorie_id', $request->categorie_id);
        }
        if ($request->filled('stock_bas')) {
            $query->whereColumn('quantite', '<=', 'seuil_alerte');
        }

        $produits = $query->get();
        $totalValeur = $produits->sum(function($p) {
            return $p->quantite * $p->prix;
        });

        $pdf = Pdf::loadView('exports.produits-pdf', [
            'produits' => $produits,
            'totalValeur' => $totalValeur,
            'date' => now()->format('d/m/Y H:i'),
        ]);

        return $pdf->download('inventaire_produits_' . now()->format('Y-m-d') . '.pdf');
    }

        public function exportProduitsExcel(Request $request)
    {
        return Excel::download(
            new ProduitsExport($request->all()), 
            'produits_' . now()->format('Y-m-d') . '.xlsx'
        );
    }
public function exportMouvementsExcel(Request $request)
    {
        return Excel::download(
            new MouvementsExport($request->all()), 
            'mouvements_' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    /**
     * Export rapport d'inventaire détaillé en PDF
     */
    public function exportInventairePdf()
    {
        $produits = Produit::with(['categorie', 'fournisseur'])->get();
        
        $statistiques = [
            'total_produits' => $produits->count(),
            'valeur_totale' => $produits->sum(function($p) {
                return $p->quantite * $p->prix;
            }),
            'stock_bas' => $produits->filter(fn($p) => $p->isStockBas())->count(),
            'par_categorie' => $produits->groupBy('categorie.nom')->map(function($items, $key) {
                return [
                    'nom' => $key,
                    'count' => $items->count(),
                    'valeur' => $items->sum(fn($p) => $p->quantite * $p->prix),
                ];
            })->values(),
        ];

        $pdf = Pdf::loadView('exports.inventaire-pdf', [
            'produits' => $produits,
            'statistiques' => $statistiques,
            'date' => now()->format('d/m/Y H:i'),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('rapport_inventaire_' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export mouvements en PDF
     */
    public function exportMouvementsPdf(Request $request)
    {
        $query = Mouvement::with(['produit', 'user']);

        // Appliquer les filtres
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('produit_id')) {
            $query->where('produit_id', $request->produit_id);
        }
        if ($request->filled('date_debut')) {
            $query->whereDate('date_mouvement', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('date_mouvement', '<=', $request->date_fin);
        }

        $mouvements = $query->orderBy('date_mouvement', 'desc')->get();

        $statistiques = [
            'total' => $mouvements->count(),
            'entrees' => $mouvements->where('type', 'entree')->sum('quantite'),
            'sorties' => $mouvements->where('type', 'sortie')->sum('quantite'),
        ];

        $pdf = Pdf::loadView('exports.mouvements-pdf', [
            'mouvements' => $mouvements,
            'statistiques' => $statistiques,
            'filtres' => $request->all(),
            'date' => now()->format('d/m/Y H:i'),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('mouvements_stock_' . now()->format('Y-m-d') . '.pdf');
    }
}