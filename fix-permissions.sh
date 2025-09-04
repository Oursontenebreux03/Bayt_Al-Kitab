#!/bin/bash

echo "🔧 Correction des permissions..."

# Entrer dans le conteneur et corriger les permissions
docker exec bayt-al-kitab-app bash -c "
    echo 'Correction des permissions dans le conteneur...'
    chown -R www-data:www-data /var/www/storage
    chmod -R 775 /var/www/storage
    chmod -R 775 /var/www/bootstrap/cache
    chown -R www-data:www-data /var/www/database
    chmod -R 775 /var/www/database
    echo 'Permissions corrigées!'
"

echo "✅ Permissions corrigées!"
echo "🌐 Le site devrait maintenant fonctionner sur http://localhost:8080"
