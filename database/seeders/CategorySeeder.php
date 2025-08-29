<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Coran & Tafsir',
                'slug' => 'coran-tafsir',
                'description' => 'Corans bilingues, tafsir, exégèse du Coran',
                'icon' => '📖',
                'display_order' => 1,
            ],
            [
                'name' => 'Apprendre l\'arabe',
                'slug' => 'apprendre-arabe',
                'description' => 'Méthodes d\'apprentissage, calligraphie, livres scolaires',
                'icon' => '📚',
                'display_order' => 2,
            ],
            [
                'name' => 'Science religieuse',
                'slug' => 'science-religieuse',
                'description' => 'Tawhid, Fiqh, Hadith, Sirah',
                'icon' => '🕌',
                'display_order' => 3,
            ],
            [
                'name' => 'Spiritualité & développement',
                'slug' => 'spiritualite-developpement',
                'description' => 'Textes de savants, purification de l\'âme, vie quotidienne',
                'icon' => '💚',
                'display_order' => 4,
            ],
            [
                'name' => 'Jeunesse & Enfants',
                'slug' => 'jeunesse-enfants',
                'description' => 'Livres illustrés, histoires des prophètes, apprentissages ludiques',
                'icon' => '👶',
                'display_order' => 5,
            ],
            [
                'name' => 'Convertis / Débutants',
                'slug' => 'convertis-debutants',
                'description' => 'Petit guide du musulman, croyance de base, Coran traduit',
                'icon' => '🆕',
                'display_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
