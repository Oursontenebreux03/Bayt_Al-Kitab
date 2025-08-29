<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
    <div class="relative">
        @if($book->images && count($book->images) > 0)
            <img src="{{ asset('storage/' . $book->images[0]) }}" 
                 alt="{{ $book->title }}" 
                 class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-4xl text-gray-400">📚</span>
            </div>
        @endif
        
        <!-- Status badges -->
        <div class="absolute top-2 left-2 flex flex-col gap-1">
            @if($book->is_new)
                <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Nouveau</span>
            @endif
            @if($book->is_popular)
                <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded">Populaire</span>
            @endif
            @if($book->is_on_sale)
                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">Promo</span>
            @endif
        </div>
        
        <!-- Stock indicator -->
        @if($book->stock <= 0)
            <div class="absolute top-2 right-2">
                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">Rupture</span>
            </div>
        @endif
    </div>
    
    <div class="p-4">
        <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $book->title }}</h3>
        
        @if($book->author)
            <p class="text-sm text-gray-600 mb-2">{{ $book->author }}</p>
        @endif
        
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center space-x-2">
                @if($book->is_on_sale && $book->sale_price)
                    <span class="text-lg font-bold text-red-600">{{ number_format($book->sale_price, 2) }}€</span>
                    <span class="text-sm text-gray-500 line-through">{{ number_format($book->price, 2) }}€</span>
                @else
                    <span class="text-lg font-bold text-gray-800">{{ number_format($book->price, 2) }}€</span>
                @endif
            </div>
            
            @if($book->stock > 0)
                <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded">En stock</span>
            @else
                <span class="text-xs text-red-600 bg-red-100 px-2 py-1 rounded">Rupture</span>
            @endif
        </div>
        
        <div class="flex space-x-2">
            <a href="{{ route('book', $book) }}" 
               class="flex-1 bg-islamic-green text-white text-center py-2 px-3 rounded text-sm hover:bg-green-700 transition">
                Voir détails
            </a>
            @if($book->stock > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" 
                            class="w-full bg-gray-800 text-white py-2 px-3 rounded text-sm hover:bg-gray-700 transition">
                        🛒 Ajouter
                    </button>
                </form>
            @endif
        </div>
    </div>
</div> 