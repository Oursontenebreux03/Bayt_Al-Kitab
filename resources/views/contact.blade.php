@extends('layouts.app')

@section('title', 'Contact - Bayt Al-Kitab')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Contactez-nous</h1>
                <p class="text-xl text-gray-600">Notre équipe est là pour vous accompagner</p>
            </div>

            <!-- Contact Information - Centered -->
            <div class="max-w-2xl mx-auto space-y-8">
                    <!-- Contact Details -->
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Nos coordonnées</h2>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="text-2xl">📞</div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Téléphone</h3>
                                    <p class="text-gray-600">+33 1 23 45 67 89</p>
                                    <p class="text-sm text-gray-500">Lun-Ven : 9h-18h</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="text-2xl">📧</div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Email</h3>
                                    <p class="text-gray-600">contact@bayt-al-kitab.fr</p>
                                    <p class="text-sm text-gray-500">Réponse sous 24h</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="text-2xl">📍</div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Adresse</h3>
                                    <p class="text-gray-600">
                                        Bayt Al-Kitab<br>
                                        123 Rue de la Connaissance<br>
                                        75001 Paris, France
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Quick Links -->
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Questions fréquentes</h2>
                        
                        <div class="space-y-4">
                            <a href="{{ route('faq') }}#livraison" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                <h3 class="font-semibold text-gray-800">Comment fonctionne la livraison ?</h3>
                                <p class="text-sm text-gray-600">Délais, options de livraison, frais...</p>
                            </a>
                            
                            <a href="{{ route('faq') }}#retours" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                <h3 class="font-semibold text-gray-800">Comment retourner un livre ?</h3>
                                <p class="text-sm text-gray-600">Conditions, délais, procédure...</p>
                            </a>
                            
                            <a href="{{ route('faq') }}#paiement" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                <h3 class="font-semibold text-gray-800">Moyens de paiement acceptés</h3>
                                <p class="text-sm text-gray-600">CB, PayPal, sécurité...</p>
                            </a>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Suivez-nous</h2>
                        
                        <div class="flex space-x-4">
                            <a href="#" class="flex-1 bg-blue-600 text-white py-3 px-4 rounded-lg text-center hover:bg-blue-700 transition">
                                📘 Facebook
                            </a>
                            <a href="#" class="flex-1 bg-pink-600 text-white py-3 px-4 rounded-lg text-center hover:bg-pink-700 transition">
                                📷 Instagram
                            </a>
                            <a href="#" class="flex-1 bg-blue-400 text-white py-3 px-4 rounded-lg text-center hover:bg-blue-500 transition">
                                🐦 Twitter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 