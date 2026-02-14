{{-- resources/views/mouvements/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Enregistrer un mouvement de stock') }}
            </h2>
            <a href="{{ route('mouvements.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('mouvements.store') }}" method="POST" id="mouvementForm">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Produit -->
                            <div class="md:col-span-2">
                                <label for="produit_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Produit <span class="text-red-500">*</span>
                                </label>
                                <select name="produit_id" id="produit_id" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('produit_id') border-red-500 @enderror"
                                        onchange="updateProductInfo()">
                                    <option value="">Sélectionnez un produit</option>
                                    @foreach($produits as $produit)
                                        <option value="{{ $produit->id }}" 
                                                data-stock="{{ $produit->quantite }}"
                                                data-nom="{{ $produit->nom }}"
                                                data-sku="{{ $produit->sku }}"
                                                data-categorie="{{ $produit->categorie->nom }}"
                                                {{ old('produit_id', request('produit_id')) == $produit->id ? 'selected' : '' }}>
                                            {{ $produit->nom }} ({{ $produit->sku }}) - Stock: {{ $produit->quantite }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('produit_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Info produit sélectionné -->
                            <div id="productInfo" class="md:col-span-2 hidden bg-blue-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">Informations du produit</h4>
                                <div class="grid grid-cols-2 gap-2 text-sm">
                                    <div>
                                        <span class="text-gray-600">Nom:</span>
                                        <span id="info-nom" class="font-medium text-gray-900 ml-2"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">SKU:</span>
                                        <span id="info-sku" class="font-medium text-gray-900 ml-2"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Catégorie:</span>
                                        <span id="info-categorie" class="font-medium text-gray-900 ml-2"></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Stock actuel:</span>
                                        <span id="info-stock" class="font-medium text-green-600 ml-2"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Type de mouvement -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                    Type de mouvement <span class="text-red-500">*</span>
                                </label>
                                <select name="type" id="type" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('type') border-red-500 @enderror"
                                        onchange="updateTypeStyle()">
                                    <option value="">Sélectionnez un type</option>
                                    <option value="entree" {{ old('type', request('type')) == 'entree' ? 'selected' : '' }}>↑ Entrée (Approvisionnement)</option>
                                    <option value="sortie" {{ old('type', request('type')) == 'sortie' ? 'selected' : '' }}>↓ Sortie (Vente/Utilisation)</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quantité -->
                            <div>
                                <label for="quantite" class="block text-sm font-medium text-gray-700 mb-1">
                                    Quantité <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="quantite" id="quantite" value="{{ old('quantite', 1) }}" min="1" required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('quantite') border-red-500 @enderror"
                                       oninput="updateNewStock()">
                                @error('quantite')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p id="stockWarning" class="mt-1 text-sm text-red-600 hidden">⚠️ Stock insuffisant pour cette sortie</p>
                                <p id="newStock" class="mt-1 text-sm text-gray-600 hidden"></p>
                            </div>

                            <!-- Date du mouvement -->
                            <div>
                                <label for="date_mouvement" class="block text-sm font-medium text-gray-700 mb-1">
                                    Date du mouvement <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" name="date_mouvement" id="date_mouvement" 
                                       value="{{ old('date_mouvement', now()->format('Y-m-d\TH:i')) }}" required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('date_mouvement') border-red-500 @enderror">
                                @error('date_mouvement')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Motif -->
                            <div class="md:col-span-2">
                                <label for="motif" class="block text-sm font-medium text-gray-700 mb-1">
                                    Motif / Commentaire
                                </label>
                                <textarea name="motif" id="motif" rows="3"
                                          placeholder="Ex: Réception commande fournisseur, Vente client, Inventaire, etc."
                                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('motif') border-red-500 @enderror">{{ old('motif') }}</textarea>
                                @error('motif')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <!-- Boutons -->
                        <div class="mt-6 flex justify-end gap-3">
                            <a href="{{ route('mouvements.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Annuler
                            </a>
                            <button type="submit" id="submitBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Enregistrer le mouvement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentStock = 0;

        function updateProductInfo() {
            const select = document.getElementById('produit_id');
            const option = select.options[select.selectedIndex];
            const productInfo = document.getElementById('productInfo');

            if (option.value) {
                currentStock = parseInt(option.dataset.stock);
                document.getElementById('info-nom').textContent = option.dataset.nom;
                document.getElementById('info-sku').textContent = option.dataset.sku;
                document.getElementById('info-categorie').textContent = option.dataset.categorie;
                document.getElementById('info-stock').textContent = currentStock + ' unités';
                productInfo.classList.remove('hidden');
                updateNewStock();
            } else {
                productInfo.classList.add('hidden');
            }
        }

        function updateTypeStyle() {
            updateNewStock();
        }

        function updateNewStock() {
            const type = document.getElementById('type').value;
            const quantite = parseInt(document.getElementById('quantite').value) || 0;
            const newStockElement = document.getElementById('newStock');
            const warningElement = document.getElementById('stockWarning');
            const submitBtn = document.getElementById('submitBtn');

            if (!type || !quantite || currentStock === 0) {
                newStockElement.classList.add('hidden');
                warningElement.classList.add('hidden');
                return;
            }

            let newStock = currentStock;
            if (type === 'entree') {
                newStock = currentStock + quantite;
                newStockElement.textContent = `Nouveau stock après entrée: ${newStock} unités`;
                newStockElement.classList.remove('hidden', 'text-red-600');
                newStockElement.classList.add('text-green-600');
                warningElement.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else if (type === 'sortie') {
                newStock = currentStock - quantite;
                if (newStock < 0) {
                    warningElement.classList.remove('hidden');
                    newStockElement.classList.add('hidden');
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    warningElement.classList.add('hidden');
                    newStockElement.textContent = `Nouveau stock après sortie: ${newStock} unités`;
                    newStockElement.classList.remove('hidden', 'text-green-600');
                    newStockElement.classList.add('text-orange-600');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
        }

        // Initialiser si un produit est pré-sélectionné
        document.addEventListener('DOMContentLoaded', function() {
            const produitSelect = document.getElementById('produit_id');
            if (produitSelect.value) {
                updateProductInfo();
            }
        });
    </script>
</x-app-layout>