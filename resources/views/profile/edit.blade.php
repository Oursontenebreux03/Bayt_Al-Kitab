@extends('layouts.app')

@section('title', 'Mon Compte - Bayt Al-Kitab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Mon Compte</h1>

        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('status') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <nav class="space-y-2">
                        <a href="#profile" class="block px-4 py-2 text-gray-700 bg-gray-100 rounded-lg font-medium">
                            👤 Informations personnelles
                        </a>
                        <a href="#orders" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                            📦 Mes commandes
                        </a>
                        <a href="#addresses" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                            📍 Adresses de livraison
                        </a>
                        <a href="#security" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                            🔒 Sécurité
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Profile Information -->
                <div id="profile" class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Informations personnelles</h2>
                    
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                @error('first_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                @error('last_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Ville</label>
                                <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                @error('city')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">Code postal</label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $user->postal_code) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                @error('postal_code')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Pays</label>
                                <input type="text" name="country" id="country" value="{{ old('country', $user->country) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                @error('country')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="bg-islamic-green text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Orders Section -->
                <div id="orders" class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Mes commandes</h2>
                    
                    <div class="text-center py-8">
                        <div class="text-4xl mb-4">📦</div>
                        <p class="text-gray-600 mb-4">Vous n'avez pas encore passé de commande</p>
                        <a href="{{ route('shop') }}" 
                           class="inline-flex items-center px-4 py-2 bg-islamic-green text-white rounded-lg font-semibold hover:bg-green-700 transition">
                            Découvrir nos livres
                        </a>
                    </div>
                </div>

                <!-- Addresses Section -->
                <div id="addresses" class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Adresses de livraison</h2>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-gray-800">Adresse principale</h3>
                                <button class="text-islamic-green hover:text-green-700 text-sm">Modifier</button>
                            </div>
                            <p class="text-gray-600">
                                {{ $user->address ?: 'Aucune adresse renseignée' }}<br>
                                {{ $user->postal_code ?: '' }} {{ $user->city ?: '' }}<br>
                                {{ $user->country ?: '' }}
                            </p>
                        </div>
                        
                        <button class="w-full border-2 border-dashed border-gray-300 rounded-lg p-4 text-gray-600 hover:border-islamic-green hover:text-islamic-green transition">
                            + Ajouter une nouvelle adresse
                        </button>
                    </div>
                </div>

                <!-- Security Section -->
                <div id="security" class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Sécurité</h2>
                    
                    <div class="space-y-6">
                        <!-- Change Password -->
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-4">Changer le mot de passe</h3>
                            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                                @csrf
                                @method('put')

                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
                                    <input type="password" name="current_password" id="current_password" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                    @error('current_password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                                    <input type="password" name="password" id="password" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le nouveau mot de passe</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                    @error('password_confirmation')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" 
                                            class="bg-islamic-green text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                                        Changer le mot de passe
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Delete Account -->
                        <div class="border-t pt-6">
                            <h3 class="font-semibold text-gray-800 mb-4">Supprimer le compte</h3>
                            <p class="text-gray-600 mb-4">Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.</p>
                            
                            <form method="post" action="{{ route('profile.destroy') }}" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">
                                @csrf
                                @method('delete')
                                <button type="submit" 
                                        class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                                    Supprimer le compte
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Smooth scrolling for navigation
    document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endsection
