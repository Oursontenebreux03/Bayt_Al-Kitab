@extends('layouts.app')

@section('title', 'Nouvelle catégorie - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Nouvelle catégorie</h1>
            <a href="{{ route('admin.blog.categories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                ← Retour aux catégories
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
            <form method="POST" action="{{ route('admin.blog.categories.store') }}" class="space-y-6">
                @csrf

                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                    <input type="text" name="name" id="name" 
                           value="{{ old('name') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <input type="text" name="slug" id="slug" 
                           value="{{ old('slug') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green"
                           placeholder="Laissez vide pour générer automatiquement">
                    <p class="text-sm text-gray-500 mt-1">URL-friendly version du nom</p>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green"
                              placeholder="Description de la catégorie...">{{ old('description') }}</textarea>
                </div>

                <!-- Couleur -->
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Couleur</label>
                    <input type="color" name="color" id="color" 
                           value="{{ old('color', '#059669') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                </div>

                <!-- Icône -->
                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icône</label>
                    <input type="text" name="icon" id="icon" 
                           value="{{ old('icon') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green"
                           placeholder="📚">
                    <p class="text-sm text-gray-500 mt-1">Emoji ou icône pour la catégorie</p>
                </div>

                <!-- Ordre d'affichage -->
                <div>
                    <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">Ordre d'affichage</label>
                    <input type="number" name="display_order" id="display_order" 
                           value="{{ old('display_order', 0) }}" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                </div>

                <!-- Active -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" 
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="text-islamic-green focus:ring-islamic-green">
                    <label for="is_active" class="ml-2 text-sm text-gray-700">Catégorie active</label>
                </div>

                <!-- Boutons -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('admin.blog.categories.index') }}" 
                       class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="bg-islamic-green text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                        Créer la catégorie
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 