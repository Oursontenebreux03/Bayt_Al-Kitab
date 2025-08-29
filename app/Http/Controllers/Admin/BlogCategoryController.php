<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
    }

    public function index()
    {
        $categories = BlogCategory::withCount('posts')
                                ->orderBy('display_order', 'asc')
                                ->paginate(15);

        return view('admin.blog.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories',
            'slug' => 'nullable|string|max:255|unique:blog_categories',
            'description' => 'nullable|string|max:500',
            'color' => 'nullable|string|max:7',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        BlogCategory::create($data);

        session()->flash('success', 'Catégorie créée avec succès !');

        return redirect()->route('admin.blog.categories.index');
    }

    public function show(BlogCategory $category)
    {
        $category->load(['posts' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);
        
        return view('admin.blog.categories.show', compact('category'));
    }

    public function edit(BlogCategory $category)
    {
        return view('admin.blog.categories.edit', compact('category'));
    }

    public function update(Request $request, BlogCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:blog_categories,slug,' . $category->id,
            'description' => 'nullable|string|max:500',
            'color' => 'nullable|string|max:7',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $category->update($data);

        session()->flash('success', 'Catégorie mise à jour avec succès !');

        return redirect()->route('admin.blog.categories.index');
    }

    public function destroy(BlogCategory $category)
    {
        // Vérifier s'il y a des articles dans cette catégorie
        if ($category->posts()->count() > 0) {
            session()->flash('error', 'Impossible de supprimer cette catégorie car elle contient des articles.');
            return redirect()->route('admin.blog.categories.index');
        }

        $category->delete();

        session()->flash('success', 'Catégorie supprimée avec succès !');

        return redirect()->route('admin.blog.categories.index');
    }
} 