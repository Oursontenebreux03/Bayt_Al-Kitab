#!/bin/bash

echo "🚀 Initialisation de Laravel..."

# Aller dans le répertoire de l'application
cd /var/www

# Définir les permissions AVANT tout le reste
echo "🔐 Définition des permissions initiales..."
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Installer les dépendances Composer (avec dev pour Faker)
echo "📦 Installation des dépendances Composer..."
composer install --optimize-autoloader

# Créer le fichier .env s'il n'existe pas
if [ ! -f .env ]; then
    echo "⚙️ Création du fichier .env..."
    cp .env.example .env
    php artisan key:generate
fi

# Créer le répertoire de base de données et définir les permissions
echo "🗄️ Configuration de la base de données..."
mkdir -p /var/www/database
touch /var/www/database/database.sqlite
chown -R www-data:www-data /var/www/database
chmod -R 775 /var/www/database

# Créer le lien de stockage
echo "🔗 Création du lien de stockage..."
php artisan storage:link

# Redéfinir les permissions après les opérations
echo "🔐 Redéfinition des permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/database
chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/database

# Exécuter les migrations
echo "🗄️ Exécution des migrations..."
php artisan migrate --force

# Exécuter les seeders
echo "🌱 Exécution des seeders..."
php artisan db:seed --force

# Permissions finales
echo "🔐 Permissions finales..."
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/database

echo "✅ Laravel initialisé avec succès!"
