<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/boutique', [HomeController::class, 'shop'])->name('shop');
Route::get('/livre/{book}', [HomeController::class, 'book'])->name('book');
Route::get('/categorie/{category}', [HomeController::class, 'category'])->name('category');
Route::get('/debutants', [HomeController::class, 'beginners'])->name('beginners');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/livraison', [HomeController::class, 'delivery'])->name('delivery');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

// Routes du blog
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/categorie/{category:slug}', [\App\Http\Controllers\BlogController::class, 'category'])->name('blog.category');
Route::post('/blog/{post:slug}/comment', [\App\Http\Controllers\BlogController::class, 'comment'])->name('blog.comment');

// Routes du panier
Route::get('/panier', [CartController::class, 'index'])->name('cart');
Route::post('/panier/ajouter', [CartController::class, 'add'])->name('cart.add');
Route::post('/panier/modifier', [CartController::class, 'update'])->name('cart.update');
Route::delete('/panier/supprimer/{book}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');

// Routes d'authentification (Laravel Breeze)
require __DIR__.'/auth.php';

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    // Routes de profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routes d'administration (avec vérification admin dans les contrôleurs)
    Route::prefix('admin')->name('admin.')->group(function () {
        // Redirection de /admin vers /admin/dashboard
        Route::get('/', function () {
            if (!auth()->user()->is_admin) {
                abort(403, 'Accès réservé à l\'administration.');
            }
            return redirect()->route('admin.dashboard');
        });
        
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Gestion des livres
        Route::resource('books', BookController::class);
        
        // Gestion des catégories
        Route::resource('categories', CategoryController::class);
        
        // Gestion des commandes
        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{id}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
        
        // Gestion des utilisateurs
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        
        // Paramètres du site
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
        
        // Gestion du blog
        Route::resource('blog/posts', \App\Http\Controllers\Admin\BlogPostController::class)->names([
            'index' => 'blog.posts.index',
            'create' => 'blog.posts.create',
            'store' => 'blog.posts.store',
            'show' => 'blog.posts.show',
            'edit' => 'blog.posts.edit',
            'update' => 'blog.posts.update',
            'destroy' => 'blog.posts.destroy',
        ]);
        Route::resource('blog/categories', \App\Http\Controllers\Admin\BlogCategoryController::class)->names([
            'index' => 'blog.categories.index',
            'create' => 'blog.categories.create',
            'store' => 'blog.categories.store',
            'show' => 'blog.categories.show',
            'edit' => 'blog.categories.edit',
            'update' => 'blog.categories.update',
            'destroy' => 'blog.categories.destroy',
        ]);
    });
});
