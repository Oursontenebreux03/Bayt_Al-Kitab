@extends('layouts.app')

@section('title', $post->title . ' - Blog Bayt Al-Kitab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-islamic-green">Accueil</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('blog.index') }}" class="hover:text-islamic-green">Blog</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-900">{{ $post->title }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Article principal -->
            <div class="lg:col-span-2">
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                             alt="{{ $post->title }}"
                             class="w-full h-64 object-cover">
                    @endif
                    
                    <div class="p-8">
                        <!-- En-tête de l'article -->
                        <header class="mb-6">
                            @if($post->category)
                                <a href="{{ route('blog.category', $post->category) }}" 
                                   class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 hover:bg-green-200 transition">
                                    {{ $post->category->name }}
                                </a>
                            @endif
                            
                            <h1 class="text-3xl font-bold text-gray-900 mt-4 mb-4">{{ $post->title }}</h1>
                            
                            <div class="flex items-center text-gray-600 text-sm">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-islamic-green rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-sm font-semibold">
                                            {{ strtoupper(substr($post->author->name ?? 'A', 0, 1)) }}
                                        </span>
                                    </div>
                                    <span>{{ $post->author->name ?? 'Anonyme' }}</span>
                                </div>
                                <span class="mx-3">•</span>
                                <span>{{ $post->formatted_published_at }}</span>
                                <span class="mx-3">•</span>
                                <span>{{ $post->reading_time }}</span>
                            </div>
                        </header>

                        <!-- Contenu de l'article -->
                        <div class="prose prose-lg max-w-none">
                            {!! $post->content !!}
                        </div>

                        <!-- Tags -->
                        @if($post->tags && count($post->tags) > 0)
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h3 class="text-sm font-medium text-gray-900 mb-3">Tags :</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($post->tags as $tag)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800">
                                            #{{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </article>

                <!-- Commentaires -->
                <div class="bg-white rounded-lg shadow-md p-8 mt-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">💬 Commentaires ({{ $post->comments->count() }})</h3>
                    
                    @if($post->comments->count() > 0)
                        <div class="space-y-6">
                            @foreach($post->comments->where('parent_id', null) as $comment)
                                <div class="border-b border-gray-200 pb-6 last:border-b-0">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-10 h-10 bg-islamic-green rounded-full flex items-center justify-center flex-shrink-0">
                                            <span class="text-white text-sm font-semibold">
                                                {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center mb-2">
                                                <h4 class="font-medium text-gray-900">{{ $comment->author_name }}</h4>
                                                <span class="text-sm text-gray-500 ml-2">{{ $comment->formatted_created_at }}</span>
                                            </div>
                                            <p class="text-gray-700">{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">Aucun commentaire pour le moment. Soyez le premier à commenter !</p>
                    @endif

                    <!-- Formulaire de commentaire -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Ajouter un commentaire</h4>
                        
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('blog.comment', $post) }}" class="space-y-4">
                            @csrf
                            
                            @guest
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                                        <input type="text" name="author_name" id="author_name" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                    </div>
                                    <div>
                                        <label for="author_email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                        <input type="email" name="author_email" id="author_email" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green">
                                    </div>
                                </div>
                            @endguest
                            
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Commentaire *</label>
                                <textarea name="content" id="content" rows="4" required
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-islamic-green"
                                          placeholder="Partagez vos pensées..."></textarea>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="bg-islamic-green text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                                    Publier le commentaire
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Articles récents -->
                @if($recentPosts->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">📰 Articles récents</h3>
                        <div class="space-y-4">
                            @foreach($recentPosts as $recentPost)
                                <div class="border-b border-gray-200 pb-4 last:border-b-0">
                                    <a href="{{ route('blog.show', $recentPost) }}" class="block hover:text-islamic-green transition">
                                        <h4 class="font-medium text-gray-900 mb-2 line-clamp-2">{{ $recentPost->title }}</h4>
                                        <p class="text-sm text-gray-500">{{ $recentPost->formatted_published_at }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Articles similaires -->
                @if($relatedPosts->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">🔗 Articles similaires</h3>
                        <div class="space-y-4">
                            @foreach($relatedPosts as $relatedPost)
                                <div class="border-b border-gray-200 pb-4 last:border-b-0">
                                    <a href="{{ route('blog.show', $relatedPost) }}" class="block hover:text-islamic-green transition">
                                        <h4 class="font-medium text-gray-900 mb-2 line-clamp-2">{{ $relatedPost->title }}</h4>
                                        <p class="text-sm text-gray-500">{{ $relatedPost->formatted_published_at }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
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

.prose {
    color: #374151;
}

.prose h2 {
    color: #111827;
    font-size: 1.5rem;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose p {
    margin-bottom: 1rem;
    line-height: 1.75;
}

.prose ul {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}
</style>
@endsection 