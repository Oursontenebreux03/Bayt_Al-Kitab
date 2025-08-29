@extends('layouts.app')

@section('title', 'FAQ - Bayt Al-Kitab')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Questions fréquentes</h1>
                <p class="text-xl text-gray-600">Trouvez rapidement les réponses à vos questions</p>
            </div>

            <!-- Quick Navigation -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Navigation rapide</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="#commandes" class="text-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="text-2xl mb-2">📦</div>
                        <span class="text-sm font-medium text-gray-700">Commandes</span>
                    </a>
                    <a href="#livraison" class="text-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="text-2xl mb-2">🚚</div>
                        <span class="text-sm font-medium text-gray-700">Livraison</span>
                    </a>
                    <a href="#paiement" class="text-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="text-2xl mb-2">💳</div>
                        <span class="text-sm font-medium text-gray-700">Paiement</span>
                    </a>
                    <a href="#retours" class="text-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="text-2xl mb-2">↩️</div>
                        <span class="text-sm font-medium text-gray-700">Retours</span>
                    </a>
                </div>
            </div>

            <!-- FAQ Sections -->
            <div class="space-y-8">
                <!-- Commandes -->
                <div id="commandes" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">📦</span>
                        Commandes
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Comment passer une commande ?</h3>
                            <p class="text-gray-600">Parcourez notre catalogue, ajoutez les livres souhaités à votre panier, puis suivez les étapes de commande. Vous pouvez commander sans créer de compte ou vous inscrire pour un suivi facilité.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Puis-je modifier ma commande ?</h3>
                            <p class="text-gray-600">Vous pouvez modifier votre commande tant qu'elle n'a pas été expédiée. Contactez-nous rapidement par email ou téléphone pour toute modification.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Comment annuler une commande ?</h3>
                            <p class="text-gray-600">Pour annuler une commande, contactez-nous dans les plus brefs délais. Si la commande n'a pas encore été expédiée, l'annulation sera possible sans frais.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Comment suivre ma commande ?</h3>
                            <p class="text-gray-600">Vous recevrez un email de confirmation avec un numéro de suivi. Vous pouvez également suivre votre commande en vous connectant à votre compte si vous en avez un.</p>
                        </div>
                        
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Quand vais-je recevoir ma commande ?</h3>
                            <p class="text-gray-600">La livraison prend généralement 48 à 72 heures ouvrées en France métropolitaine, selon l'option de livraison choisie.</p>
                        </div>
                    </div>
                </div>

                <!-- Livraison -->
                <div id="livraison" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">🚚</span>
                        Livraison
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Quelles sont les options de livraison ?</h3>
                            <p class="text-gray-600">Nous proposons deux options : Mondial Relay (livraison en point relais) et Colissimo (livraison à domicile). Les deux options offrent un suivi en temps réel.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Combien coûtent les frais de livraison ?</h3>
                            <p class="text-gray-600">Les frais de livraison commencent à 4,90€ pour Mondial Relay et 6,90€ pour Colissimo en France métropolitaine. Le coût exact dépend du poids et de la destination.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Livrez-vous à l'étranger ?</h3>
                            <p class="text-gray-600">Oui, nous livrons dans toute l'Europe. Les frais et délais varient selon la destination. Contactez-nous pour les tarifs spécifiques à votre pays.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Que faire si je ne suis pas là lors de la livraison ?</h3>
                            <p class="text-gray-600">Avec Mondial Relay, vous recevrez un avis de passage. Avec Colissimo, le facteur repassera le lendemain ou vous laissera un avis de passage.</p>
                        </div>
                        
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Puis-je modifier l'adresse de livraison ?</h3>
                            <p class="text-gray-600">Oui, vous pouvez modifier l'adresse de livraison jusqu'à l'expédition de votre commande en nous contactant rapidement.</p>
                        </div>
                    </div>
                </div>

                <!-- Paiement -->
                <div id="paiement" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">💳</span>
                        Paiement
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Quels moyens de paiement acceptez-vous ?</h3>
                            <p class="text-gray-600">Nous acceptons les cartes bancaires (Visa, Mastercard), PayPal, et les virements bancaires pour les commandes importantes.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Le paiement est-il sécurisé ?</h3>
                            <p class="text-gray-600">Oui, tous nos paiements sont sécurisés via Stripe, un leader mondial du paiement en ligne. Vos données bancaires ne sont jamais stockées sur nos serveurs.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Puis-je payer en plusieurs fois ?</h3>
                            <p class="text-gray-600">Actuellement, nous n'acceptons que le paiement en une seule fois. Nous étudions la possibilité d'ajouter le paiement en plusieurs fois.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Quand serai-je débité ?</h3>
                            <p class="text-gray-600">Le débit est effectué immédiatement lors de la validation de votre commande. En cas d'annulation, le remboursement sera effectué sous 5 à 10 jours ouvrés.</p>
                        </div>
                        
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Proposez-vous des codes promo ?</h3>
                            <p class="text-gray-600">Oui, nous proposons régulièrement des codes promo. Suivez-nous sur les réseaux sociaux ou inscrivez-vous à notre newsletter pour en être informé.</p>
                        </div>
                    </div>
                </div>

                <!-- Retours -->
                <div id="retours" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">↩️</span>
                        Retours et Remboursements
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Puis-je retourner un livre ?</h3>
                            <p class="text-gray-600">Oui, vous disposez de 14 jours pour retourner un livre non ouvert et dans son état d'origine. Contactez-nous d'abord pour organiser le retour.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Quelles sont les conditions de retour ?</h3>
                            <p class="text-gray-600">Le livre doit être non ouvert, dans son emballage d'origine, et retourné dans les 14 jours suivant la réception. Les frais de retour sont à votre charge.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Comment procéder pour un retour ?</h3>
                            <p class="text-gray-600">Contactez-nous par email ou téléphone en indiquant le numéro de commande et le motif du retour. Nous vous enverrons les instructions de retour.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Dans quel délai serai-je remboursé ?</h3>
                            <p class="text-gray-600">Le remboursement est effectué sous 5 à 10 jours ouvrés après réception et vérification du retour. Il sera effectué sur le moyen de paiement utilisé.</p>
                        </div>
                        
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Que faire si le livre reçu est endommagé ?</h3>
                            <p class="text-gray-600">En cas de livre endommagé, contactez-nous immédiatement avec des photos. Nous organiserons un échange ou un remboursement sans frais.</p>
                        </div>
                    </div>
                </div>

                <!-- Compte et Sécurité -->
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">👤</span>
                        Compte et Sécurité
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Dois-je créer un compte pour commander ?</h3>
                            <p class="text-gray-600">Non, vous pouvez commander en tant qu'invité. Cependant, créer un compte vous permet de suivre vos commandes et d'accélérer les achats futurs.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Comment récupérer mon mot de passe ?</h3>
                            <p class="text-gray-600">Utilisez la fonction "Mot de passe oublié" sur la page de connexion. Vous recevrez un email avec un lien pour réinitialiser votre mot de passe.</p>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Mes données personnelles sont-elles protégées ?</h3>
                            <p class="text-gray-600">Oui, nous respectons le RGPD et ne partageons jamais vos données personnelles avec des tiers. Consultez notre politique de confidentialité pour plus de détails.</p>
                        </div>
                        
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Puis-je supprimer mon compte ?</h3>
                            <p class="text-gray-600">Oui, vous pouvez supprimer votre compte depuis votre espace personnel. Attention, cette action est irréversible.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="mt-12 bg-gradient-to-r from-islamic-green to-green-700 text-white rounded-lg p-8 text-center">
                <h2 class="text-2xl font-bold mb-4">Vous n'avez pas trouvé votre réponse ?</h2>
                <p class="text-lg mb-6 text-green-100">Notre équipe est là pour vous aider</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-3 bg-white text-islamic-green rounded-lg font-semibold hover:bg-gray-100 transition">
                    Contactez-nous
                </a>
            </div>
        </div>
    </div>
@endsection 