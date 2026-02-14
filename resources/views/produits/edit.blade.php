{{-- resources/views/produits/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Modifier le produit') }}
            </h2>
            <a href="{{ route('produits.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('produits.update', $produit) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Nom -->
                            <div class="md:col-span-2">
                                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nom du produit <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nom" id="nom" value="{{ old('nom', $produit->nom) }}" required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nom') border-red-500 @enderror">
                                @error('nom')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- SKU -->
                            <div>
                                <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">
                                    SKU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="sku" id="sku" value="{{ old('sku', $produit->sku) }}" required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('sku') border-red-500 @enderror">
                                @error('sku')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Prix -->
                            <div>
                                <label for="prix" class="block text-sm font-medium text-gray-700 mb-1">
                                    Prix (€) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="prix" id="prix" value="{{ old('prix', $produit->prix) }}" step="0.01" min="0" required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('prix') border-red-500 @enderror">
                                @error('prix')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Catégorie -->
                            <div>
                                <label for="categorie_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Catégorie <span class="text-red-500">*</span>
                                </label>
                                <select name="categorie_id" id="categorie_id" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('categorie_id') border-red-500 @enderror">
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ old('categorie_id', $produit->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categorie_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fournisseur -->
                            <div>
                                <label for="fournisseur_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Fournisseur <span class="text-red-500">*</span>
                                </label>
                                <select name="fournisseur_id" id="fournisseur_id" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fournisseur_id') border-red-500 @enderror">
                                    <option value="">Sélectionnez un fournisseur</option>
                                    @foreach($fournisseurs as $fournisseur)
                                        <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id', $produit->fournisseur_id) == $fournisseur->id ? 'selected' : '' }}>
                                            {{ $fournisseur->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fournisseur_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quantité -->
                            <div>
                                <label for="quantite" class="block text-sm font-medium text-gray-700 mb-1">
                                    Quantité <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="quantite" id="quantite" value="{{ old('quantite', $produit->quantite) }}" min="0" required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('quantite') border-red-500 @enderror">
                                @error('quantite')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">💡 Préférez utiliser les mouvements de stock pour modifier la quantité</p>
                            </div>

                            <!-- Seuil d'alerte -->
                            <div>
                                <label for="seuil_alerte" class="block text-sm font-medium text-gray-700 mb-1">
                                    Seuil d'alerte <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="seuil_alerte" id="seuil_alerte" value="{{ old('seuil_alerte', $produit->seuil_alerte) }}" min="0" required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('seuil_alerte') border-red-500 @enderror">
                                @error('seuil_alerte')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="4"
                                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $produit->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image actuelle -->
                            @if($produit->image)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Image actuelle</label>
                                    <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="h-32 w-32 object-cover rounded">
                                </div>
                            @endif

                            <!-- Nouvelle image -->
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ $produit->image ? 'Changer l\'image' : 'Ajouter une image' }}
                                </label>
                                <input type="file" name="image" id="image" accept="image/*"
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('image') border-red-500 @enderror"
                                       onchange="previewImage(event)">
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                
                                <!-- Prévisualisation -->
                                <div id="imagePreview" class="mt-2 hidden">
                                    <img id="preview" src="" alt="Prévisualisation" class="h-32 w-32 object-cover rounded">
                                </div>
                            </div>

                        </div>

                        <!-- Boutons -->
                        <div class="mt-6 flex justify-end gap-3">
                            <a href="{{ route('produits.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Annuler
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>