<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les catégories de blog
        $categories = [
            [
                'name' => 'Spiritualité',
                'slug' => 'spiritualite',
                'description' => 'Articles sur la spiritualité islamique et le développement personnel',
                'color' => '#059669',
                'icon' => '🕌',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Éducation',
                'slug' => 'education',
                'description' => 'Conseils et ressources pour l\'éducation islamique',
                'color' => '#2563eb',
                'icon' => '📚',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Culture',
                'slug' => 'culture',
                'description' => 'Culture et traditions musulmanes',
                'color' => '#7c3aed',
                'icon' => '🌍',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Actualités',
                'slug' => 'actualites',
                'description' => 'Actualités du monde musulman',
                'color' => '#dc2626',
                'icon' => '📰',
                'display_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            BlogCategory::create($categoryData);
        }

        // Récupérer l'admin pour être l'auteur
        $admin = User::where('role', 'admin')->first();

        if ($admin) {
            // Créer des articles de test
            $posts = [
                [
                    'title' => 'Les bienfaits de la lecture du Coran',
                    'slug' => 'bienfaits-lecture-coran',
                    'excerpt' => 'Découvrez les nombreux bienfaits spirituels et psychologiques de la lecture quotidienne du Coran.',
                    'content' => '<p>La lecture du Coran est l\'une des plus importantes pratiques spirituelles en islam. Elle apporte de nombreux bienfaits à celui qui s\'y adonne régulièrement.</p>

<h2>Bienfaits spirituels</h2>
<p>La lecture du Coran renforce la foi et rapproche le croyant de son Créateur. Chaque verset lu est une occasion de méditer sur les signes d\'Allah et de renforcer sa relation avec Lui.</p>

<h2>Bienfaits psychologiques</h2>
<p>La récitation du Coran apaise l\'âme et apporte la sérénité. De nombreuses études ont montré les effets positifs de la récitation sur le stress et l\'anxiété.</p>

<h2>Conseils pour une lecture efficace</h2>
<ul>
<li>Choisir un moment calme de la journée</li>
<li>Se concentrer sur le sens des versets</li>
<li>Réciter avec une belle voix</li>
<li>Pratiquer régulièrement</li>
</ul>

<p>N\'oubliez pas que la qualité de la lecture est plus importante que la quantité. Mieux vaut lire peu mais avec concentration et méditation.</p>',
                    'category_id' => 1,
                    'status' => 'published',
                    'published_at' => now()->subDays(5),
                    'is_featured' => true,
                    'tags' => ['Coran', 'Spiritualité', 'Méditation'],
                ],
                [
                    'title' => 'Comment choisir ses premiers livres islamiques',
                    'slug' => 'choisir-premiers-livres-islamiques',
                    'excerpt' => 'Guide pratique pour les débutants qui souhaitent constituer leur bibliothèque islamique.',
                    'content' => '<p>Constituer une bibliothèque islamique peut sembler intimidant pour les débutants. Voici quelques conseils pour bien choisir vos premiers livres.</p>

<h2>Par où commencer ?</h2>
<p>Pour les débutants, il est recommandé de commencer par des livres de base qui expliquent les fondements de l\'islam de manière claire et accessible.</p>

<h2>Les livres essentiels</h2>
<ul>
<li>Un Coran avec traduction française</li>
<li>Un livre sur les piliers de l\'islam</li>
<li>Une biographie du Prophète Muhammad (ﷺ)</li>
<li>Un livre sur la purification de l\'âme</li>
</ul>

<h2>Critères de sélection</h2>
<p>Privilégiez les livres écrits par des savants reconnus et publiés par des maisons d\'édition sérieuses. Vérifiez également que le contenu est adapté à votre niveau de connaissances.</p>

<p>N\'hésitez pas à demander conseil à votre libraire ou à des personnes plus expérimentées.</p>',
                    'category_id' => 2,
                    'status' => 'published',
                    'published_at' => now()->subDays(3),
                    'is_featured' => true,
                    'tags' => ['Débutants', 'Bibliothèque', 'Éducation'],
                ],
                [
                    'title' => 'L\'importance de la famille en islam',
                    'slug' => 'importance-famille-islam',
                    'excerpt' => 'L\'islam accorde une place centrale à la famille. Découvrez les valeurs et principes qui la régissent.',
                    'content' => '<p>La famille est le pilier de la société en islam. Elle constitue le premier lieu d\'éducation et de transmission des valeurs.</p>

<h2>Les droits et devoirs familiaux</h2>
<p>L\'islam définit clairement les droits et devoirs de chaque membre de la famille, créant ainsi un équilibre harmonieux.</p>

<h2>L\'éducation des enfants</h2>
<p>Les parents ont la responsabilité d\'éduquer leurs enfants dans les valeurs islamiques tout en leur permettant de s\'épanouir.</p>

<h2>Le respect des aînés</h2>
<p>L\'islam insiste sur l\'importance du respect envers les parents et les aînés, considérés comme une source de sagesse.</p>

<p>Une famille unie et respectueuse des valeurs islamiques contribue à créer une société équilibrée et harmonieuse.</p>',
                    'category_id' => 3,
                    'status' => 'published',
                    'published_at' => now()->subDays(1),
                    'is_featured' => false,
                    'tags' => ['Famille', 'Valeurs', 'Société'],
                ],
            ];

            foreach ($posts as $postData) {
                $postData['author_id'] = $admin->id;
                BlogPost::create($postData);
            }
        }
    }
}
