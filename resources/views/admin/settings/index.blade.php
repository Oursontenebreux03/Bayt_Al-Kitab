@extends('layouts.app')

@section('title', 'Paramètres du site - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Paramètres du site</h1>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                ← Retour au tableau de bord
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
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Informations générales -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Informations générales</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">Nom du site *</label>
                            <input type="text" name="site_name" id="site_name" 
                                   value="{{ old('site_name', $settings['site_name']->value ?? 'Bayt Al-Kitab') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        </div>

                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Email de contact *</label>
                            <input type="email" name="contact_email" id="contact_email" 
                                   value="{{ old('contact_email', $settings['contact_email']->value ?? 'contact@bayt-al-kitab.com') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="site_description" class="block text-sm font-medium text-gray-700 mb-2">Description du site</label>
                        <textarea name="site_description" id="site_description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green"
                                  placeholder="Description qui apparaîtra dans les moteurs de recherche...">{{ old('site_description', $settings['site_description']->value ?? 'Votre librairie islamique francophone - La connaissance au service du cœur') }}</textarea>
                    </div>
                </div>

                <!-- Logo -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Logo du site</h2>
                    
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0">
                            @if(isset($settings['logo']) && $settings['logo']->value)
                                <img src="{{ asset('storage/' . $settings['logo']->value) }}" alt="Logo actuel" 
                                     class="w-24 h-24 object-contain border border-gray-300 rounded-lg">
                            @else
                                <img src="{{ asset('images/logo.png') }}" alt="Logo actuel" 
                                     class="w-24 h-24 object-contain border border-gray-300 rounded-lg">
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Nouveau logo</label>
                            <input type="file" name="logo" id="logo" accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                            <p class="text-sm text-gray-500 mt-1">Formats acceptés : JPEG, PNG, JPG, GIF. Taille max : 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Informations de contact -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Informations de contact</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                            <input type="tel" name="contact_phone" id="contact_phone" 
                                   value="{{ old('contact_phone', $settings['contact_phone']->value ?? '+33 1 23 45 67 89') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                            <input type="text" name="address" id="address" 
                                   value="{{ old('address', $settings['address']->value ?? '123 Rue de la Paix, 75001 Paris') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        </div>
                    </div>
                </div>

                <!-- Paramètres de livraison -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Paramètres de livraison</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="delivery_time" class="block text-sm font-medium text-gray-700 mb-2">Délai de livraison standard</label>
                            <select name="delivery_time" id="delivery_time" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                <option value="2-3">2-3 jours ouvrés</option>
                                <option value="3-5">3-5 jours ouvrés</option>
                                <option value="5-7">5-7 jours ouvrés</option>
                            </select>
                        </div>

                        <div>
                            <label for="free_shipping_threshold" class="block text-sm font-medium text-gray-700 mb-2">Seuil livraison gratuite (€)</label>
                            <input type="number" name="free_shipping_threshold" id="free_shipping_threshold" 
                                   value="{{ old('free_shipping_threshold', $settings['free_shipping_threshold']->value ?? '50') }}" min="0" step="0.01"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        </div>

                        <div>
                            <label for="shipping_cost" class="block text-sm font-medium text-gray-700 mb-2">Coût livraison standard (€)</label>
                            <input type="number" name="shipping_cost" id="shipping_cost" 
                                   value="{{ old('shipping_cost', $settings['shipping_cost']->value ?? '5.90') }}" min="0" step="0.01"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        </div>
                    </div>
                </div>

                <!-- Paramètres de paiement -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Paramètres de paiement</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="stripe_enabled" id="stripe_enabled" 
                                   {{ old('stripe_enabled', $settings['stripe_enabled']->value ?? true) ? 'checked' : '' }}
                                   class="text-islamic-green focus:ring-islamic-green">
                            <label for="stripe_enabled" class="ml-2 text-sm text-gray-700">Activer Stripe</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="paypal_enabled" id="paypal_enabled" 
                                   {{ old('paypal_enabled', $settings['paypal_enabled']->value ?? true) ? 'checked' : '' }}
                                   class="text-islamic-green focus:ring-islamic-green">
                            <label for="paypal_enabled" class="ml-2 text-sm text-gray-700">Activer PayPal</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="bank_transfer_enabled" id="bank_transfer_enabled" 
                                   {{ old('bank_transfer_enabled', $settings['bank_transfer_enabled']->value ?? false) ? 'checked' : '' }}
                                   class="text-islamic-green focus:ring-islamic-green">
                            <label for="bank_transfer_enabled" class="ml-2 text-sm text-gray-700">Activer virement bancaire</label>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <button type="button" onclick="window.location.reload()" 
                            class="bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-600 transition">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="bg-islamic-green text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                        Sauvegarder les paramètres
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 