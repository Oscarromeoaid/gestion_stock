{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistiques principales -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <!-- Total Produits -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-2">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-xs font-medium text-gray-500">Total Produits</p>
                                <p class="text-xl font-semibold text-gray-900">{{ $totalProduits }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Valeur totale du stock -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-2">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-xs font-medium text-gray-500">Valeur Totale</p>
                                <p class="text-xl font-semibold text-gray-900">{{ number_format($valeurTotaleStock, 0) }} €</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alertes stock bas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-500 rounded-md p-2">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-xs font-medium text-gray-500">Alertes Stock Bas</p>
                                <p class="text-xl font-semibold text-gray-900">{{ $produitsStockBas }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques - Ligne compacte -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
                
                <!-- Répartition par catégorie -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">📊 Stock par catégorie</h3>
                        <div style="height: 180px;">
                            <canvas id="categoriesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Mouvements des 7 derniers jours -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">📈 Mouvements (7j)</h3>
                        <div style="height: 180px;">
                            <canvas id="mouvementsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Top 5 produits -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">🏆 Top 5 produits</h3>
                        <div style="height: 180px;">
                            <canvas id="topProduitsChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Alertes et mouvements - Version compacte -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                
                <!-- Alertes stock bas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">⚠️ Stock Bas</h3>
                        <div class="space-y-2">
                            @forelse($alertesStockBas as $produit)
                                <div class="flex items-center justify-between p-2 bg-red-50 rounded border border-red-200">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $produit->nom }}</p>
                                        <p class="text-xs text-gray-600">{{ $produit->categorie->nom }}</p>
                                    </div>
                                    <div class="text-right ml-2">
                                        <p class="text-sm font-semibold text-red-600">{{ $produit->quantite }}</p>
                                        <p class="text-xs text-gray-500">/ {{ $produit->seuil_alerte }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 text-center py-4">✅ Aucune alerte</p>
                            @endforelse
                        </div>
                        @if($alertesStockBas->count() > 0)
                            <div class="mt-3">
                                <a href="{{ route('produits.index', ['stock_bas' => 1]) }}" class="text-xs text-blue-600 hover:text-blue-800">
                                    Voir tout →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Derniers mouvements -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">📋 Derniers Mouvements</h3>
                        <div class="space-y-2">
                            @forelse($derniersMouvements->take(5) as $mouvement)
                                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                    <div class="flex items-center flex-1 min-w-0">
                                        @if($mouvement->type === 'entree')
                                            <span class="inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-green-700 bg-green-100 rounded">
                                                ↑
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-1.5 py-0.5 text-xs font-medium text-red-700 bg-red-100 rounded">
                                                ↓
                                            </span>
                                        @endif
                                        <div class="ml-2 flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $mouvement->produit->nom }}</p>
                                            <p class="text-xs text-gray-500">{{ $mouvement->date_mouvement->format('d/m H:i') }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right ml-2">
                                        <p class="text-sm font-semibold text-gray-900">{{ $mouvement->quantite }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 text-center py-4">Aucun mouvement</p>
                            @endforelse
                        </div>
                        @if($derniersMouvements->count() > 0)
                            <div class="mt-3">
                                <a href="{{ route('mouvements.index') }}" class="text-xs text-blue-600 hover:text-blue-800">
                                    Voir tout →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts pour les graphiques -->
    <script>
        // Configuration globale
        Chart.defaults.font.size = 11;
        Chart.defaults.plugins.legend.labels.boxWidth = 12;
        Chart.defaults.plugins.legend.labels.padding = 10;

        // 1. Graphique Doughnut - Répartition par catégorie (plus compact que Pie)
        const ctxCategories = document.getElementById('categoriesChart').getContext('2d');
        new Chart(ctxCategories, {
            type: 'doughnut',
            data: {
                labels: @json($categoriesLabels),
                datasets: [{
                    data: @json($categoriesValeurs),
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                    ],
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 10 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed.toFixed(0) + ' €';
                            }
                        }
                    }
                }
            }
        });

        // 2. Graphique Line - Mouvements 7 derniers jours
        const ctxMouvements = document.getElementById('mouvementsChart').getContext('2d');
        new Chart(ctxMouvements, {
            type: 'line',
            data: {
                labels: @json($derniersSeptJours),
                datasets: [
                    {
                        label: 'Entrées',
                        data: @json($entreesParJour),
                        borderColor: 'rgba(16, 185, 129, 1)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.3,
                        fill: true,
                        borderWidth: 2,
                        pointRadius: 2
                    },
                    {
                        label: 'Sorties',
                        data: @json($sortiesParJour),
                        borderColor: 'rgba(239, 68, 68, 1)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.3,
                        fill: true,
                        borderWidth: 2,
                        pointRadius: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 10 }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: { size: 10 }
                        }
                    },
                    x: {
                        ticks: {
                            font: { size: 10 }
                        }
                    }
                }
            }
        });

        // 3. Graphique Bar - Top 5 produits (version horizontale)
        const ctxTopProduits = document.getElementById('topProduitsChart').getContext('2d');
        new Chart(ctxTopProduits, {
            type: 'bar',
            data: {
                labels: @json($topProduitsNoms).map(nom => nom.length > 20 ? nom.substring(0, 20) + '...' : nom),
                datasets: [{
                    label: 'Valeur (€)',
                    data: @json($topProduitsValeurs),
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.x.toFixed(0) + ' €';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            font: { size: 10 }
                        }
                    },
                    y: {
                        ticks: {
                            font: { size: 9 }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>