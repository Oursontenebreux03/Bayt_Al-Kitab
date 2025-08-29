<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bayt Al-Kitab - Votre librairie islamique francophone')</title>
    <meta name="description" content="@yield('description', 'Découvrez notre sélection de livres islamiques de qualité. Coran, Tafsir, apprentissage de l\'arabe, spiritualité et plus encore.')">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'islamic-green': '#15803d',
                        'islamic-light': '#dcfce7',
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <!-- Top Bar -->
            <div class="bg-islamic-green text-white py-2">
                <div class="flex flex-col sm:flex-row justify-between items-center text-sm">
                    <div class="flex items-center space-x-4 mb-2 sm:mb-0">
                        <span class="hidden sm:inline">📞 +33 1 23 45 67 89</span>
                        <span>📧 contact@bayt-al-kitab.fr</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('profile.edit') }}" class="hover:text-islamic-light">Mon compte</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="hover:text-islamic-light">Déconnexion</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-islamic-light">Connexion</a>
                            <a href="{{ route('register') }}" class="hover:text-islamic-light">Inscription</a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Main Header -->
            <div class="py-4">
                <div class="flex flex-col lg:flex-row items-center justify-between space-y-4 lg:space-y-0">
                    <!-- Logo -->
                    <div class="flex items-center space-x-4">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="Bayt Al-Kitab" class="h-12 w-auto">
                        @else
                            <div class="text-4xl">📚</div>
                        @endif
                        <div>
                            <h1 class="text-xl lg:text-2xl font-bold text-islamic-green">Bayt Al-Kitab</h1>
                            <p class="text-xs lg:text-sm text-gray-600">La connaissance au service du cœur</p>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <div class="w-full lg:flex-1 lg:max-w-lg lg:mx-8">
                        <form action="{{ route('shop') }}" method="GET" class="relative">
                            <input type="text" name="search" placeholder="Rechercher un livre..." 
                                   value="{{ request('search') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-islamic-green">
                            <button type="submit" class="absolute right-2 top-2 text-gray-400 hover:text-islamic-green">
                                🔍
                            </button>
                        </form>
                    </div>

                    <!-- Cart & Actions -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('cart') }}" class="relative p-2 text-gray-600 hover:text-islamic-green">
                            🛒
                            @if(session('cart_count', 0) > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ session('cart_count') }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="border-t border-gray-200">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <ul class="flex flex-wrap justify-center lg:justify-start space-x-4 lg:space-x-8 py-4">
                        <li><a href="{{ route('home') }}" class="text-gray-700 hover:text-islamic-green font-medium">Accueil</a></li>
                        <li><a href="{{ route('shop') }}" class="text-gray-700 hover:text-islamic-green font-medium">Boutique</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-islamic-green font-medium">Blog</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-700 hover:text-islamic-green font-medium">À propos</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-700 hover:text-islamic-green font-medium">Contact</a></li>
                    </ul>
                    
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="bg-islamic-green text-white px-4 py-2 rounded-lg text-sm mb-4 lg:mb-0">
                                Administration
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & Description -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="Bayt Al-Kitab" class="h-8 w-auto">
                        @else
                            <div class="text-3xl">📚</div>
                        @endif
                        <h3 class="text-xl font-bold">Bayt Al-Kitab</h3>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Votre librairie islamique francophone. Nous proposons une sélection rigoureuse de livres 
                        pour enrichir votre connaissance et nourrir votre spiritualité.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white">📘 Facebook</a>
                        <a href="#" class="text-gray-300 hover:text-white">📷 Instagram</a>
                        <a href="#" class="text-gray-300 hover:text-white">🐦 Twitter</a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('shop') }}" class="text-gray-300 hover:text-white">Boutique</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white">À propos</a></li>
                        <li><a href="{{ route('delivery') }}" class="text-gray-300 hover:text-white">Livraison</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Informations légales</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">CGV</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Mentions légales</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">RGPD</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Politique de confidentialité</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300">
                    © {{ date('Y') }} Bayt Al-Kitab. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
