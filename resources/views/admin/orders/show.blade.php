@extends('layouts.app')

@section('title', 'Détails de la commande - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Commande #{{ $order->order_number }}</h1>
            <div class="flex space-x-4">
                <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    ← Retour aux commandes
                </a>
                <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    Tableau de bord
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Informations de la commande -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Statut de la commande -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">Statut de la commande</h2>
                        <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" class="flex items-center space-x-3">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>En cours</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Expédiée</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Livrée</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            </select>
                            <button type="submit" class="bg-islamic-green text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                Mettre à jour
                            </button>
                        </form>
                    </div>
                    
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'processing' => 'bg-blue-100 text-blue-800',
                            'shipped' => 'bg-purple-100 text-purple-800',
                            'delivered' => 'bg-green-100 text-green-800',
                            'cancelled' => 'bg-red-100 text-red-800'
                        ];
                        $color = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $color }}">
                        {{ $order->status_label }}
                    </span>
                </div>

                <!-- Articles de la commande -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Articles commandés</h2>
                    
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex justify-between items-center py-3 border-b border-gray-200 last:border-b-0">
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900">{{ $item->book->title }}</h3>
                                    <p class="text-sm text-gray-500">Quantité : {{ $item->quantity }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-medium text-gray-900">{{ $item->formatted_unit_price }}</p>
                                    <p class="text-sm text-gray-500">Total : {{ $item->formatted_total_price }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Informations client -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Informations client</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nom complet</p>
                            <p class="font-medium text-gray-900">{{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium text-gray-900">{{ $order->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Téléphone</p>
                            <p class="font-medium text-gray-900">{{ $order->shipping_phone ?: $order->user->phone ?: 'Non renseigné' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Adresse</p>
                            <p class="font-medium text-gray-900">
                                {{ $order->shipping_address }}<br>
                                {{ $order->shipping_postal_code }} {{ $order->shipping_city }}<br>
                                {{ $order->shipping_country }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Résumé de la commande -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Résumé</h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sous-total</span>
                            <span class="font-medium">{{ number_format($order->subtotal, 2) }}€</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Livraison</span>
                            <span class="font-medium">{{ number_format($order->shipping_cost, 2) }}€</span>
                        </div>
                        <div class="border-t pt-3">
                            <div class="flex justify-between">
                                <span class="text-lg font-semibold">Total</span>
                                <span class="text-lg font-semibold text-islamic-green">{{ number_format($order->total, 2) }}€</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t">
                        <p class="text-sm text-gray-500">Commande passée le</p>
                        <p class="font-medium text-gray-900">{{ $order->created_at->format('d/m/Y à H:i') }}</p>
                    </div>

                    <div class="mt-6 space-y-3">
                        <button class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                            📧 Envoyer un email
                        </button>
                        <button class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                            📄 Imprimer facture
                        </button>
                        <button class="w-full bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                            🚚 Suivi colis
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 