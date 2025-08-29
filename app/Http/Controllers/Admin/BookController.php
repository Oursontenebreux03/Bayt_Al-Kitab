<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
        
        $books = Book::with('categories')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
        
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'summary' => 'nullable|string|max:512',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'pages' => 'nullable|integer|min:1',
            'format' => 'nullable|string|max:100',
            'isbn' => 'nullable|string|max:20',
            'language' => 'required|string|in:fr,en,ar',
            'audience' => 'nullable|string|in:enfants,adultes',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'is_new' => 'boolean',
            'is_popular' => 'boolean',
            'is_on_sale' => 'boolean',
            'sale_price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
        ]);

        $data = $request->except(['categories', 'images']);
        
        // Handle boolean fields
        $data['is_new'] = $request->has('is_new');
        $data['is_popular'] = $request->has('is_popular');
        $data['is_on_sale'] = $request->has('is_on_sale');

        // Handle images upload
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('books', 'public');
                $imagePaths[] = $path;
            }
        }
        $data['images'] = $imagePaths;

        $book = Book::create($data);
        
        if ($request->has('categories')) {
            $book->categories()->attach($request->categories);
        }

        return redirect()->route('admin.books.index')->with('success', 'Livre ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
        
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
        
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'summary' => 'nullable|string|max:512',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'pages' => 'nullable|integer|min:1',
            'format' => 'nullable|string|max:100',
            'isbn' => 'nullable|string|max:20',
            'language' => 'required|string|in:fr,en,ar',
            'audience' => 'nullable|string|in:enfants,adultes',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'is_new' => 'boolean',
            'is_popular' => 'boolean',
            'is_on_sale' => 'boolean',
            'sale_price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
        ]);

        $data = $request->except(['categories', 'images']);
        
        // Handle boolean fields
        $data['is_new'] = $request->has('is_new');
        $data['is_popular'] = $request->has('is_popular');
        $data['is_on_sale'] = $request->has('is_on_sale');

        // Handle images upload
        if ($request->hasFile('images')) {
            $imagePaths = $book->images ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('books', 'public');
                $imagePaths[] = $path;
            }
            $data['images'] = $imagePaths;
        }

        $book->update($data);
        
        if ($request->has('categories')) {
            $book->categories()->sync($request->categories);
        } else {
            $book->categories()->detach();
        }

        return redirect()->route('admin.books.index')->with('success', 'Livre modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
        
        $book->categories()->detach();
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Livre supprimé avec succès !');
    }
}
