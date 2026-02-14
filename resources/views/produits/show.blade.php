{{-- resources/views/produits/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails du produit') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('produits.edit', $produit) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    ✏️ Modifier
                </a>
                <a href="{{ route('produits.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    ← Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Informations principales -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <div class="flex items-start gap-6">
                                <!-- Image -->
                                <div class="flex-shrink-0">
                                    @if($produit->image)
                                        <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="h-48 w-48 object-cover rounded-lg shadow">
                                    @else
                                        <div class="h-48 w-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Informations -->
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $produit->nom }}</h3>
                                    
                                    <div class="flex items-center gap-4 mb-4">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                            {{ $produit->categorie->nom }}
                                        </span>
                                        @if($produit->isStockBas())
                                            <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-full">
                                                ⚠️ Stock bas
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                                ✅ Stock OK
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-sm text-gray-500">SKU</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $produit->sku }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Prix unitaire</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ number_format($produit->prix, 2) }} €</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Quantité en stock</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $produit->quantite }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Seuil d'alerte</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $produit->seuil_alerte }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Valeur du stock</p>
                                            <p class="text-lg font-semibold text-green-600">{{ number_format($produit->valeurStock(), 2) }} €</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Fournisseur</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $produit->fournisseur->nom }}</p>
                                        </div>
                                    </div>

                                    @if($produit->description)
                                        <div class="mt-4">
                                            <p class="text-sm text-gray-500 mb-1">Description</p>
                                            <p class="text-gray-700">{{ $produit->description }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Historique des mouvements -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">📋 Historique des mouvements</h3>
                            
                            @if($produit->mouvements->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Motif</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Utilisateur</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($produit->mouvements->sortByDesc('date_mouvement') as $mouvement)
                                                <tr>
                                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                                        {{ $mouvement->date_mouvement->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap">
                                                        @if($mouvement->type === 'entree')
                                                            <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded">
                                                                ↑ Entrée
                                                            </span>
                                                        @else
                                                            <span class="px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded">
                                                                ↓ Sortie
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                        {{ $mouvement->quantite }}
                                                    </td>
                                                    <td class="px-4 py-3 text-sm text-gray-500">
                                                        {{ $mouvement->motif ?: '-' }}
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $mouvement->user->name }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-center text-gray-500 py-8">Aucun mouvement enregistré pour ce produit</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">⚡ Actions rapides</h3>
                            
                            <div class="space-y-3">
                                <a href="{{ route('mouvements.create', ['produit_id' => $produit->id]) }}" 
                                   class="block w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center">
                                    ➕ Ajouter du stock
                                </a>
                                
                                <a href="{{ route('mouvements.create', ['produit_id' => $produit->id, 'type' => 'sortie']) }}" 
                                   class="block w-full bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded text-center">
                                    ➖ Retirer du stock
                                </a>
                                
                                <a href="{{ route('produits.edit', $produit) }}" 
                                   class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                    ✏️ Modifier le produit
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Informations fournisseur -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">📦 Fournisseur</h3>
                            
                            <div class="space-y-2">
                                <div>
                                    <p class="text-sm text-gray-500">Nom</p>
                                    <p class="font-semibold text-gray-900">{{ $produit->fournisseur->nom }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="text-gray-900">{{ $produit->fournisseur->email }}</p>
                                </div>
                                @if($produit->fournisseur->telephone)
                                    <div>
                                        <p class="text-sm text-gray-500">Téléphone</p>
                                        <p class="text-gray-900">{{ $produit->fournisseur->telephone }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('fournisseurs.show', $produit->fournisseur) }}" 
                                   class="text-sm text-blue-600 hover:text-blue-800">
                                    Voir tous les produits de ce fournisseur →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>