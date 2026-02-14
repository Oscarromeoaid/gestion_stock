<?php
// app/Models/Mouvement.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mouvement extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'type',
        'quantite',
        'motif',
        'user_id',
        'date_mouvement',
    ];

    protected $casts = [
        'date_mouvement' => 'datetime',
        'quantite' => 'integer',
    ];

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Méthode pour appliquer le mouvement au stock
    public function appliquerMouvement(): void
    {
        $produit = $this->produit;
        
        if ($this->type === 'entree') {
            $produit->quantite += $this->quantite;
        } else {
            $produit->quantite -= $this->quantite;
        }
        
        $produit->save();
    }
}