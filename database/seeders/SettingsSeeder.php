<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Paramètres généraux
        Setting::set('site_name', 'Bayt Al-Kitab', 'string', 'general', 'Nom du site');
        Setting::set('site_description', 'Votre librairie islamique en ligne', 'text', 'general', 'Description du site');
        Setting::set('logo', null, 'string', 'general', 'Logo du site');

        // Paramètres de contact
        Setting::set('contact_email', 'contact@bayt-al-kitab.com', 'string', 'contact', 'Email de contact');
        Setting::set('contact_phone', '+33 1 23 45 67 89', 'string', 'contact', 'Téléphone de contact');
        Setting::set('address', '123 Rue de la Paix, 75001 Paris, France', 'text', 'contact', 'Adresse');

        // Paramètres de livraison
        Setting::set('shipping_cost', '5.90', 'number', 'shipping', 'Coût de livraison standard');
        Setting::set('free_shipping_threshold', '50.00', 'number', 'shipping', 'Seuil pour la livraison gratuite');

        // Paramètres SEO
        Setting::set('meta_title', 'Bayt Al-Kitab - Librairie Islamique', 'string', 'seo', 'Titre meta par défaut');
        Setting::set('meta_description', 'Découvrez notre sélection de livres islamiques, Corans, et ouvrages spirituels.', 'text', 'seo', 'Description meta par défaut');
    }
}
