<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['author', 'category'])
                        ->published()
                        ->orderBy('published_at', 'desc');

        // Filtre par catégorie
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(9)->withQueryString();
        $categories = BlogCategory::active()->ordered()->withCount(['posts' => function($query) {
            $query->published();
        }])->get();
        $featuredPosts = BlogPost::with(['author', 'category'])
                                ->published()
                                ->featured()
                                ->take(3)
                                ->get();

        return view('blog.index', compact('posts', 'categories', 'featuredPosts'));
    }

    public function show(BlogPost $post)
    {
        if (!$post->published_at || $post->published_at->isFuture()) {
            abort(404);
        }

        $post->load(['author', 'category', 'comments.approved.user']);
        
        // Articles similaires
        $relatedPosts = BlogPost::with(['author', 'category'])
                               ->published()
                               ->where('id', '!=', $post->id)
                               ->where('category_id', $post->category_id)
                               ->take(3)
                               ->get();

        // Articles récents
        $recentPosts = BlogPost::with(['author', 'category'])
                              ->published()
                              ->where('id', '!=', $post->id)
                              ->orderBy('published_at', 'desc')
                              ->take(5)
                              ->get();

        return view('blog.show', compact('post', 'relatedPosts', 'recentPosts'));
    }

    public function category(BlogCategory $category)
    {
        $posts = $category->posts()
                         ->with(['author', 'category'])
                         ->published()
                         ->orderBy('published_at', 'desc')
                         ->paginate(9);

        $categories = BlogCategory::active()->ordered()->withCount(['posts' => function($query) {
            $query->published();
        }])->get();

        return view('blog.category', compact('category', 'posts', 'categories'));
    }

    public function comment(Request $request, BlogPost $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:blog_comments,id',
        ]);

        $comment = new BlogComment([
            'content' => $request->content,
            'parent_id' => $request->parent_id,
            'is_approved' => auth()->check(), // Auto-approuvé si connecté
        ]);

        if (auth()->check()) {
            $comment->user_id = auth()->id();
        } else {
            $request->validate([
                'author_name' => 'required|string|max:255',
                'author_email' => 'required|email|max:255',
            ]);
            $comment->author_name = $request->author_name;
            $comment->author_email = $request->author_email;
        }

        $post->comments()->save($comment);

        session()->flash('success', 'Commentaire ajouté avec succès !');

        return redirect()->route('blog.show', $post);
    }
} 