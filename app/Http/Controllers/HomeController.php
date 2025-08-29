<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les livres pour les différentes sections
        $newBooks = Book::new()->inStock()->with('categories')->take(6)->get();
        $popularBooks = Book::popular()->inStock()->with('categories')->take(6)->get();
        $youthBooks = Book::whereHas('categories', function($query) {
            $query->where('categories.slug', 'jeunesse-enfants');
        })->inStock()->with('categories')->take(6)->get();
        
        // Récupérer les catégories principales
        $mainCategories = Category::root()->ordered()->take(6)->get();
        
        return view('home', compact('newBooks', 'popularBooks', 'youthBooks', 'mainCategories'));
    }

    public function shop(Request $request)
    {
        $query = Book::with('categories')->inStock();
        
        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }
        
        // Tri
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        
        switch ($sort) {
            case 'price':
                $query->orderBy('price', $order);
                break;
            case 'title':
                $query->orderBy('title', $order);
                break;
            case 'created_at':
            default:
                $query->orderBy('created_at', $order);
                break;
        }
        
        $books = $query->paginate(12)->withQueryString();
        
        return view('shop', compact('books'));
    }

    public function book(Book $book)
    {
        $book->load('categories', 'reviews');
        
        // Livres similaires
        $similarBooks = Book::whereHas('categories', function($query) use ($book) {
            $query->whereIn('categories.id', $book->categories->pluck('id'));
        })
        ->where('books.id', '!=', $book->id)
        ->inStock()
        ->take(4)
        ->get();
        
        return view('book', compact('book', 'similarBooks'));
    }

    public function category(Category $category, Request $request)
    {
        $query = $category->books()->with('categories')->inStock();
        
        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Filtres
        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }
        
        if ($request->filled('audience')) {
            $query->where('audience', $request->audience);
        }
        
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'new':
                    $query->new();
                    break;
                case 'popular':
                    $query->popular();
                    break;
                case 'sale':
                    $query->onSale();
                    break;
            }
        }
        
        $books = $query->paginate(12)->withQueryString();
        $subcategories = $category->children()->ordered()->get();
        
        return view('category', compact('category', 'books', 'subcategories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function delivery()
    {
        return view('delivery');
    }

    public function faq()
    {
        return view('faq');
    }

    public function beginners()
    {
        // Récupérer les livres pour débutants
        $beginnerBooks = Book::whereHas('categories', function($query) {
            $query->where('categories.slug', 'convertis-debutants');
        })->inStock()->with('categories')->get();

        // Récupérer les Corans bilingues
        $bilingualQurans = Book::whereHas('categories', function($query) {
            $query->where('categories.slug', 'coran-tafsir');
        })->where('books.language', 'ar')->inStock()->with('categories')->get();

        return view('beginners', compact('beginnerBooks', 'bilingualQurans'));
    }
} 