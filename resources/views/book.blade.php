@extends('layouts.app')

@section('title', $book->title . ' - Bayt Al-Kitab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-600 mb-8">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-islamic-green">Accueil</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('shop') }}" class="hover:text-islamic-green">Boutique</a>
                    @if($book->categories->count() > 0)
                        <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                        </svg>
                        <li class="flex items-center">
                            <a href="{{ route('category', $book->categories->first()) }}" class="hover:text-islamic-green">{{ $book->categories->first()->name }}</a>
                        </li>
                    @endif
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Book Images -->
            <div class="space-y-4">
                @if($book->images && count($book->images) > 0)
                    <div class="aspect-w-3 aspect-h-4 bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $book->images[0]) }}" 
                             alt="{{ $book->title }}" 
                             class="w-full h-full object-cover">
                    </div>
                    
                    @if(count($book->images) > 1)
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($book->images as $image)
                                <div class="aspect-w-1 aspect-h-1 bg-gray-100 rounded overflow-hidden">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                         alt="{{ $book->title }}" 
                                         class="w-full h-full object-cover cursor-pointer hover:opacity-75 transition">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="aspect-w-3 aspect-h-4 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-6xl text-gray-400">📚</span>
                    </div>
                @endif
            </div>

            <!-- Book Details -->
            <div class="space-y-6">
                <!-- Title & Author -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $book->title }}</h1>
                    @if($book->author)
                        <p class="text-lg text-gray-600">par {{ $book->author }}</p>
                    @endif
                </div>

                <!-- Categories -->
                @if($book->categories->count() > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($book->categories as $category)
                            <a href="{{ route('category', $category) }}" 
                               class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-islamic-green text-white hover:bg-green-700 transition">
                                {{ $category->icon ?? '📚' }} {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Price -->
                <div class="flex items-center space-x-4">
                    @if($book->is_on_sale && $book->sale_price)
                        <span class="text-3xl font-bold text-red-600">{{ number_format($book->sale_price, 2) }}€</span>
                        <span class="text-xl text-gray-500 line-through">{{ number_format($book->price, 2) }}€</span>
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm font-semibold">
                            -{{ number_format((($book->price - $book->sale_price) / $book->price) * 100, 0) }}%
                        </span>
                    @else
                        <span class="text-3xl font-bold text-gray-800">{{ number_format($book->price, 2) }}€</span>
                    @endif
                </div>

                <!-- Stock Status -->
                <div class="flex items-center space-x-2">
                    @if($book->stock > 0)
                        <span class="text-green-600 font-semibold">✓ En stock</span>
                        <span class="text-sm text-gray-600">({{ $book->stock }} disponible{{ $book->stock > 1 ? 's' : '' }})</span>
                    @else
                        <span class="text-red-600 font-semibold">✗ Rupture de stock</span>
                    @endif
                </div>

                <!-- Add to Cart -->
                @if($book->stock > 0)
                    <form method="POST" action="{{ route('cart.add') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        
                        <div class="flex items-center space-x-4">
                            <label for="quantity" class="text-sm font-medium text-gray-700">Quantité:</label>
                            <div class="flex items-center border border-gray-300 rounded">
                                <button type="button" onclick="changeQuantity(-1)" 
                                        class="px-3 py-2 text-gray-600 hover:bg-gray-100">-</button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $book->stock }}"
                                       class="w-16 text-center border-0 focus:ring-0">
                                <button type="button" onclick="changeQuantity(1)" 
                                        class="px-3 py-2 text-gray-600 hover:bg-gray-100">+</button>
                            </div>
                        </div>

                        <button type="submit" 
                                class="w-full bg-islamic-green text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition flex items-center justify-center space-x-2">
                            <span>🛒</span>
                            <span>Ajouter au panier</span>
                        </button>
                    </form>
                @else
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p class="text-gray-600 text-center">Ce livre est actuellement en rupture de stock</p>
                    </div>
                @endif

                <!-- Book Information -->
                <div class="border-t pt-6 space-y-4">
                    @if($book->isbn)
                        <div class="flex justify-between">
                            <span class="text-gray-600">ISBN:</span>
                            <span class="font-medium">{{ $book->isbn }}</span>
                        </div>
                    @endif

                    @if($book->language)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Langue:</span>
                            <span class="font-medium">{{ $book->language }}</span>
                        </div>
                    @endif

                    @if($book->pages)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pages:</span>
                            <span class="font-medium">{{ $book->pages }}</span>
                        </div>
                    @endif

                    @if($book->format)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Format:</span>
                            <span class="font-medium">{{ $book->format }}</span>
                        </div>
                    @endif

                    @if($book->publisher)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Éditeur:</span>
                            <span class="font-medium">{{ $book->publisher }}</span>
                        </div>
                    @endif

                    @if($book->publication_date)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date de publication:</span>
                            <span class="font-medium">{{ $book->publication_date->format('d/m/Y') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Description -->
        @if($book->description)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Description</h2>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="prose max-w-none">
                        {!! nl2br(e($book->description)) !!}
                    </div>
                </div>
            </div>
        @endif

        <!-- Summary -->
        @if($book->summary)
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Résumé</h2>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="prose max-w-none">
                        {!! nl2br(e($book->summary)) !!}
                    </div>
                </div>
            </div>
        @endif

        <!-- Similar Books -->
        @if($similarBooks->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Livres similaires</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($similarBooks as $similarBook)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <a href="{{ route('book', $similarBook) }}">
                                @if($similarBook->images && count($similarBook->images) > 0)
                                    <img src="{{ asset('storage/' . $similarBook->images[0]) }}" 
                                         alt="{{ $similarBook->title }}" 
                                         class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-4xl text-gray-400">📚</span>
                                    </div>
                                @endif
                            </a>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">
                                    <a href="{{ route('book', $similarBook) }}" class="hover:text-islamic-green">
                                        {{ $similarBook->title }}
                                    </a>
                                </h3>
                                @if($similarBook->author)
                                    <p class="text-sm text-gray-600 mb-2">{{ $similarBook->author }}</p>
                                @endif
                                <div class="flex justify-between items-center">
                                    @if($similarBook->is_on_sale && $similarBook->sale_price)
                                        <span class="font-semibold text-red-600">{{ number_format($similarBook->sale_price, 2) }}€</span>
                                        <span class="text-sm text-gray-500 line-through">{{ number_format($similarBook->price, 2) }}€</span>
                                    @else
                                        <span class="font-semibold text-gray-800">{{ number_format($similarBook->price, 2) }}€</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    function changeQuantity(change) {
        const input = document.getElementById('quantity');
        const newValue = parseInt(input.value) + change;
        const max = parseInt(input.getAttribute('max'));
        const min = parseInt(input.getAttribute('min'));
        
        if (newValue >= min && newValue <= max) {
            input.value = newValue;
        }
    }
</script>
@endsection 