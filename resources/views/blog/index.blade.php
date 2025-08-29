@extends('layouts.app')

@section('title', 'Blog - Bayt Al-Kitab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-islamic-green to-green-700 text-white py-16 mb-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">📝 Notre Blog</h1>
            <p class="text-xl text-green-100">Découvrez nos articles sur l'islam, la spiritualité et la culture musulmane</p>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Recherche -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">🔍 Rechercher</h3>
                <form method="GET" action="{{ route('blog.index') }}" class="space-y-4">
                    <div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Rechercher un article..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                    </div>
                    <button type="submit" class="w-full bg-islamic-green text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Rechercher
                    </button>
                </form>
            </div>

            <!-- Catégories -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">📂 Catégories</h3>
                <div class="space-y-2">
                    <a href="{{ route('blog.index') }}" 
                       class="block px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ !request('category') ? 'bg-islamic-green text-white' : 'text-gray-700' }}">
                        Toutes les catégories
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}" 
                           class="block px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ request('category') === $category->slug ? 'bg-islamic-green text-white' : 'text-gray-700' }}">
                            {{ $category->name }}
                            <span class="text-sm text-gray-500 ml-2">({{ $category->posts_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Articles à la une -->
            @if($featuredPosts->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">⭐ Articles à la une</h3>
                    <div class="space-y-4">
                        @foreach($featuredPosts as $post)
                            <div class="border-b border-gray-200 pb-4 last:border-b-0">
                                <a href="{{ route('blog.show', $post) }}" class="block hover:text-islamic-green transition">
                                    <h4 class="font-medium text-gray-900 mb-2 line-clamp-2">{{ $post->title }}</h4>
                                    <p class="text-sm text-gray-500">{{ $post->formatted_published_at }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Articles principaux -->
        <div class="lg:col-span-3">
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            @if($post->featured_image)
                                <div class="aspect-w-16 aspect-h-9">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                         alt="{{ $post->title }}"
                                         class="w-full h-48 object-cover">
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    @if($post->category)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                    <span class="text-sm text-gray-500 ml-auto">{{ $post->reading_time }}</span>
                                </div>
                                
                                <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                    <a href="{{ route('blog.show', $post) }}" class="hover:text-islamic-green transition">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                
                                @if($post->excerpt)
                                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                                @endif
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-islamic-green rounded-full flex items-center justify-center">
                                            <span class="text-white text-sm font-semibold">
                                                {{ strtoupper(substr($post->author->name ?? 'A', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $post->author->name ?? 'Anonyme' }}</p>
                                            <p class="text-sm text-gray-500">{{ $post->formatted_published_at }}</p>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('blog.show', $post) }}" 
                                       class="text-islamic-green hover:text-green-700 font-medium text-sm">
                                        Lire la suite →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="text-6xl mb-4">📝</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun article trouvé</h3>
                    <p class="text-gray-600 mb-6">
                        @if(request('search'))
                            Aucun article ne correspond à votre recherche "{{ request('search') }}".
                        @elseif(request('category'))
                            Aucun article dans cette catégorie pour le moment.
                        @else
                            Aucun article publié pour le moment.
                        @endif
                    </p>
                    <a href="{{ route('blog.index') }}" 
                       class="bg-islamic-green text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                        Voir tous les articles
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection 