{{-- resources/views/mouvements/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails du mouvement') }}
            </h2>
            <a href="{{ route('mouvements.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <!-- En-tête avec type de mouvement -->
                    <div class="flex items-center justify-between mb-6 pb-6 border-b">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Mouvement #{{ $mouvement->id }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $mouvement->date_mouvement->format('d/m/Y à H:i') }}</p>
                        </div>
                        <div>
                            @if($mouvement->type === 'entree')
                                <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-lg bg-green-100 text-green-800">
                                    ↑ ENTRÉE
                                </span>
                            @else
                                <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-lg bg-red-100 text-red-800">
                                    ↓ SORTIE
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Informations du mouvement -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        
                        <!-- Informations produit -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-semibold text-gray-700 uppercase mb-3">📦 Produit</h4>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-gray-500">Nom</p>
                                    <p class="text-base font-semibold text-gray-900">{{ $mouvement->produit->nom }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">SKU</p>
                                    <p class="text-sm text-gray-900">{{ $mouvement->produit->sku }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Catégorie</p>
                                    <p class="text-sm text-gray-900">{{ $mouvement->produit->categorie->nom }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Fournisseur</p>
                                    <p class="text-sm text-gray-900">{{ $mouvement->produit->fournisseur->nom }}</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('produits.show', $mouvement->produit) }}" 
                                   class="text-sm text-blue-600 hover:text-blue-800">
                                    Voir le produit →
                                </a>
                            </div>
                        </div>

                        <!-- Détails du mouvement -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-semibold text-gray-700 uppercase mb-3">📋 Détails</h4>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-gray-500">Quantité</p>
                                    <p class="text-2xl font-bold {{ $mouvement->type === 'entree' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $mouvement->type === 'entree' ? '+' : '-' }}{{ $mouvement->quantite }} unités
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Date du mouvement</p>
                                    <p class="text-sm text-gray-900">{{ $mouvement->date_mouvement->format('d/m/Y à H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Enregistré par</p>
                                    <p class="text-sm text-gray-900">{{ $mouvement->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Date d'enregistrement</p>
                                    <p class="text-sm text-gray-900">{{ $mouvement->created_at->format('d/m/Y à H:i') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Motif -->
                    @if($mouvement->motif)
                        <div class="bg-blue-50 p-4 rounded-lg mb-6">
                            <h4 class="text-sm font-semibold text-gray-700 uppercase mb-2">💬 Motif / Commentaire</h4>
                            <p class="text-gray-900">{{ $mouvement->motif }}</p>
                        </div>
                    @endif

                    <!-- Stock actuel du produit -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Stock actuel du produit</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $mouvement->produit->quantite }} unités</p>
                            </div>
                            @if($mouvement->produit->isStockBas())
                                <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-full">
                                    ⚠️ Stock bas
                                </span>
                            @else
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                    ✅ Stock OK
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('mouvements.index') }}" 
                           class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            ← Retour à la liste
                        </a>
                        <a href="{{ route('mouvements.create', ['produit_id' => $mouvement->produit_id]) }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Nouveau mouvement pour ce produit
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>