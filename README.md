# Culturama - Médiathèque MVC

Culturama est une application web de gestion de médiathèque (livres, films, albums) développée en PHP avec une architecture MVC maison.

## Fonctionnalités

- Gestion des livres, films et albums (CRUD)
- Authentification des utilisateurs (inscription, connexion, déconnexion)
- Tri et recherche avancée pour les films
- Upload d’images pour chaque média
- Emprunt et retour de médias (gestion de la disponibilité)
- Interface utilisateur moderne avec Tailwind CSS

## Prérequis

- PHP 8.1 ou supérieur
- MySQL/MariaDB
- Serveur web (Apache, Nginx, ou PHP built-in)

## Installation

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/Okinest/Culturama.git
   cd Culturama
   ```

2. **Configurer la base de données :**
    - Crée une base `media_library` et importe les tables nécessaires (`users`, `books`, `movies`, `albums`...).
    - Les identifiants par défaut sont `root`/`root` (modifiables dans `models/database/Database.php`).

3. **Lancer le serveur :**
   ```bash
   php -S localhost:8000
   ```
4. **Accéder à l'application:**
> [!IMPORTANT] 
> Tu auras besoin de créer un nouvel utilisateur en t'inscrivant sur l'application.
   

## Structure du projet

- `index.php` : Front controller, point d’entrée unique.
- `controllers/` : Contrôleurs pour chaque ressource (Book, Movie, User, etc.).
- `models/` : Modèles métiers (Book, Movie, User, Song, etc.).
- `views/` : Vues HTML/Tailwind pour chaque ressource.
- `config/Autoloader.php` : Chargement automatique des classes.
- `assets/` : Images uploadées et ressources statiques.

## Utilisation

- **Livres** : `/book/library`
- **Films** : `/movie/cinema`
- **Albums** : `/album/playlist`
- **Connexion** : `/user/login`
- **Inscription** : `/user/register`

L’ajout, la modification et la suppression de médias nécessitent d’être connecté.

## Sécurité

- Les mots de passe sont hashés avec Argon2id.
- Validation de la force du mot de passe à l’inscription.
- Protection contre l’injection SQL via PDO et requêtes préparées.

## Auteurs

- Okinest

---
