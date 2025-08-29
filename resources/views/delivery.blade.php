@extends('layouts.app')

@section('title', 'Livraison - Bayt Al-Kitab')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Livraison</h1>
                <p class="text-xl text-gray-600">Informations sur nos services de livraison</p>
            </div>

            <!-- Delivery Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Mondial Relay -->
                <div class="bg-white rounded-lg shadow-md p-8">
                    <div class="text-center mb-6">
                        <div class="text-4xl mb-4">📦</div>
                        <h2 class="text-2xl font-bold text-gray-800">Mondial Relay</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Délai de livraison</span>
                            <span class="font-semibold">48-72h ouvrées</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Frais de livraison</span>
                            <span class="font-semibold">À partir de 4,90€</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Points relais</span>
                            <span class="font-semibold">+6 000 en France</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Suivi en ligne</span>
                            <span class="text-green-600 font-semibold">✓ Disponible</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-semibold text-gray-800 mb-2">Avantages :</h3>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Livraison en point relais</li>
                            <li>• Tarifs avantageux</li>
                            <li>• Suivi en temps réel</li>
                            <li>• Disponible 7j/7</li>
                        </ul>
                    </div>
                </div>

                <!-- Colissimo -->
                <div class="bg-white rounded-lg shadow-md p-8">
                    <div class="text-center mb-6">
                        <div class="text-4xl mb-4">🚚</div>
                        <h2 class="text-2xl font-bold text-gray-800">Colissimo</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Délai de livraison</span>
                            <span class="font-semibold">48-72h ouvrées</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Frais de livraison</span>
                            <span class="font-semibold">À partir de 6,90€</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Livraison</span>
                            <span class="font-semibold">À domicile</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Signature</span>
                            <span class="text-green-600 font-semibold">✓ Requise</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-semibold text-gray-800 mb-2">Avantages :</h3>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Livraison à domicile</li>
                            <li>• Signature obligatoire</li>
                            <li>• Suivi détaillé</li>
                            <li>• Assurance incluse</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Delivery Process -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-12">
                <h2 class="text-2xl font-bold mb-8 text-gray-800 text-center">Comment ça marche ?</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="bg-islamic-green text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
                        <h3 class="font-semibold text-gray-800 mb-2">Commande</h3>
                        <p class="text-sm text-gray-600">Passez votre commande sur notre site</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="bg-islamic-green text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
                        <h3 class="font-semibold text-gray-800 mb-2">Préparation</h3>
                        <p class="text-sm text-gray-600">Nous préparons votre commande sous 24h</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="bg-islamic-green text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
                        <h3 class="font-semibold text-gray-800 mb-2">Expédition</h3>
                        <p class="text-sm text-gray-600">Votre colis est expédié avec suivi</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="bg-islamic-green text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-4">4</div>
                        <h3 class="font-semibold text-gray-800 mb-2">Livraison</h3>
                        <p class="text-sm text-gray-600">Réception en 48-72h ouvrées</p>
                    </div>
                </div>
            </div>

            <!-- Delivery Zones -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-12">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Zones de livraison</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-4">France métropolitaine</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                <span class="text-gray-700">Mondial Relay</span>
                                <span class="font-semibold text-green-600">4,90€</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <span class="text-gray-700">Colissimo</span>
                                <span class="font-semibold text-blue-600">6,90€</span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-4">Europe</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                <span class="text-gray-700">Mondial Relay</span>
                                <span class="font-semibold text-green-600">8,90€</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <span class="text-gray-700">Colissimo</span>
                                <span class="font-semibold text-blue-600">12,90€</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
                    <p class="text-sm text-gray-700">
                        <strong>Note :</strong> Les frais de livraison peuvent varier selon le poids et la destination. 
                        Le calcul exact sera affiché lors de la finalisation de votre commande.
                    </p>
                </div>
            </div>

            <!-- Tracking -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-12">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Suivi de commande</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-4">Comment suivre votre commande</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="text-green-600 text-xl">✓</div>
                                <div>
                                    <p class="text-gray-700">Email de confirmation avec numéro de suivi</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="text-green-600 text-xl">✓</div>
                                <div>
                                    <p class="text-gray-700">Suivi en temps réel sur le site du transporteur</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="text-green-600 text-xl">✓</div>
                                <div>
                                    <p class="text-gray-700">Notifications SMS/Email à chaque étape</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-4">Liens utiles</h3>
                        <div class="space-y-3">
                            <a href="https://www.mondialrelay.fr" target="_blank" 
                               class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700">Suivre un colis Mondial Relay</span>
                                    <span class="text-blue-600">→</span>
                                </div>
                            </a>
                            <a href="https://www.laposte.fr/outils/suivre-vos-envois" target="_blank" 
                               class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700">Suivre un colis Colissimo</span>
                                    <span class="text-blue-600">→</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Questions fréquentes</h2>
                
                <div class="space-y-6">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Combien de temps dure la livraison ?</h3>
                        <p class="text-gray-600">La livraison prend généralement 48 à 72 heures ouvrées en France métropolitaine, selon l'option choisie.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Puis-je modifier l'adresse de livraison ?</h3>
                        <p class="text-gray-600">Oui, vous pouvez modifier l'adresse de livraison jusqu'à l'expédition de votre commande en nous contactant.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Que faire si je ne suis pas là ?</h3>
                        <p class="text-gray-600">Avec Mondial Relay, vous recevrez un avis de passage. Avec Colissimo, le facteur repassera le lendemain ou vous laissera un avis.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Les frais de livraison sont-ils fixes ?</h3>
                        <p class="text-gray-600">Les frais de base sont fixes, mais peuvent varier selon le poids total de votre commande et la destination.</p>
                    </div>
                </div>
                
                <div class="mt-8 text-center">
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-islamic-green text-white rounded-lg font-semibold hover:bg-green-700 transition">
                        Autres questions ? Contactez-nous
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection 