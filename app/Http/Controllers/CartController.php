<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $bookId => $quantity) {
            $book = Book::find($bookId);
            if ($book) {
                $price = $book->is_on_sale && $book->sale_price ? $book->sale_price : $book->price;
                $cartItems[] = [
                    'book' => $book,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $price * $quantity
                ];
                $total += $price * $quantity;
            }
        }

        return view('cart', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $book = Book::findOrFail($request->book_id);
        
        if ($book->stock < $request->quantity) {
            return back()->with('error', 'Stock insuffisant pour ce livre.');
        }

        $cart = session('cart', []);
        $bookId = $request->book_id;
        
        if (isset($cart[$bookId])) {
            $cart[$bookId] += $request->quantity;
        } else {
            $cart[$bookId] = $request->quantity;
        }

        session(['cart' => $cart]);
        session(['cart_count' => array_sum($cart)]);

        return back()->with('success', 'Livre ajouté au panier avec succès.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = session('cart', []);
        $bookId = $request->book_id;

        if ($request->quantity == 0) {
            unset($cart[$bookId]);
        } else {
            $book = Book::findOrFail($bookId);
            if ($book->stock < $request->quantity) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stock insuffisant pour ce livre.'
                    ]);
                }
                return back()->with('error', 'Stock insuffisant pour ce livre.');
            }
            $cart[$bookId] = $request->quantity;
        }

        session(['cart' => $cart]);
        session(['cart_count' => array_sum($cart)]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Panier mis à jour.',
                'cart_count' => array_sum($cart)
            ]);
        }

        return back()->with('success', 'Panier mis à jour.');
    }

    public function remove($bookId)
    {
        $cart = session('cart', []);
        unset($cart[$bookId]);
        session(['cart' => $cart]);
        session(['cart_count' => array_sum($cart)]);

        return back()->with('success', 'Livre retiré du panier.');
    }

    public function clear()
    {
        session()->forget(['cart', 'cart_count']);
        return back()->with('success', 'Panier vidé.');
    }
} 