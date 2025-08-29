@extends('layouts.app')

@section('title', 'Modifier utilisateur - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Modifier l'utilisateur</h1>
            <a href="{{ route('admin.users.show', $user) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                ← Retour aux détails
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Informations personnelles -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Informations personnelles</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                            <input type="text" name="first_name" id="first_name" 
                                   value="{{ old('first_name', $user->first_name) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                            <input type="text" name="last_name" id="last_name" 
                                   value="{{ old('last_name', $user->last_name) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email', $user->email) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                    </div>

                    <div class="mt-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                        <input type="tel" name="phone" id="phone" 
                               value="{{ old('phone', $user->phone) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                    </div>
                </div>

                <!-- Adresse -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Adresse</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                            <input type="text" name="address" id="address" 
                                   value="{{ old('address', $user->address) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Ville</label>
                                <input type="text" name="city" id="city" 
                                       value="{{ old('city', $user->city) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                            </div>

                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">Code postal</label>
                                <input type="text" name="postal_code" id="postal_code" 
                                       value="{{ old('postal_code', $user->postal_code) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                            </div>

                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Pays</label>
                                <input type="text" name="country" id="country" 
                                       value="{{ old('country', $user->country) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rôle -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Rôle et permissions</h2>
                    
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Rôle *</label>
                        <select name="role" id="role" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                            <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Utilisateur</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur</option>
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Les administrateurs ont accès à toutes les fonctionnalités de gestion.</p>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <a href="{{ route('admin.users.show', $user) }}" 
                       class="bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-600 transition">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="bg-islamic-green text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 