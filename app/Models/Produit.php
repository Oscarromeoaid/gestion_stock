<?php
// app/Models/Produit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'sku',
        'description',
        'prix',
        'quantite',
        'seuil_alerte',
        'image',
        'categorie_id',
        'fournisseur_id',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'quantite' => 'integer',
        'seuil_alerte' => 'integer',
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function mouvements(): HasMany
    {
        return $this->hasMany(Mouvement::class);
    }

    // Vérifie si le stock est bas
    public function isStockBas(): bool
    {
        return $this->quantite <= $this->seuil_alerte;
    }

    // Calcule la valeur totale du stock pour ce produit
    public function valeurStock(): float
    {
        return $this->quantite * $this->prix;
    }
}