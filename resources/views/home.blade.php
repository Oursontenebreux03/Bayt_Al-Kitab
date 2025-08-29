@extends('layouts.app')

@section('title', 'Accueil - Bayt Al-Kitab')

@section('content')
    <!-- Hero Banner -->
    <section class="bg-gradient-to-r from-islamic-green to-green-700 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl font-bold mb-6">Votre librairie islamique francophone</h1>
                <p class="text-xl mb-8 text-green-100">La connaissance au service du cœur</p>
                <div class="flex justify-center">
                    <a href="{{ route('shop') }}" class="bg-white text-islamic-green px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Explorer les livres
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Nos catégories principales</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($mainCategories as $category)
                    <a href="{{ route('category', $category) }}" class="group">
                        <div class="bg-gray-50 rounded-lg p-6 text-center hover:bg-islamic-light transition">
                            <div class="text-4xl mb-3">{{ $category->icon ?? '📚' }}</div>
                            <h3 class="font-semibold text-gray-800 group-hover:text-islamic-green">{{ $category->name }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Books Sections -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- New Arrivals -->
            <div class="mb-16">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">📚 Nouveautés</h2>
                    <a href="{{ route('shop') }}" class="text-islamic-green hover:underline">Voir tout →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
                    @forelse($newBooks as $book)
                        @include('partials.book-card', ['book' => $book])
                    @empty
                        <div class="col-span-full text-center py-12 text-gray-500">
                            <p>Aucune nouveauté pour le moment</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Best Sellers -->
            <div class="mb-16">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">🔥 Meilleures ventes</h2>
                    <a href="{{ route('shop') }}" class="text-islamic-green hover:underline">Voir tout →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
                    @forelse($popularBooks as $book)
                        @include('partials.book-card', ['book' => $book])
                    @empty
                        <div class="col-span-full text-center py-12 text-gray-500">
                            <p>Aucun livre populaire pour le moment</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Youth Books -->
            <div>
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">👨‍👩‍👧‍👦 Livres jeunesse</h2>
                    <a href="{{ route('shop') }}" class="text-islamic-green hover:underline">Voir tout →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
                    @forelse($youthBooks as $book)
                        @include('partials.book-card', ['book' => $book])
                    @empty
                        <div class="col-span-full text-center py-12 text-gray-500">
                            <p>Aucun livre jeunesse pour le moment</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Our Commitments -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Nos engagements</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl mb-4">🚚</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Livraison rapide</h3>
                    <p class="text-gray-600">Mondial Relay, Colissimo<br>48-72h ouvrées</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-4">🔒</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Paiement sécurisé</h3>
                    <p class="text-gray-600">Stripe, CB, PayPal<br>Transactions sécurisées</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-4">✅</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Livres sélectionnés</h3>
                    <p class="text-gray-600">Sélection rigoureuse<br>Qualité garantie</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-4">👥</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Équipe disponible</h3>
                    <p class="text-gray-600">À l'écoute et disponible<br>Pour vous accompagner</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-islamic-light">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Témoignages clients</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl">⭐⭐⭐⭐⭐</div>
                    </div>
                    <p class="text-gray-700 mb-4">"Livres bien emballés et reçus rapidement. Service client au top !"</p>
                    <div class="text-sm text-gray-500">- Fatima M.</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl">⭐⭐⭐⭐⭐</div>
                    </div>
                    <p class="text-gray-700 mb-4">"Site clair, je recommande ! Excellente sélection de livres islamiques."</p>
                    <div class="text-sm text-gray-500">- Ahmed K.</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl">⭐⭐⭐⭐⭐</div>
                    </div>
                    <p class="text-gray-700 mb-4">"Parfait pour mes enfants. Livres de qualité et pédagogiques."</p>
                    <div class="text-sm text-gray-500">- Aïcha L.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Discover Islam Section -->
    <section class="py-16 bg-gradient-to-r from-green-600 to-islamic-green text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Découvrir l'islam</h2>
            <p class="text-xl mb-8 text-green-100">Une sélection spéciale pour les débutants et les curieux</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('beginners') }}" class="bg-white text-islamic-green px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Découvrir l'islam
                </a>
            </div>
        </div>
    </section>
@endsection 