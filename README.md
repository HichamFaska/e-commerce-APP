# E-commerce App

Ce guide explique les étapes pour installer et exécuter ce projet e-commerce localement.

---

## 1. Installation de Composer

Assurez-vous d'avoir [Composer](https://getcomposer.org/) installé sur votre machine.

```bash
composer install
```

Cette commande va installer toutes les dépendances du projet listées dans le fichier `composer.json`.

---

## 2. Configuration de l'environnement

1. Copiez le fichier `.env.exemple` et créez un nouveau fichier `.env` :

```bash
cp .env.exemple .env
```

2. Ouvrez le fichier `.env` et configurez les paramètres selon votre environnement :

```env
APP_NAME=MonApp
APP_ENV=local
APP_KEY=base64:...

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db_1
DB_USERNAME=root
DB_PASSWORD=
```

> **Remarque** : Assurez-vous que les informations de connexion à la base de données correspondent à votre configuration locale.

---

## 3. Création de la base de données

1. Créez une nouvelle base de données sur votre serveur MySQL :

```sql
CREATE DATABASE ecommerce_db_1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Importez le script SQL de la base de données fourni dans le dossier `App/Database/` pour créer toutes les tables et les données initiales.

---

## 4. Remplir le fichier `.env`

Vérifiez que le fichier `.env` contient bien les paramètres de votre base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db_1
DB_USERNAME=root
DB_PASSWORD=
```

---

## 5. Exécution du projet

Pour lancer le serveur local et tester le projet, utilisez la commande suivante depuis la racine du projet :

```bash
php -S 127.0.0.1:8000 -t public
```

- Le projet sera accessible via l’URL : [http://127.0.0.1:8000](http://127.0.0.1:8000)
- Toutes les pages et fonctionnalités (home, détails produit, panier, etc.) seront disponibles.

---

## 6. Structure du projet

- `app/` : Contient les contrôleurs, modèles, services et middlewares.
- `public/` : Contient les fichiers accessibles publiquement (images, CSS, JS).
- `resources/views/` : Contient les templates PHP pour les pages.
- `routes/web.php` : Contient toutes les routes du projet.
- `.env` : Fichier de configuration de l’environnement local.
- `composer.json` : Déclare les dépendances PHP du projet.

---

## 7. Support

Pour toute question ou problème lors de l’installation, veuillez vérifier que :

- Composer est correctement installé.
- Votre serveur MySQL est opérationnel.
- Le fichier `.env` contient bien vos informations de base de données.

## Configuration Stripe – Guide Complet

### 1. Créer un compte Stripe

1. Allez sur le site officiel de Stripe  
   👉 https://dashboard.stripe.com/register

2. Créez un compte (email, mot de passe).

3. Une fois connecté, vous arrivez sur le **Stripe Dashboard**.

### 2. Passer en mode Test (recommandé)

Dans le dashboard Stripe :

- En haut à droite, activez le bouton **“Mode test”**
- Toutes les clés commenceront par `pk_test_` et `sk_test_`
---

### 3. Obtenir les clés API Stripe

1. Dans le menu gauche du dashboard Stripe :
   - Cliquez sur **Developers**
   - Puis **API keys**

2. Vous verrez deux clés importantes :

| Clé | Description |
|----|------------|
| **Publishable key** | Utilisée côté frontend |
| **Secret key** | Utilisée côté backend (PHP) |

Exemple :
```text
Publishable key : pk_test_51XXXX
Secret key      : sk_test_51XXXX
```

---

### 4. Où placer les clés dans l’application

#### 4.1 Fichier `.env.example`

Ce fichier sert de **modèle**.  
Il ne contient **jamais de vraies clés**.

```dotenv
SECRET KEY=tyui....
```

#### 4.2 Fichier `.env`

Copiez `.env.example` et renommez-le en `.env`, puis ajoutez vos vraies clés :

```dotenv
SECRET KEY=XXXX
```

### 5. Cartes de test Stripe

Pour tester les paiements en mode test :

| Champ | Valeur |
|----|-------|
| Numéro de carte | `4242 4242 4242 4242` |
| Date d’expiration | N’importe quelle date future |
| CVC | `123` |

---

### 6. Documentation officielle

https://stripe.com/docs