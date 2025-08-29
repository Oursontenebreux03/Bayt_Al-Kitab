@extends('layouts.app')

@section('title', $category->name . ' - Bayt Al-Kitab')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-islamic-green">Accueil</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('shop') }}" class="hover:text-islamic-green">Boutique</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-800 font-medium">{{ $category->name }}</li>
            </ol>
        </nav>

        <!-- Category Header -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="text-4xl mr-4">{{ $category->icon ?? '📚' }}</div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $category->name }}</h1>
                    @if($category->description)
                        <p class="text-gray-600">{{ $category->description }}</p>
                    @endif
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    {{ $books->total() }} livre(s) trouvé(s)
                </div>
                
                @if($category->parent)
                    <a href="{{ route('category', $category->parent) }}" 
                       class="text-islamic-green hover:underline text-sm">
                        ← Retour à {{ $category->parent->name }}
                    </a>
                @endif
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <div class="lg:w-1/4">
                <!-- Subcategories -->
                @if($subcategories->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-lg font-bold mb-4 text-gray-800">Sous-catégories</h2>
                        <div class="space-y-3">
                            @foreach($subcategories as $subcategory)
                                <a href="{{ route('category', $subcategory) }}" 
                                   class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition">
                                    <div class="flex items-center">
                                        <span class="text-xl mr-3">{{ $subcategory->icon ?? '📁' }}</span>
                                        <span class="text-gray-700">{{ $subcategory->name }}</span>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $subcategory->books->count() }} livre(s)</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Filters -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-bold mb-4 text-gray-800">Filtres</h2>
                    
                    <form method="GET" action="{{ route('category', $category) }}" class="space-y-6">
                        <!-- Language -->
                        <div>
                            <h3 class="font-semibold mb-3 text-gray-700">Langue</h3>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="language" value="fr" 
                                           {{ request('language') == 'fr' ? 'checked' : '' }}
                                           class="text-islamic-green focus:ring-islamic-green">
                                    <span class="ml-2 text-sm text-gray-700">Français</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="language" value="en" 
                                           {{ request('language') == 'en' ? 'checked' : '' }}
                                           class="text-islamic-green focus:ring-islamic-green">
                                    <span class="ml-2 text-sm text-gray-700">Anglais</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="language" value="ar" 
                                           {{ request('language') == 'ar' ? 'checked' : '' }}
                                           class="text-islamic-green focus:ring-islamic-green">
                                    <span class="ml-2 text-sm text-gray-700">Arabe</span>
                                </label>
                            </div>
                        </div>

                        <!-- Audience -->
                        <div>
                            <h3 class="font-semibold mb-3 text-gray-700">Public</h3>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="audience" value="enfants" 
                                           {{ request('audience') == 'enfants' ? 'checked' : '' }}
                                           class="text-islamic-green focus:ring-islamic-green">
                                    <span class="ml-2 text-sm text-gray-700">Enfants</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="audience" value="adultes" 
                                           {{ request('audience') == 'adultes' ? 'checked' : '' }}
                                           class="text-islamic-green focus:ring-islamic-green">
                                    <span class="ml-2 text-sm text-gray-700">Adultes</span>
                                </label>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <h3 class="font-semibold mb-3 text-gray-700">Statut</h3>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="status" value="new" 
                                           {{ request('status') == 'new' ? 'checked' : '' }}
                                           class="text-islamic-green focus:ring-islamic-green">
                                    <span class="ml-2 text-sm text-gray-700">Nouveautés</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="status" value="popular" 
                                           {{ request('status') == 'popular' ? 'checked' : '' }}
                                           class="text-islamic-green focus:ring-islamic-green">
                                    <span class="ml-2 text-sm text-gray-700">Populaires</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="status" value="sale" 
                                           {{ request('status') == 'sale' ? 'checked' : '' }}
                                           class="text-islamic-green focus:ring-islamic-green">
                                    <span class="ml-2 text-sm text-gray-700">En promotion</span>
                                </label>
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div>
                            <h3 class="font-semibold mb-3 text-gray-700">Prix</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs text-gray-600 mb-1">Prix minimum</label>
                                    <input type="number" name="price_min" value="{{ request('price_min') }}" 
                                           placeholder="0" min="0" step="0.01"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-600 mb-1">Prix maximum</label>
                                    <input type="number" name="price_max" value="{{ request('price_max') }}" 
                                           placeholder="100" min="0" step="0.01"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                </div>
                            </div>
                        </div>

                        <!-- Apply Filters -->
                        <button type="submit" 
                                class="w-full bg-islamic-green text-white py-2 px-4 rounded-md text-sm font-semibold hover:bg-green-700 transition">
                            Appliquer les filtres
                        </button>

                        <!-- Clear Filters -->
                        @if(request()->hasAny(['language', 'audience', 'status', 'price_min', 'price_max']))
                            <a href="{{ route('category', $category) }}" 
                               class="block w-full text-center bg-gray-200 text-gray-700 py-2 px-4 rounded-md text-sm font-semibold hover:bg-gray-300 transition">
                                Effacer les filtres
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Books Grid -->
            <div class="lg:w-3/4">
                <!-- Active Filters -->
                @if(request()->hasAny(['language', 'audience', 'status', 'price_min', 'price_max']))
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h3 class="font-semibold text-blue-800 mb-2">Filtres actifs :</h3>
                        <div class="flex flex-wrap gap-2">
                            @if(request('language'))
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                    Langue: {{ request('language') == 'fr' ? 'Français' : (request('language') == 'en' ? 'Anglais' : 'Arabe') }}
                                </span>
                            @endif
                            @if(request('audience'))
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                    Public: {{ request('audience') == 'enfants' ? 'Enfants' : 'Adultes' }}
                                </span>
                            @endif
                            @if(request('status'))
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                    Statut: {{ request('status') == 'new' ? 'Nouveautés' : (request('status') == 'popular' ? 'Populaires' : 'En promotion') }}
                                </span>
                            @endif
                            @if(request('price_min') || request('price_max'))
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                    Prix: {{ request('price_min', 0) }}€ - {{ request('price_max', '∞') }}€
                                </span>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Books -->
                @if($books->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($books as $book)
                            @include('partials.book-card', ['book' => $book])
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($books->hasPages())
                        <div class="mt-8">
                            {{ $books->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-white rounded-lg shadow-md p-12 text-center">
                        <div class="text-6xl mb-4">📚</div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun livre trouvé</h3>
                        <p class="text-gray-600 mb-6">
                            Aucun livre ne correspond à vos critères de recherche dans cette catégorie.
                        </p>
                        <div class="space-x-4">
                            <a href="{{ route('category', $category) }}" 
                               class="inline-flex items-center px-4 py-2 bg-islamic-green text-white rounded-md hover:bg-green-700 transition">
                                Effacer les filtres
                            </a>
                            <a href="{{ route('shop') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition">
                                Voir tous les livres
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Related Categories -->
        @if($category->parent && $category->parent->children->count() > 1)
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Autres catégories similaires</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($category->parent->children->where('id', '!=', $category->id)->take(6) as $relatedCategory)
                        <a href="{{ route('category', $relatedCategory) }}" class="group">
                            <div class="bg-white rounded-lg shadow-md p-4 text-center hover:shadow-lg transition">
                                <div class="text-3xl mb-2">{{ $relatedCategory->icon ?? '📚' }}</div>
                                <h3 class="font-semibold text-gray-800 group-hover:text-islamic-green text-sm">
                                    {{ $relatedCategory->name }}
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">{{ $relatedCategory->books->count() }} livre(s)</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection 