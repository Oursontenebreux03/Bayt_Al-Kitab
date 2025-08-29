@extends('layouts.app')

@section('title', 'Détails utilisateur - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Détails utilisateur</h1>
            <div class="flex space-x-4">
                <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    ← Retour aux utilisateurs
                </a>
                <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    Modifier
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Informations utilisateur -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Profil -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 h-20 w-20">
                            <div class="h-20 w-20 rounded-full bg-islamic-green flex items-center justify-center">
                                <span class="text-white font-semibold text-2xl">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h2 class="text-2xl font-bold text-gray-900">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </h2>
                            <p class="text-gray-600">{{ $user->email }}</p>
                            @if($user->role === 'admin')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 mt-2">
                                    Administrateur
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-2">
                                    Utilisateur
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Informations personnelles</h3>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Nom d'utilisateur</p>
                                    <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Prénom</p>
                                    <p class="font-medium text-gray-900">{{ $user->first_name ?: 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Nom</p>
                                    <p class="font-medium text-gray-900">{{ $user->last_name ?: 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Téléphone</p>
                                    <p class="font-medium text-gray-900">{{ $user->phone ?: 'Non renseigné' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Adresse</h3>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Adresse</p>
                                    <p class="font-medium text-gray-900">{{ $user->address ?: 'Non renseignée' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Ville</p>
                                    <p class="font-medium text-gray-900">{{ $user->city ?: 'Non renseignée' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Code postal</p>
                                    <p class="font-medium text-gray-900">{{ $user->postal_code ?: 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Pays</p>
                                    <p class="font-medium text-gray-900">{{ $user->country ?: 'Non renseigné' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commandes -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Historique des commandes</h3>
                    
                    @if($user->orders && $user->orders->count() > 0)
                        <div class="space-y-4">
                            @foreach($user->orders as $order)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900">Commande #{{ $order->id ?? 'N/A' }}</p>
                                            <p class="text-sm text-gray-500">{{ $order->created_at ?? 'Date inconnue' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium text-gray-900">{{ number_format($order->total ?? 0, 2) }}€</p>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ $order->status ?? 'Statut inconnu' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-4xl mb-4">📦</div>
                            <p class="text-gray-500">Aucune commande pour le moment</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Statistiques -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Statistiques</h3>
                    
                    <div class="space-y-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $user->orders_count ?? 0 }}</div>
                            <p class="text-sm text-blue-600">Commandes</p>
                        </div>
                        
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $user->created_at->format('d/m/Y') }}</div>
                            <p class="text-sm text-green-600">Inscrit le</p>
                        </div>
                        
                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">{{ $user->email_verified_at ? 'Oui' : 'Non' }}</div>
                            <p class="text-sm text-purple-600">Email vérifié</p>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t">
                        <h4 class="font-semibold mb-3 text-gray-800">Actions rapides</h4>
                        <div class="space-y-2">
                            <button class="w-full bg-blue-500 text-white px-3 py-2 rounded text-sm hover:bg-blue-600 transition">
                                📧 Envoyer un email
                            </button>
                            <button class="w-full bg-green-500 text-white px-3 py-2 rounded text-sm hover:bg-green-600 transition">
                                🔑 Réinitialiser mot de passe
                            </button>
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-500 text-white px-3 py-2 rounded text-sm hover:bg-red-600 transition">
                                        🗑️ Supprimer l'utilisateur
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 