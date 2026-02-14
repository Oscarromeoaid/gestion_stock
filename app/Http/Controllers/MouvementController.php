<?php
// app/Http/Controllers/MouvementController.php

namespace App\Http\Controllers;

use App\Models\Mouvement;
use App\Models\Produit;
use App\Models\User;
use App\Notifications\StockBasNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MouvementController extends Controller
{
    public function index(Request $request)
    {
        $query = Mouvement::with(['produit', 'user']);

        // Filtre par type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filtre par produit
        if ($request->filled('produit_id')) {
            $query->where('produit_id', $request->produit_id);
        }

        // Filtre par date
        if ($request->filled('date_debut')) {
            $query->whereDate('date_mouvement', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('date_mouvement', '<=', $request->date_fin);
        }

        $mouvements = $query->orderBy('date_mouvement', 'desc')->paginate(15);
        $produits = Produit::orderBy('nom')->get();

        return view('mouvements.index', compact('mouvements', 'produits'));
    }

    public function create()
    {
        $produits = Produit::with('categorie')->orderBy('nom')->get();
        return view('mouvements.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'type' => 'required|in:entree,sortie',
            'quantite' => 'required|integer|min:1',
            'motif' => 'nullable|string',
            'date_mouvement' => 'required|date',
        ]);

        $produit = Produit::findOrFail($validated['produit_id']);

        // Vérifier le stock disponible pour les sorties
        if ($validated['type'] === 'sortie' && $produit->quantite < $validated['quantite']) {
            return back()->withErrors([
                'quantite' => 'Stock insuffisant. Stock actuel : ' . $produit->quantite
            ])->withInput();
        }

        DB::transaction(function () use ($validated, $produit) {
            // Créer le mouvement
            Mouvement::create([
                'produit_id' => $validated['produit_id'],
                'type' => $validated['type'],
                'quantite' => $validated['quantite'],
                'motif' => $validated['motif'],
                'user_id' => Auth::id(),
                'date_mouvement' => $validated['date_mouvement'],
            ]);

            // Mettre à jour le stock
            if ($validated['type'] === 'entree') {
                $produit->quantite += $validated['quantite'];
            } else {
                $produit->quantite -= $validated['quantite'];
            }
            $produit->save();

            // Vérifier si le stock est devenu bas et envoyer une notification
            if ($produit->isStockBas()) {
                $users = User::all();
                foreach ($users as $user) {
                    $user->notify(new StockBasNotification($produit));
                }
            }
        });

        return redirect()->route('mouvements.index')
            ->with('success', 'Mouvement enregistré avec succès.');
    }

    public function show(Mouvement $mouvement)
    {
        $mouvement->load(['produit.categorie', 'produit.fournisseur', 'user']);
        return view('mouvements.show', compact('mouvement'));
    }
}