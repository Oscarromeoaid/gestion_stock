{{-- resources/views/fournisseurs/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails du fournisseur') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('fournisseurs.edit', $fournisseur) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    ✏️ Modifier
                </a>
                <a href="{{ route('fournisseurs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    ← Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Informations du fournisseur -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">📦 Informations</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Nom</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $fournisseur->nom }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="text-gray-900">{{ $fournisseur->email }}</p>
                                </div>
                                
                                @if($fournisseur->telephone)
                                    <div>
                                        <p class="text-sm text-gray-500">Téléphone</p>
                                        <p class="text-gray-900">{{ $fournisseur->telephone }}</p>
                                    </div>
                                @endif
                                
                                @if($fournisseur->adresse)
                                    <div>
                                        <p class="text-sm text-gray-500">Adresse</p>
                                        <p class="text-gray-900">{{ $fournisseur->adresse }}</p>
                                    </div>
                                @endif

                                <div>
                                    <p class="text-sm text-gray-500">Nombre de produits</p>
                                    <p class="text-lg font-semibold text-blue-600">{{ $fournisseur->produits->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Liste des produits -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">📋 Produits fournis</h3>
                            
                            @if($fournisseur->produits->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Catégorie</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($fournisseur->produits as $produit)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-4 py-3">
                                                        <div class="text-sm font-medium text-gray-900">{{ $produit->nom }}</div>
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $produit->sku }}
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $produit->categorie->nom }}
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                        {{ number_format($produit->prix, 2) }} €
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap">
                                                        @if($produit->isStockBas())
                                                            <span class="px-2 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                                {{ $produit->quantite }}
                                                            </span>
                                                        @else
                                                            <span class="px-2 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                                {{ $produit->quantite }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('produits.show', $produit) }}" class="text-blue-600 hover:text-blue-900">
                                                            Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-center text-gray-500 py-8">Aucun produit associé à ce fournisseur</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>