@extends('layouts.app')

@section('title', 'Modifier l\'article - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Modifier l'article</h1>
            <a href="{{ route('admin.blog.posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                ← Retour aux articles
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="{{ route('admin.blog.posts.update', $post) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Titre -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre *</label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title', $post->title) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                </div>

                <!-- Extrait -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Extrait</label>
                    <textarea name="excerpt" id="excerpt" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green"
                              placeholder="Résumé court de l'article...">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <!-- Contenu -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Contenu *</label>
                    <textarea name="content" id="content" rows="15" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green"
                              placeholder="Contenu de l'article...">{{ old('content', $post->content) }}</textarea>
                </div>

                <!-- Catégorie -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Catégorie *</label>
                    <select name="category_id" id="category_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Statut -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Statut *</label>
                    <select name="status" id="status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Brouillon</option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Publié</option>
                    </select>
                </div>

                <!-- Date de publication -->
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Date de publication</label>
                    <input type="datetime-local" name="published_at" id="published_at" 
                           value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                    <p class="text-sm text-gray-500 mt-1">Laissez vide pour publier immédiatement</p>
                </div>

                <!-- Image à la une -->
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Image à la une</label>
                    @if($post->featured_image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                 alt="Image actuelle" class="w-32 h-32 object-cover rounded">
                            <p class="text-sm text-gray-500 mt-1">Image actuelle</p>
                        </div>
                    @endif
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                    <p class="text-sm text-gray-500 mt-1">Formats acceptés : JPEG, PNG, JPG, GIF. Taille max : 2MB</p>
                </div>

                <!-- Tags -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <input type="text" name="tags" id="tags" 
                           value="{{ old('tags', $post->tags ? implode(', ', $post->tags) : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green"
                           placeholder="tag1, tag2, tag3">
                    <p class="text-sm text-gray-500 mt-1">Séparez les tags par des virgules</p>
                </div>

                <!-- Meta title -->
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Titre SEO</label>
                    <input type="text" name="meta_title" id="meta_title" 
                           value="{{ old('meta_title', $post->meta_title) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green"
                           placeholder="Titre pour les moteurs de recherche">
                </div>

                <!-- Meta description -->
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Description SEO</label>
                    <textarea name="meta_description" id="meta_description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green"
                              placeholder="Description pour les moteurs de recherche">{{ old('meta_description', $post->meta_description) }}</textarea>
                </div>

                <!-- Article en vedette -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" id="is_featured" 
                           {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}
                           class="text-islamic-green focus:ring-islamic-green">
                    <label for="is_featured" class="ml-2 text-sm text-gray-700">Article en vedette</label>
                </div>

                <!-- Boutons -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('admin.blog.posts.index') }}" 
                       class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="bg-islamic-green text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 