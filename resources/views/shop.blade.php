@extends('layouts.app')

@section('title', 'Boutique - Bayt Al-Kitab')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Boutique</h1>
                <p class="text-gray-600">
                    {{ $books->total() }} livre(s) trouvé(s)
                    @if(request('search'))
                        pour "{{ request('search') }}"
                    @endif
                </p>
            </div>
            
            <!-- Sort -->
            <div class="mt-4 sm:mt-0">
                <form method="GET" action="{{ route('shop') }}" class="flex items-center space-x-2">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    
                    <label class="text-sm text-gray-600">Trier par :</label>
                    <select name="sort" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 rounded-md text-sm">
                        <option value="created_at" {{ request('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>Plus récents</option>
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Titre A-Z</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Prix croissant</option>
                    </select>
                    
                    <select name="order" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 rounded-md text-sm">
                        <option value="desc" {{ request('order', 'desc') == 'desc' ? 'selected' : '' }}>Décroissant</option>
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Croissant</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Books Grid -->
        @if($books->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($books as $book)
                    @include('partials.book-card', ['book' => $book])
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $books->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">📚</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun livre trouvé</h3>
                <p class="text-gray-600 mb-6">
                    Aucun livre ne correspond à vos critères de recherche.
                </p>
                <a href="{{ route('shop') }}" 
                   class="bg-islamic-green text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                    Voir tous les livres
                </a>
            </div>
        @endif
    </div>
@endsection 