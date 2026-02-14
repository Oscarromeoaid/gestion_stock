<?php
// app/Notifications/StockBasNotification.php

namespace App\Notifications;

use App\Models\Produit;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// Supprimez "implements ShouldQueue" ici pour le test
class StockBasNotification extends Notification 
{
    // Supprimez ou commentez "use Queueable;"
    
    protected $produit;

    public function __construct(Produit $produit)
    {
        $this->produit = $produit;
    }

    public function via($notifiable): array
    {
        // On s'assure que 'database' est là
        return ['database', 'mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('⚠️ Alerte Stock Bas - ' . $this->produit->nom)
            ->line('Le produit ' . $this->produit->nom . ' est bas.')
            ->action('Voir le produit', route('produits.show', $this->produit->id));
    }

    public function toArray($notifiable): array
    {
        return [
            'produit_id'   => $this->produit->id,
            'produit_nom'  => $this->produit->nom,
            'produit_sku'  => $this->produit->sku,
            'quantite'     => $this->produit->quantite,
            'seuil_alerte' => $this->produit->seuil_alerte,
            'message'      => 'Le produit ' . $this->produit->nom . ' a un stock bas (' . $this->produit->quantite . ' unités)',
        ];
    }
}