#!/bin/bash

echo "🚀 Initialisation de Laravel..."

# Aller dans le répertoire de l'application
cd /var/www

# Installer les dépendances Composer
echo "📦 Installation des dépendances Composer..."
composer install --no-dev --optimize-autoloader

# Créer le fichier .env s'il n'existe pas
if [ ! -f .env ]; then
    echo "⚙️ Création du fichier .env..."
    cp .env.example .env
    php artisan key:generate
fi

# Créer le lien de stockage
echo "🔗 Création du lien de stockage..."
php artisan storage:link

# Exécuter les migrations
echo "🗄️ Exécution des migrations..."
php artisan migrate --force

# Exécuter les seeders
echo "🌱 Exécution des seeders..."
php artisan db:seed --force

# Définir les permissions
echo "🔐 Définition des permissions..."
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo "✅ Laravel initialisé avec succès!"
