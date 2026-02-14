{{-- resources/views/notifications/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Notifications') }}
            </h2>
            @if(Auth::user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifications.readAll') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        ✓ Tout marquer comme lu
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if($notifications->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <p class="text-lg">Aucune notification</p>
                    </div>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg {{ $notification->read_at ? '' : 'border-l-4 border-blue-500' }}">
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <!-- Icône -->
                                        <div class="flex items-center mb-2">
                                            @if($notification->type === 'App\Notifications\StockBasNotification')
                                                <span class="flex-shrink-0 inline-flex items-center justify-center h-10 w-10 rounded-full bg-red-100 text-red-600 mr-3">
                                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                    </svg>
                                                </span>
                                            @endif
                                            
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $notification->data['message'] ?? 'Notification' }}
                                                </p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Détails -->
                                        @if(isset($notification->data['produit_nom']))
                                            <div class="mt-3 ml-13 bg-gray-50 p-3 rounded text-sm">
                                                <p><strong>Produit :</strong> {{ $notification->data['produit_nom'] }}</p>
                                                <p><strong>SKU :</strong> {{ $notification->data['produit_sku'] }}</p>
                                                <p><strong>Stock actuel :</strong> <span class="text-red-600 font-semibold">{{ $notification->data['quantite'] }} unités</span></p>
                                                <p><strong>Seuil d'alerte :</strong> {{ $notification->data['seuil_alerte'] }} unités</p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex-shrink-0 ml-4 flex gap-2">
                                        @if(!$notification->read_at)
                                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm">
                                                    ✓ Marquer lu
                                                </button>
                                            </form>
                                        @endif

                                        @if(isset($notification->data['produit_id']))
                                            <a href="{{ route('produits.show', $notification->data['produit_id']) }}" 
                                               class="text-indigo-600 hover:text-indigo-800 text-sm">
                                                Voir produit →
                                            </a>
                                        @endif

                                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" 
                                              onsubmit="return confirm('Supprimer cette notification ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>