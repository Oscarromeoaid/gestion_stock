<?php

namespace App\Console\Commands;

use App\Models\Produit;
use App\Models\User;
use App\Notifications\StockBasNotification;
use Illuminate\Console\Command;

class VerifierStockBas extends Command
{
    /**
     * Le nom et la signature de la commande (ce que vous tapez dans le terminal).
     */
    protected $signature = 'stock:verifier';

    /**
     * La description de la commande.
     */
    protected $description = 'Vérifier les produits avec stock bas et envoyer des notifications';

    /**
     * C'est ici que l'on place la logique (le code que vous m'avez montré).
     */
    public function handle()
    {
        $this->info('Vérification des stocks bas...');

        // 1. Récupérer les produits dont la quantité est <= au seuil
        $produitsStockBas = Produit::whereColumn('quantite', '<=', 'seuil_alerte')->get();

        if ($produitsStockBas->isEmpty()) {
            $this->info('✅ Aucun produit en stock bas.');
            return 0;
        }

        // 2. Récupérer tous les utilisateurs (pour qu'ils reçoivent l'alerte)
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->error('❌ Erreur: Aucun utilisateur trouvé en base de données !');
            return 1;
        }

        $this->warn('⚠️ ' . $produitsStockBas->count() . ' produit(s) trouvé(s).');

        // 3. Envoyer les notifications
        foreach ($produitsStockBas as $produit) {
            foreach ($users as $user) {
                // Cette ligne crée l'entrée dans la table 'notifications'
                $user->notify(new StockBasNotification($produit));
            }
            $this->line('- ' . $produit->nom . ' : Notification générée.');
        }

        $this->info('✅ Terminé ! Vérifiez votre table "notifications".');
        return 0;
    }
}