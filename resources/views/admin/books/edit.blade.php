<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Livre - Administration Bayt Al-Kitab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-green-600 text-white shadow">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Modifier un Livre</h1>
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
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Modifier : {{ $book->title }}</h2>

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.books.update', $book) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre *</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Auteur</label>
                                <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            
                            <div>
                                <label for="publisher" class="block text-sm font-medium text-gray-700 mb-2">Éditeur</label>
                                <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">ISBN</label>
                                <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Prix *</label>
                                <input type="number" name="price" id="price" value="{{ old('price', $book->price) }}" step="0.01" min="0" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stock *</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock', $book->stock) }}" min="0" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            
                            <div>
                                <label for="pages" class="block text-sm font-medium text-gray-700 mb-2">Nombre de pages</label>
                                <input type="number" name="pages" id="pages" value="{{ old('pages', $book->pages) }}" min="1"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            
                            <div>
                                <label for="format" class="block text-sm font-medium text-gray-700 mb-2">Format</label>
                                <input type="text" name="format" id="format" value="{{ old('format', $book->format) }}" placeholder="ex: Broché, 15x21cm"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            
                            <div>
                                <label for="language" class="block text-sm font-medium text-gray-700 mb-2">Langue *</label>
                                <select name="language" id="language" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">Sélectionner une langue</option>
                                    <option value="fr" {{ old('language', $book->language) == 'fr' ? 'selected' : '' }}>Français</option>
                                    <option value="en" {{ old('language', $book->language) == 'en' ? 'selected' : '' }}>Anglais</option>
                                    <option value="ar" {{ old('language', $book->language) == 'ar' ? 'selected' : '' }}>Arabe</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="audience" class="block text-sm font-medium text-gray-700 mb-2">Public cible</label>
                                <select name="audience" id="audience"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">Sélectionner un public</option>
                                    <option value="enfants" {{ old('audience', $book->audience) == 'enfants' ? 'selected' : '' }}>Enfants</option>
                                    <option value="adultes" {{ old('audience', $book->audience) == 'adultes' ? 'selected' : '' }}>Adultes</option>
                                </select>
                            </div>
                        </div>

                        <!-- Current Images -->
                        @if($book->images && count($book->images) > 0)
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Images actuelles</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach($book->images as $index => $image)
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Image {{ $index + 1 }}" class="w-full h-32 object-cover rounded">
                                            <button type="button" onclick="removeExistingImage({{ $index }})" 
                                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">×</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- New Images Upload -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ajouter de nouvelles images</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                <input type="file" name="images[]" id="images" multiple accept="image/*" 
                                       class="hidden" onchange="previewImages(this)">
                                <label for="images" class="cursor-pointer">
                                    <div class="text-gray-600">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-2">Cliquez pour ajouter de nouvelles images</p>
                                        <p class="text-sm text-gray-500">PNG, JPG, JPEG jusqu'à 5MB par image</p>
                                    </div>
                                </label>
                            </div>
                            <div id="image-preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                        </div>

                        <!-- Categories -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catégories</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @forelse($categories as $category)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                               {{ in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                        <span class="ml-2 text-sm text-gray-700">{{ $category->name }}</span>
                                    </label>
                                @empty
                                    <p class="text-gray-500 text-sm">Aucune catégorie disponible</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description', $book->description) }}</textarea>
                        </div>

                        <!-- Summary -->
                        <div class="mb-8">
                            <label for="summary" class="block text-sm font-medium text-gray-700 mb-2">Résumé (max 512 caractères)</label>
                            <textarea name="summary" id="summary" rows="3" maxlength="512"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('summary', $book->summary) }}</textarea>
                            <p class="text-sm text-gray-500 mt-1">Résumé court pour l'affichage en liste</p>
                        </div>

                        <!-- Status Flags -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Statuts</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_new" value="1" {{ old('is_new', $book->is_new) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                    <span class="ml-2 text-sm text-gray-700">Nouveau</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_popular" value="1" {{ old('is_popular', $book->is_popular) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                    <span class="ml-2 text-sm text-gray-700">Populaire</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_on_sale" value="1" {{ old('is_on_sale', $book->is_on_sale) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                    <span class="ml-2 text-sm text-gray-700">En promotion</span>
                                </label>
                            </div>
                        </div>

                        <!-- Sale Price -->
                        <div class="mb-8" id="sale-price-section" style="display: {{ old('is_on_sale', $book->is_on_sale) ? 'block' : 'none' }};">
                            <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-2">Prix de promotion</label>
                            <input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price', $book->sale_price) }}" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('admin.books.index') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Annuler
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Show/hide sale price section
        document.querySelector('input[name="is_on_sale"]').addEventListener('change', function() {
            const saleSection = document.getElementById('sale-price-section');
            saleSection.style.display = this.checked ? 'block' : 'none';
        });

        // Image preview
        function previewImages(input) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            
            if (input.files) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" class="w-full h-32 object-cover rounded">
                            <button type="button" onclick="removeImage(${index})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">×</button>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

        function removeImage(index) {
            document.getElementById('image-preview').innerHTML = '';
            document.getElementById('images').value = '';
        }

        function removeExistingImage(index) {
            // This would need backend implementation to remove specific images
            alert('Fonctionnalité de suppression d\'image à implémenter');
        }
    </script>
</body>
</html> 