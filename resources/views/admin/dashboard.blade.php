<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Bayt Al-Kitab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-green-600 text-white shadow">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Administration Bayt Al-Kitab</h1>
                    <div class="flex items-center space-x-4">
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
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-3xl font-bold mb-4 text-green-600">Tableau de bord</h2>
                <p class="mb-6">Bienvenue dans l'espace d'administration de Bayt Al-Kitab.</p>
                
                <!-- Menu Admin -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-blue-50 p-6 rounded-lg border">
                        <h3 class="text-xl font-semibold mb-2">📚 Livres</h3>
                        <p class="text-gray-600 mb-4">Gérer les livres, ajouter, modifier, supprimer</p>
                        <a href="{{ route('admin.books.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Gérer les livres</a>
                    </div>
                    
                    <div class="bg-green-50 p-6 rounded-lg border">
                        <h3 class="text-xl font-semibold mb-2">📂 Catégories</h3>
                        <p class="text-gray-600 mb-4">Organiser les catégories de livres</p>
                        <a href="{{ route('admin.categories.index') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Gérer les catégories</a>
                    </div>
                    
                    <div class="bg-yellow-50 p-6 rounded-lg border">
                        <h3 class="text-xl font-semibold mb-2">📦 Commandes</h3>
                        <p class="text-gray-600 mb-4">Suivre et gérer les commandes</p>
                        <a href="{{ route('admin.orders.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Voir les commandes</a>
                    </div>
                    
                    <div class="bg-purple-50 p-6 rounded-lg border">
                        <h3 class="text-xl font-semibold mb-2">👥 Utilisateurs</h3>
                        <p class="text-gray-600 mb-4">Gérer les comptes clients et admins</p>
                        <a href="{{ route('admin.users.index') }}" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">Gérer les utilisateurs</a>
                    </div>
                    
                    <div class="bg-red-50 p-6 rounded-lg border">
                        <h3 class="text-xl font-semibold mb-2">📝 Blog</h3>
                        <p class="text-gray-600 mb-4">Rédiger et gérer les articles</p>
                        <div class="space-y-2">
                            <a href="{{ route('admin.blog.posts.index') }}" class="block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 text-center">Gérer les articles</a>
                            <a href="{{ route('admin.blog.categories.index') }}" class="block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-center">Gérer les catégories</a>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg border">
                        <h3 class="text-xl font-semibold mb-2">⚙️ Paramètres</h3>
                        <p class="text-gray-600 mb-4">Configurer le site</p>
                        <a href="{{ route('admin.settings.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Paramètres</a>
                    </div>
                </div>
                
                <div class="mt-8 pt-6 border-t">
                    <a href="/" class="text-green-600 hover:text-green-800 underline">← Retour au site public</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html> 