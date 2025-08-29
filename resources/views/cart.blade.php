@extends('layouts.app')

@section('title', 'Panier - Bayt Al-Kitab')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Mon Panier</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="p-6 border-b">
                            <h2 class="text-xl font-semibold">Articles ({{ count($cartItems) }})</h2>
                        </div>
                        
                        <div class="divide-y">
                            @foreach($cartItems as $item)
                                <div class="p-6">
                                    <div class="flex items-center space-x-4">
                                        <!-- Book Image -->
                                        <div class="flex-shrink-0">
                                            @if($item['book']->images && count($item['book']->images) > 0)
                                                <img src="{{ asset('storage/' . $item['book']->images[0]) }}" 
                                                     alt="{{ $item['book']->title }}" 
                                                     class="w-20 h-20 object-cover rounded">
                                            @else
                                                <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                                    <span class="text-2xl text-gray-400">📚</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Book Info -->
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-800">{{ $item['book']->title }}</h3>
                                            @if($item['book']->author)
                                                <p class="text-sm text-gray-600">{{ $item['book']->author }}</p>
                                            @endif
                                            <div class="flex items-center space-x-2 mt-2">
                                                @if($item['book']->is_on_sale && $item['book']->sale_price)
                                                    <span class="font-semibold text-red-600">{{ number_format($item['price'], 2) }}€</span>
                                                    <span class="text-sm text-gray-500 line-through">{{ number_format($item['book']->price, 2) }}€</span>
                                                @else
                                                    <span class="font-semibold text-gray-800">{{ number_format($item['price'], 2) }}€</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Quantity -->
                                        <div class="flex items-center space-x-2">
                                            <div class="flex items-center border border-gray-300 rounded">
                                                <button type="button" onclick="updateQuantity({{ $item['book']->id }}, -1)" 
                                                        class="px-3 py-1 text-gray-600 hover:bg-gray-100">-</button>
                                                <input type="number" value="{{ $item['quantity'] }}" min="0" max="{{ $item['book']->stock }}"
                                                       class="w-12 text-center border-0 focus:ring-0" id="qty-{{ $item['book']->id }}" readonly>
                                                <button type="button" onclick="updateQuantity({{ $item['book']->id }}, 1)" 
                                                        class="px-3 py-1 text-gray-600 hover:bg-gray-100">+</button>
                                            </div>
                                        </div>

                                        <!-- Subtotal -->
                                        <div class="text-right">
                                            <p class="font-semibold text-gray-800">{{ number_format($item['subtotal'], 2) }}€</p>
                                        </div>

                                        <!-- Remove -->
                                        <form method="POST" action="{{ route('cart.remove', $item['book']) }}" class="flex-shrink-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                        <h2 class="text-xl font-semibold mb-4">Résumé de la commande</h2>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sous-total</span>
                                <span class="font-semibold">{{ number_format($total, 2) }}€</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Livraison</span>
                                <span class="text-gray-600">À calculer</span>
                            </div>
                            <hr>
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span>{{ number_format($total, 2) }}€</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <a href="{{ route('shop') }}" 
                               class="block w-full text-center bg-gray-200 text-gray-700 py-3 px-4 rounded-lg font-semibold hover:bg-gray-300 transition">
                                Continuer mes achats
                            </a>
                            <button class="w-full bg-islamic-green text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-700 transition">
                                Passer la commande
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clear Cart -->
            <div class="mt-8 text-center">
                <form method="POST" action="{{ route('cart.clear') }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition"
                            onclick="return confirm('Êtes-vous sûr de vouloir vider votre panier ?')">
                        Vider le panier
                    </button>
                </form>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🛒</div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Votre panier est vide</h2>
                <p class="text-gray-600 mb-8">Découvrez notre sélection de livres islamiques</p>
                <a href="{{ route('shop') }}" 
                   class="inline-flex items-center px-6 py-3 bg-islamic-green text-white rounded-lg font-semibold hover:bg-green-700 transition">
                    Parcourir les livres
                </a>
            </div>
        @endif
    </div>

    <script>
        function updateQuantity(bookId, change) {
            const input = document.getElementById('qty-' + bookId);
            let newQuantity = parseInt(input.value) + change;
            
            if (newQuantity < 0) newQuantity = 0;
            
            // Récupérer le token CSRF
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Envoyer la mise à jour via AJAX
            fetch('{{ route("cart.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    book_id: bookId,
                    quantity: newQuantity
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur réseau');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    input.value = newQuantity;
                    // Recharger la page pour mettre à jour les totaux
                    location.reload();
                } else {
                    alert(data.message || 'Erreur lors de la mise à jour');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de la mise à jour du panier');
            });
        }
    </script>
@endsection 