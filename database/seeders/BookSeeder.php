<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $books = [
            [
                'title' => 'Le Coran bilingue',
                'author' => 'Traduction officielle',
                'publisher' => 'Éditions Al-Bouraq',
                'description' => 'Le Coran complet avec traduction française officielle. Édition de qualité avec calligraphie arabe soignée.',
                'summary' => 'Le Coran complet en arabe avec traduction française officielle.',
                'price' => 25.00,
                'stock' => 50,
                'language' => 'ar',
                'audience' => 'adultes',
                'is_new' => true,
                'pages' => 604,
                'format' => 'Relié, 17x24cm',
                'isbn' => '978-2-84161-123-4',
                'category_slug' => 'coran-tafsir'
            ],
            [
                'title' => 'Méthode d\'apprentissage de l\'arabe - Niveau débutant',
                'author' => 'Dr. Ahmed Al-Mansouri',
                'publisher' => 'Institut Al-Madina',
                'description' => 'Méthode complète pour apprendre l\'arabe classique et moderne. Inclut CD audio et exercices pratiques.',
                'summary' => 'Méthode progressive pour débuter l\'apprentissage de l\'arabe.',
                'price' => 35.00,
                'stock' => 30,
                'language' => 'fr',
                'audience' => 'adultes',
                'is_popular' => true,
                'pages' => 280,
                'format' => 'Broché, 21x29cm',
                'isbn' => '978-2-84161-124-1',
                'category_slug' => 'apprendre-arabe'
            ],
            [
                'title' => 'Les histoires des prophètes pour enfants',
                'author' => 'Fatima Al-Zahra',
                'publisher' => 'Éditions Enfants Musulmans',
                'description' => 'Recueil d\'histoires des prophètes adaptées aux enfants avec illustrations colorées et textes simples.',
                'summary' => 'Histoires des prophètes adaptées pour les enfants.',
                'price' => 18.50,
                'stock' => 75,
                'language' => 'fr',
                'audience' => 'enfants',
                'is_on_sale' => true,
                'sale_price' => 15.00,
                'pages' => 120,
                'format' => 'Cartonné, 20x25cm',
                'isbn' => '978-2-84161-125-8',
                'category_slug' => 'jeunesse-enfants'
            ],
            [
                'title' => 'Le petit guide du musulman',
                'author' => 'Cheikh Abdallah Al-Rashid',
                'publisher' => 'Centre Islamique de France',
                'description' => 'Guide pratique pour les nouveaux musulmans et débutants. Couvre les bases de la foi et de la pratique.',
                'summary' => 'Guide essentiel pour les nouveaux musulmans.',
                'price' => 12.00,
                'stock' => 100,
                'language' => 'fr',
                'audience' => 'adultes',
                'is_new' => true,
                'pages' => 96,
                'format' => 'Broché, 14x21cm',
                'isbn' => '978-2-84161-126-5',
                'category_slug' => 'convertis-debutants'
            ],
            [
                'title' => 'Tafsir Al-Muyassar - Exégèse simplifiée',
                'author' => 'Comité de savants',
                'publisher' => 'Éditions Al-Rahman',
                'description' => 'Exégèse simplifiée du Coran en français. Explication claire et accessible des versets.',
                'summary' => 'Exégèse simplifiée et accessible du Coran.',
                'price' => 45.00,
                'stock' => 25,
                'language' => 'fr',
                'audience' => 'adultes',
                'is_popular' => true,
                'pages' => 800,
                'format' => 'Relié, 18x25cm',
                'isbn' => '978-2-84161-127-2',
                'category_slug' => 'coran-tafsir'
            ],
            [
                'title' => 'La purification de l\'âme',
                'author' => 'Ibn Qayyim Al-Jawziyya',
                'publisher' => 'Éditions Al-Hikma',
                'description' => 'Traité classique sur la purification spirituelle et le développement de l\'âme.',
                'summary' => 'Traité classique sur la purification spirituelle.',
                'price' => 22.00,
                'stock' => 40,
                'language' => 'fr',
                'audience' => 'adultes',
                'is_on_sale' => true,
                'sale_price' => 18.00,
                'pages' => 320,
                'format' => 'Broché, 15x22cm',
                'isbn' => '978-2-84161-128-9',
                'category_slug' => 'spiritualite-developpement'
            ]
        ];

        foreach ($books as $bookData) {
            $categorySlug = $bookData['category_slug'];
            unset($bookData['category_slug']);
            
            $book = Book::create($bookData);
            
            // Attacher la catégorie
            $category = $categories->where('slug', $categorySlug)->first();
            if ($category) {
                $book->categories()->attach($category->id);
            }
        }
    }
} 