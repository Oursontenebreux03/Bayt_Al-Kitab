@extends('layouts.app')

@section('title', 'Découvrir l\'islam - Bayt Al-Kitab')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-islamic-green to-green-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Découvrir l'islam</h1>
            <p class="text-xl text-green-100">Des ressources essentielles pour débuter votre cheminement spirituel</p>
        </div>
    </section>

    <!-- Livres pour débutants -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">📚 Livres pour débutants</h2>
            <p class="text-center text-gray-600 mb-8 max-w-3xl mx-auto">
                Une sélection de livres essentiels pour comprendre les bases de l'islam, 
                parfaits pour les convertis et ceux qui souhaitent approfondir leurs connaissances.
            </p>
            
            @if($beginnerBooks->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($beginnerBooks as $book)
                        @include('partials.book-card', ['book' => $book])
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📖</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun livre pour débutants disponible</h3>
                    <p class="text-gray-600 mb-6">
                        Nous travaillons actuellement sur cette section.
                    </p>
                    <a href="{{ route('shop') }}" 
                       class="bg-islamic-green text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                        Voir tous nos livres
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Corans bilingues -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">🕌 Corans bilingues</h2>
            <p class="text-center text-gray-600 mb-8 max-w-3xl mx-auto">
                Le Coran en arabe avec traduction française pour une compréhension profonde 
                du message divin. Des éditions de qualité pour votre recueillement quotidien.
            </p>
            
            @if($bilingualQurans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($bilingualQurans as $book)
                        @include('partials.book-card', ['book' => $book])
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📿</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun Coran bilingue disponible</h3>
                    <p class="text-gray-600 mb-6">
                        Nous travaillons actuellement sur cette section.
                    </p>
                    <a href="{{ route('shop') }}" 
                       class="bg-islamic-green text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                        Voir tous nos livres
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Conseils pour débutants -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">💡 Conseils pour débuter</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-4xl mb-4">🕯️</div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Commencez par les bases</h3>
                    <p class="text-gray-600">
                        Apprenez les piliers de l'islam et les fondements de la foi avant de vous lancer dans des lectures plus avancées.
                    </p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-4">📖</div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Lisez progressivement</h3>
                    <p class="text-gray-600">
                        Prenez le temps de comprendre chaque concept avant de passer au suivant. La patience est une vertu en islam.
                    </p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-4">🤝</div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">N'hésitez pas à demander</h3>
                    <p class="text-gray-600">
                        Si vous avez des questions, n'hésitez pas à nous contacter. Nous sommes là pour vous accompagner.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection 