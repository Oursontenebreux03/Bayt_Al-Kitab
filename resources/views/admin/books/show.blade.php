<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - Administration Bayt Al-Kitab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-green-600 text-white shadow">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Détail du Livre</h1>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.books.index') }}" class="bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded">← Retour à la liste</a>
                        <span>Bienvenue, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 px-4 py-2 rounded">Déconnexion</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8">
            <div class="max-w-6xl mx-auto">
                <!-- Action Buttons -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">{{ $book->title }}</h2>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.books.edit', $book) }}" 
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                            ✏️ Modifier
                        </a>
                        <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="inline" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                🗑️ Supprimer
                            </button>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Images Section -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Images du livre</h3>
                        @if($book->images && count($book->images) > 0)
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($book->images as $index => $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image) }}" 
                                             alt="Image {{ $index + 1 }}" 
                                             class="w-full h-48 object-cover rounded-lg shadow">
                                        @if($index === 0)
                                            <span class="absolute top-2 left-2 bg-green-500 text-white px-2 py-1 rounded text-xs">Image principale</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <span class="text-6xl">📚</span>
                                <p class="mt-2">Aucune image disponible</p>
                            </div>
                        @endif
                    </div>

                    <!-- Book Information -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Informations du livre</h3>
                        
                        <div class="space-y-4">
                            <!-- Title -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Titre</label>
                                <p class="text-lg font-semibold text-gray-900">{{ $book->title }}</p>
                            </div>

                            <!-- Author -->
                            @if($book->author)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Auteur</label>
                                    <p class="text-gray-900">{{ $book->author }}</p>
                                </div>
                            @endif

                            <!-- Publisher -->
                            @if($book->publisher)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Éditeur</label>
                                    <p class="text-gray-900">{{ $book->publisher }}</p>
                                </div>
                            @endif

                            <!-- Price -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Prix</label>
                                <div class="flex items-center space-x-2">
                                    @if($book->is_on_sale && $book->sale_price)
                                        <span class="text-lg line-through text-gray-500">{{ number_format($book->price, 2) }}€</span>
                                        <span class="text-2xl font-bold text-red-600">{{ number_format($book->sale_price, 2) }}€</span>
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">
                                            -{{ $book->discount_percentage }}%
                                        </span>
                                    @else
                                        <span class="text-2xl font-bold text-gray-900">{{ number_format($book->price, 2) }}€</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Stock -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Stock</label>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $book->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $book->stock }} exemplaire(s)
                                </span>
                            </div>

                            <!-- Status Badges -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Statuts</label>
                                <div class="flex flex-wrap gap-2">
                                    @if($book->is_new)
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">🆕 Nouveau</span>
                                    @endif
                                    @if($book->is_popular)
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">⭐ Populaire</span>
                                    @endif
                                    @if($book->is_on_sale)
                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">🔥 Promotion</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Categories -->
                            @if($book->categories->count() > 0)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégories</label>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($book->categories as $category)
                                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Additional Details -->
                <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Technical Details -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Détails techniques</h3>
                        <div class="grid grid-cols-2 gap-4">
                            @if($book->isbn)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">ISBN</label>
                                    <p class="text-gray-900">{{ $book->isbn }}</p>
                                </div>
                            @endif
                            
                            @if($book->pages)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pages</label>
                                    <p class="text-gray-900">{{ $book->pages }}</p>
                                </div>
                            @endif
                            
                            @if($book->format)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Format</label>
                                    <p class="text-gray-900">{{ $book->format }}</p>
                                </div>
                            @endif
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Langue</label>
                                <p class="text-gray-900">
                                    @switch($book->language)
                                        @case('fr')
                                            🇫🇷 Français
                                            @break
                                        @case('en')
                                            🇬🇧 Anglais
                                            @break
                                        @case('ar')
                                            🇸🇦 Arabe
                                            @break
                                        @default
                                            {{ $book->language }}
                                    @endswitch
                                </p>
                            </div>
                            
                            @if($book->audience)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Public cible</label>
                                    <p class="text-gray-900">
                                        @if($book->audience === 'enfants')
                                            👶 Enfants
                                        @else
                                            👨‍👩‍👧‍👦 Adultes
                                        @endif
                                    </p>
                                </div>
                            @endif
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date de création</label>
                                <p class="text-gray-900">{{ $book->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Description</h3>
                        @if($book->summary)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Résumé</label>
                                <p class="text-gray-900 italic">{{ $book->summary }}</p>
                            </div>
                        @endif
                        
                        @if($book->description)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description complète</label>
                                <div class="text-gray-900 prose max-w-none">
                                    {!! nl2br(e($book->description)) !!}
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 italic">Aucune description disponible</p>
                        @endif
                    </div>
                </div>

                <!-- Back to List -->
                <div class="mt-8 text-center">
                    <a href="{{ route('admin.books.index') }}" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        ← Retour à la liste des livres
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html> 