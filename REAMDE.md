# 🎮 Memory Game - Jeu de mémoire en PHP

Un jeu de Memory (jeu de paires) développé en PHP avec architecture MVC, incluant un système d'authentification et un classement des meilleurs scores.

---

## 📋 Table des matières

- [Présentation](#-présentation)
- [Fonctionnalités](#-fonctionnalités)
- [Technologies utilisées](#-technologies-utilisées)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Configuration](#️-configuration)
- [Structure du projet](#-structure-du-projet)
- [Utilisation](#-utilisation)
- [Base de données](#-base-de-données)
- [Sécurité](#-sécurité)
- [Captures d'écran](#-captures-décran)
- [Auteur](#-auteur)

---

## 🎯 Présentation

Memory Game est une application web de jeu de mémoire où les joueurs doivent retrouver des paires de cartes identiques. Le jeu enregistre les performances (temps et nombre de paires) et affiche un classement des meilleurs scores.

### Objectif du jeu
- Retourner les cartes deux par deux
- Mémoriser leur emplacement
- Trouver toutes les paires le plus rapidement possible

---

## ✨ Fonctionnalités

### 🎲 Jeu
- ✅ Plusieurs niveaux de difficulté (3 à 12 paires)
- ✅ Génération aléatoire des cartes avec images Picsum
- ✅ Détection automatique des paires trouvées
- ✅ Chronomètre de partie
- ✅ Animation de retournement des cartes
- ✅ Interface responsive (mobile, tablette, desktop)

### 👤 Authentification
- ✅ Inscription utilisateur avec validation
- ✅ Connexion sécurisée (hashage bcrypt)
- ✅ Gestion des sessions
- ✅ Déconnexion

### 🏆 Classement
- ✅ Enregistrement automatique des scores
- ✅ Affichage du top 10 des meilleurs temps
- ✅ Tri par temps (croissant) et nombre de paires (décroissant)
- ✅ Affichage du pseudo du joueur

### 🔒 Sécurité
- ✅ Protection CSRF (tokens)
- ✅ Protection XSS (échappement HTML)
- ✅ Protection SQL Injection (requêtes préparées)
- ✅ Validation des données côté serveur
- ✅ Hashage des mots de passe (bcrypt)

---

## 🛠 Technologies utilisées

### Backend
- **PHP 8.1+** - Langage serveur
- **MySQL 8.0+** - Base de données
- **Composer** - Gestionnaire de dépendances
- **PDO** - Accès à la base de données

### Frontend
- **HTML5** - Structure
- **CSS3** - Style (Grid, Flexbox, animations)
- **JavaScript** - Interactivité (minimal)

### Architecture
- **MVC** - Modèle-Vue-Contrôleur
- **PSR-4** - Autoloading
- **Pattern Singleton** - Connexion base de données
- **Routing personnalisé** - Gestion des URLs

### Dépendances
- **vlucas/phpdotenv** - Gestion des variables d'environnement
- **Picsum Photos API** - Images aléatoires pour les cartes

---

## 📦 Prérequis

- **PHP** >= 8.1
- **MySQL** >= 8.0
- **Composer** >= 2.0
- **Apache** avec mod_rewrite activé
- **Laragon** / **XAMPP** / **WAMP** (recommandé pour Windows)

---

## 🚀 Installation

### 1. Cloner le projet

```bash
git clone https://github.com/votre-username/memory-game.git
cd memory-game
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer la base de données

Créez une base de données MySQL :

```sql
CREATE DATABASE memory CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Importez le schéma (voir section [Base de données](#-base-de-données))

### 4. Configurer les variables d'environnement

Copiez le fichier `.env.example` en `.env` :

```bash
cp .env.example .env
```

Éditez le fichier `.env` :

```env
# Base de données
DB_HOST=localhost
DB_PORT=3306
DB_NAME=memory
DB_USER=root
DB_PASSWORD=

# Application
APP_ENV=dev
APP_URL=http://localhost
```

### 5. Configurer le serveur web

#### Avec Laragon (recommandé)
1. Placez le projet dans `C:\laragon\www\memory`
2. Le virtual host sera automatiquement créé : `http://memory.test`

#### Avec Apache manuel
Configurez le DocumentRoot vers le dossier `public/` :

```apache
<VirtualHost *:80>
    ServerName memory.local
    DocumentRoot "C:/path/to/memory/public"
    
    <Directory "C:/path/to/memory/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Ajoutez dans `C:\Windows\System32\drivers\etc\hosts` :
```
127.0.0.1 memory.local
```

### 6. Vérifier l'installation

Accédez à : `http://localhost/memory/public/` ou `http://memory.test`

Vous devriez voir la page d'accueil.

---

## ⚙️ Configuration

### Structure du fichier `.env`

```env
# Base de données
DB_HOST=localhost          # Hôte MySQL
DB_PORT=3306               # Port MySQL
DB_NAME=memory             # Nom de la base
DB_USER=root               # Utilisateur MySQL
DB_PASSWORD=               # Mot de passe MySQL

# Application
APP_ENV=dev                # Environnement (dev/prod)
APP_URL=http://localhost   # URL de base
```

### Sécurité en production

Pour un environnement de production, modifiez :

```env
APP_ENV=prod
```

Et dans `core/Database.php`, personnalisez la gestion des erreurs.

---

## 📁 Structure du projet

```
memory/
├── app/
│   ├── Controllers/          # Contrôleurs MVC
│   │   ├── GameController.php
│   │   ├── UserController.php
│   │   └── HomeController.php
│   ├── Models/               # Modèles (accès BDD)
│   │   ├── Card.php
│   │   ├── Score.php
│   │   └── User.php
│   └── Views/                # Vues (templates)
│       ├── auth/
│       │   ├── login.php
│       │   └── register.php
│       ├── game/
│       │   ├── index.php
│       │   ├── plateau.php
│       │   ├── bravo.php
│       │   └── classement.php
│       └── layout.php
├── core/                     # Noyau de l'application
│   ├── BaseController.php    # Contrôleur de base
│   ├── Database.php          # Connexion BDD (Singleton)
│   └── Router.php            # Système de routing
├── public/                   # Dossier public (DocumentRoot)
│   ├── assets/
│   │   └── global.css        # Styles CSS
│   ├── .htaccess             # Réécriture d'URL
│   └── index.php             # Point d'entrée
├── vendor/                   # Dépendances Composer
├── .env                      # Variables d'environnement (à créer)
├── .env.example              # Exemple de configuration
├── .gitignore
├── composer.json
├── helpers.php               # Fonctions utilitaires
└── README.md
```

---

## 🎮 Utilisation

### 1. Inscription / Connexion

1. Accédez à `/register` pour créer un compte
2. Remplissez le formulaire (login, email, mot de passe, nom, prénom)
3. Connectez-vous via `/login`

### 2. Lancer une partie

1. Accédez à `/game`
2. Choisissez le niveau de difficulté :
   - **Débutant** : 3 paires (6 cartes)
   - **Normal** : 6 paires (12 cartes)
   - **Difficile** : 9 paires (18 cartes)
   - **Expert** : 12 paires (24 cartes)
3. Cliquez sur "Lancer la partie"

### 3. Jouer

1. Cliquez sur une première carte (elle se retourne)
2. Cliquez sur une deuxième carte
3. Si les cartes correspondent → Elles restent visibles
4. Si elles ne correspondent pas → Elles se cachent après 1 seconde
5. Trouvez toutes les paires le plus vite possible !

### 4. Consulter le classement

1. Accédez à `/game/classement`
2. Consultez le top 10 des meilleurs temps
3. Les scores sont triés par :
   - Temps (du plus rapide au plus lent)
   - Nombre de paires (en cas d'égalité)

---

## 🗄 Base de données

### Schéma SQL

```sql
-- Table des utilisateurs
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des scores
CREATE TABLE scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    temps TIME NOT NULL,
    nombre_paires INT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Index pour optimiser les requêtes
CREATE INDEX idx_temps ON scores(temps);
CREATE INDEX idx_user ON scores(id_utilisateur);
```

### Relations

- Un **utilisateur** peut avoir plusieurs **scores** (1:N)
- Un **score** appartient à un seul **utilisateur** (N:1)

---

## 🔒 Sécurité

### Mesures implémentées

1. **Protection CSRF**
   - Tokens générés pour chaque formulaire
   - Validation côté serveur

2. **Protection XSS**
   - Échappement systématique avec `htmlspecialchars()`
   - Fonctions helper : `esc()`, `e()`, `escape()`

3. **Protection SQL Injection**
   - Requêtes préparées PDO (paramètres liés)
   - Aucune concaténation SQL brute

4. **Authentification sécurisée**
   - Hashage bcrypt (`PASSWORD_DEFAULT`)
   - Vérification avec `password_verify()`
   - Coût de hashage adaptatif

5. **Validation des données**
   - Validation des emails
   - Vérification de la longueur des mots de passe (min. 6 caractères)
   - Vérification de l'unicité des logins

6. **Sessions sécurisées**
   - Régénération d'ID après connexion
   - Destruction complète à la déconnexion

---

## 🎨 Captures d'écran

### Page d'accueil du jeu
![Accueil](docs/screenshots/home.png)

### Plateau de jeu
![Plateau](docs/screenshots/plateau.png)

### Classement
![Classement](docs/screenshots/classement.png)

---

## 🚧 Améliorations futures

- [ ] Système de niveaux progressifs
- [ ] Mode multijoueur en temps réel
- [ ] Thèmes de cartes personnalisables
- [ ] Statistiques détaillées par joueur
- [ ] API REST pour une version mobile
- [ ] Système de badges/récompenses
- [ ] Mode "contre la montre"
- [ ] Partage de scores sur les réseaux sociaux

---

## 📝 License

Ce projet est sous licence MIT. Vous êtes libre de l'utiliser, le modifier et le distribuer.

---

## 👨‍💻 Auteur

**Votre Nom**
- GitHub: [@votre-username](https://github.com/votre-username)
- Email: votre.email@example.com

---

## 🙏 Remerciements

- **Picsum Photos** pour les images aléatoires
- **Composer** pour la gestion des dépendances
- **vlucas/phpdotenv** pour la gestion des variables d'environnement

---

## 📞 Support

Pour toute question ou problème :
1. Ouvrez une [issue](https://github.com/votre-username/memory-game/issues)
2. Consultez la [documentation](https://github.com/votre-username/memory-game/wiki)
3. Contactez-moi par email

---

**Bon jeu ! 🎮✨**