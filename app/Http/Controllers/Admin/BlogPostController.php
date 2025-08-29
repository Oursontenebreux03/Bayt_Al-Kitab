<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function __construct()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Accès réservé à l\'administration.');
        }
    }

    public function index()
    {
        $posts = BlogPost::with(['author', 'category'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::active()->ordered()->get();
        return view('admin.blog.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $data = $request->all();
        $data['author_id'] = auth()->id();
        $data['is_featured'] = $request->has('is_featured');

        // Si l'article est publié et qu'aucune date n'est fournie, utiliser maintenant
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        // Gestion des tags
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $data['tags'] = $tags;
        }

        // Gestion de l'image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/blog', $imageName);
            $data['featured_image'] = 'blog/' . $imageName;
        }

        BlogPost::create($data);

        session()->flash('success', 'Article créé avec succès !');

        return redirect()->route('admin.blog.posts.index');
    }

    public function show(BlogPost $post)
    {
        $post->load(['author', 'category', 'comments']);
        return view('admin.blog.posts.show', compact('post'));
    }

    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::active()->ordered()->get();
        return view('admin.blog.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');

        // Si l'article est publié et qu'aucune date n'est fournie, utiliser maintenant
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        // Gestion des tags
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $data['tags'] = $tags;
        }

        // Gestion de l'image
        if ($request->hasFile('featured_image')) {
            // Supprimer l'ancienne image
            if ($post->featured_image) {
                Storage::delete('public/' . $post->featured_image);
            }
            
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/blog', $imageName);
            $data['featured_image'] = 'blog/' . $imageName;
        }

        $post->update($data);

        session()->flash('success', 'Article mis à jour avec succès !');

        return redirect()->route('admin.blog.posts.index');
    }

    public function destroy(BlogPost $post)
    {
        // Supprimer l'image
        if ($post->featured_image) {
            Storage::delete('public/' . $post->featured_image);
        }

        $post->delete();

        session()->flash('success', 'Article supprimé avec succès !');

        return redirect()->route('admin.blog.posts.index');
    }
} 