# 🐳 Bayt Al-Kitab - Guide Docker

## 📋 Prérequis

- Docker Desktop installé sur votre machine
- Git (pour cloner le projet)

## 🚀 Démarrage rapide

### 1. Cloner le projet
```bash
git clone [URL_DU_REPO]
cd Bayt-Al-Kitab
```

### 2. Lancer l'application
```bash
docker-compose up -d
```

### 3. Accéder à l'application
- **Site public** : http://localhost:8080
- **Administration** : http://localhost:8080/admin
  - Email : `admin@bayt.com`
  - Mot de passe : `admin1234`

## 🛠️ Commandes utiles

### Voir les logs
```bash
docker-compose logs -f
```

### Arrêter l'application
```bash
docker-compose down
```

### Redémarrer l'application
```bash
docker-compose restart
```

### Reconstruire l'application (après modifications)
```bash
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

## 📁 Structure du projet

```
Bayt-Al-Kitab/
├── docker/
│   ├── nginx/
│   │   ├── nginx.conf
│   │   └── default.conf
│   ├── php/
│   │   └── local.ini
│   └── start.sh
├── docker-compose.yml
├── Dockerfile
└── .dockerignore
```

## 🔧 Configuration

### Ports
- **8080** : Port d'accès à l'application

### Services
- **nginx** : Serveur web
- **app** : Application PHP-FPM
- **db** : Base de données SQLite

## 🐛 Dépannage

### Problème de permissions
```bash
docker-compose exec app chown -R www-data:www-data /var/www/storage
```

### Base de données corrompue
```bash
docker-compose down
rm database/database.sqlite
docker-compose up -d
```

### Logs d'erreur
```bash
docker-compose logs app
docker-compose logs nginx
```

## 📝 Fonctionnalités disponibles

### Site public
- ✅ Page d'accueil avec présentation
- ✅ Catalogue de livres avec filtres
- ✅ Détails des livres
- ✅ Blog avec articles
- ✅ Panier d'achat
- ✅ Système d'authentification

### Administration
- ✅ Gestion des livres (CRUD)
- ✅ Gestion des catégories
- ✅ Gestion des commandes
- ✅ Gestion des utilisateurs
- ✅ Gestion du blog
- ✅ Paramètres du site

## 🔐 Comptes de test

### Administrateur
- Email : `admin@bayt.com`
- Mot de passe : `admin1234`

### Utilisateur test
- Email : `client@example.com`
- Mot de passe : `password`

## 📞 Support

En cas de problème, vérifiez :
1. Que Docker Desktop est bien démarré
2. Que le port 8080 n'est pas utilisé par une autre application
3. Les logs avec `docker-compose logs`

---

**Bayt Al-Kitab** - Votre librairie islamique en ligne 📚 