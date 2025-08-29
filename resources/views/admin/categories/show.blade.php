<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - Administration Bayt Al-Kitab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-green-600 text-white shadow">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Détail de la Catégorie</h1>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.categories.index') }}" class="bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded">← Retour à la liste</a>
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
                    <h2 class="text-3xl font-bold text-gray-800">{{ $category->name }}</h2>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.categories.edit', $category) }}" 
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                            ✏️ Modifier
                        </a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                🗑️ Supprimer
                            </button>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Category Information -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Informations de la catégorie</h3>
                        
                        <div class="space-y-4">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nom</label>
                                <p class="text-lg font-semibold text-gray-900">{{ $category->name }}</p>
                            </div>

                            <!-- Icon -->
                            @if($category->icon)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Icône</label>
                                    <p class="text-2xl">{{ $category->icon }}</p>
                                </div>
                            @endif

                            <!-- Description -->
                            @if($category->description)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                    <p class="text-gray-900">{{ $category->description }}</p>
                                </div>
                            @endif

                            <!-- Parent Category -->
                            @if($category->parent)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Catégorie parente</label>
                                    <p class="text-gray-900">{{ $category->parent->name }}</p>
                                </div>
                            @else
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Type</label>
                                    <p class="text-gray-900">Catégorie principale</p>
                                </div>
                            @endif

                            <!-- Display Order -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ordre d'affichage</label>
                                <p class="text-gray-900">{{ $category->display_order }}</p>
                            </div>

                            <!-- Created Date -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date de création</label>
                                <p class="text-gray-900">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Statistiques</h3>
                        
                        <div class="space-y-4">
                            <!-- Subcategories -->
                            <div class="flex justify-between items-center p-4 bg-blue-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Sous-catégories</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $category->children->count() }}</p>
                                </div>
                                <div class="text-3xl">📁</div>
                            </div>

                            <!-- Books -->
                            <div class="flex justify-between items-center p-4 bg-green-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Livres</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $category->books->count() }}</p>
                                </div>
                                <div class="text-3xl">📚</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subcategories -->
                @if($category->children->count() > 0)
                    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Sous-catégories</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($category->children as $child)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $child->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $child->books->count() }} livre(s)</p>
                                        </div>
                                        <a href="{{ route('admin.categories.show', $child) }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm">Voir →</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Books in this category -->
                @if($category->books->count() > 0)
                    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Livres dans cette catégorie</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Livre</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Auteur</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($category->books as $book)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        @if($book->images && count($book->images) > 0)
                                                            <img src="{{ asset('storage/' . $book->images[0]) }}" 
                                                                 alt="{{ $book->title }}" class="h-10 w-10 object-cover rounded">
                                                        @else
                                                            <div class="h-10 w-10 bg-gray-200 rounded flex items-center justify-center">
                                                                <span class="text-gray-400">📚</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $book->title }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $book->author ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($book->is_on_sale && $book->sale_price)
                                                    <span class="text-red-600 font-semibold">{{ number_format($book->sale_price, 2) }}€</span>
                                                    <span class="text-gray-500 line-through text-xs">{{ number_format($book->price, 2) }}€</span>
                                                @else
                                                    <span class="font-semibold">{{ number_format($book->price, 2) }}€</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $book->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $book->stock }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('admin.books.show', $book) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Back to List -->
                <div class="mt-8 text-center">
                    <a href="{{ route('admin.categories.index') }}" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        ← Retour à la liste des catégories
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html> 