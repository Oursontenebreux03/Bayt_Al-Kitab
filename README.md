# Bayt Al-Kitab - Librairie Islamique

Une librairie islamique en ligne complète développée avec Laravel, offrant une interface publique pour les clients et un panneau d'administration pour la gestion.

## 🚀 Fonctionnalités

### Site Public
- **Page d'accueil** : Présentation attractive avec sections nouveautés, meilleures ventes, et livres jeunesse
- **Boutique** : Catalogue complet avec recherche et tri
- **Pages produits** : Fiches détaillées avec images multiples, descriptions, et extraits PDF
- **Panier d'achat** : Gestion complète avec AJAX pour les mises à jour
- **Pages informatives** : À propos, Contact, Livraison, FAQ
- **Blog** : Articles et conseils pour améliorer le SEO
- **Page débutants** : Sélection spéciale pour les nouveaux lecteurs

### Panneau d'Administration
- **Tableau de bord** : Vue d'ensemble des statistiques
- **Gestion des livres** : CRUD complet avec upload d'images et PDF
- **Gestion des catégories** : Organisation hiérarchique des livres
- **Gestion des commandes** : Suivi des statuts et détails clients
- **Gestion des utilisateurs** : Administration des comptes clients
- **Paramètres du site** : Configuration générale, contact, livraison
- **Blog** : Gestion des articles et catégories

## 🛠️ Technologies Utilisées

- **Backend** : Laravel 12
- **Base de données** : SQLite (développement)
- **Frontend** : Blade templates avec Tailwind CSS
- **Authentification** : Laravel Breeze
- **Upload de fichiers** : Laravel Storage
- **Paiements** : Stripe (prévu)

## 📋 Prérequis

- PHP 8.1+
- Composer
- SQLite (ou MySQL/PostgreSQL pour la production)

## 🚀 Installation

1. **Cloner le projet**
   ```bash
   git clone [url-du-repo]
   cd Bayt-Al-Kitab
   ```

2. **Installer les dépendances**
   ```bash
   composer install
   ```

3. **Configuration de l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configuration de la base de données**
   ```bash
   # Dans .env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

5. **Créer la base de données SQLite**
   ```bash
   touch database/database.sqlite
   ```

6. **Exécuter les migrations et seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Créer le lien de stockage**
   ```bash
   php artisan storage:link
   ```

8. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```

## 👤 Comptes par défaut

### Administrateur
- **Email** : `admin@bayt.com`
- **Mot de passe** : `admin1234`

### Utilisateurs de test
- **Email** : `client@example.com`
- **Mot de passe** : `password`

## 📁 Structure du Projet

```
app/
├── Http/Controllers/
│   ├── Admin/           # Contrôleurs d'administration
│   ├── HomeController   # Pages publiques
│   ├── CartController   # Gestion du panier
│   └── BlogController   # Blog public
├── Models/              # Modèles Eloquent
└── Http/Middleware/     # Middleware personnalisé

resources/views/
├── admin/              # Vues d'administration
├── layouts/            # Layouts principaux
├── partials/           # Composants réutilisables
└── blog/               # Vues du blog

database/
├── migrations/         # Migrations de base de données
└── seeders/           # Seeders pour les données de test
```

## 🎨 Thème et Design

Le site utilise une charte graphique inspirée de l'islam avec :
- **Couleur principale** : Vert islamique (#15803d)
- **Design** : Moderne et responsive
- **Logo** : Personnalisable via le panneau d'administration

## 🔧 Configuration

### Paramètres du site
Tous les paramètres sont configurables via le panneau d'administration :
- Nom et description du site
- Informations de contact
- Coûts de livraison
- Méthodes de paiement
- Logo du site

### Gestion des fichiers
- **Images** : Stockées dans `storage/app/public/images/`
- **PDF** : Stockés dans `storage/app/public/pdfs/`
- **Logo** : Configurable via les paramètres

## 📊 Fonctionnalités Avancées

### Système de commandes
- Numérotation automatique des commandes
- Suivi des statuts (En attente, En cours, Expédiée, Livrée, Annulée)
- Gestion des adresses de livraison
- Calcul automatique des frais de port

### Gestion des utilisateurs
- Rôles (admin/user)
- Profils complets avec adresses
- Historique des commandes
- Protection contre l'auto-suppression

### Blog intégré
- Articles avec catégories
- Système de commentaires
- SEO optimisé
- Images d'illustration

## 🚀 Déploiement

### Production
1. Configurer une base de données MySQL/PostgreSQL
2. Optimiser les performances :
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
3. Configurer les variables d'environnement de production
4. Configurer un serveur web (Apache/Nginx)

### Sécurité
- Authentification Laravel Breeze
- Protection CSRF sur tous les formulaires
- Validation des données
- Middleware d'autorisation admin

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 📞 Support

Pour toute question ou problème :
- Email : contact@bayt-al-kitab.com
- Issues GitHub : [Lien vers les issues]

---

**Bayt Al-Kitab** - La connaissance au service du cœur ❤️
