<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Livres - Administration Bayt Al-Kitab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-green-600 text-white shadow">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Gestion des Livres</h1>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded">← Retour au Dashboard</a>
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
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header Actions -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Liste des Livres</h2>
                <a href="{{ route('admin.books.create') }}" class="bg-green-500 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold">
                    + Ajouter un livre
                </a>
            </div>

            <!-- Books Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Livre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auteur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($books as $book)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12 bg-gray-200 rounded flex items-center justify-center">
                                                @if($book->images && count($book->images) > 0)
                                                    <img src="{{ asset('storage/' . $book->images[0]) }}" alt="{{ $book->title }}" class="h-12 w-12 object-cover rounded">
                                                @else
                                                    <span class="text-gray-500 text-lg">📚</span>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $book->title }}</div>
                                                <div class="text-sm text-gray-500">{{ $book->publisher }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $book->author ?? 'Non spécifié' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($book->is_on_sale && $book->sale_price)
                                            <span class="line-through text-gray-500">{{ number_format($book->price, 2) }}€</span>
                                            <span class="text-red-600 font-semibold">{{ number_format($book->sale_price, 2) }}€</span>
                                        @else
                                            <span class="font-semibold">{{ number_format($book->price, 2) }}€</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $book->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $book->stock }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex space-x-1">
                                            @if($book->is_new)
                                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">Nouveau</span>
                                            @endif
                                            @if($book->is_popular)
                                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">Populaire</span>
                                            @endif
                                            @if($book->is_on_sale)
                                                <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Promo</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.books.show', $book) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                            <a href="{{ route('admin.books.edit', $book) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Aucun livre trouvé. <a href="{{ route('admin.books.create') }}" class="text-green-600 hover:text-green-800">Ajouter le premier livre</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($books->hasPages())
                <div class="mt-6">
                    {{ $books->links() }}
                </div>
            @endif
        </main>
    </div>
</body>
</html> 