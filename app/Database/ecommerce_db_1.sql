CREATE DATABASE IF NOT EXISTS ecommerce_db_1
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ecommerce_db_1;

CREATE TABLE utilisateurs (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    motDePasse VARCHAR(255) NOT NULL
);

CREATE TABLE adresses (
    id_adresse INT AUTO_INCREMENT PRIMARY KEY,
    pays VARCHAR(50) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    nom_de_contact VARCHAR(100) NOT NULL,
    tel VARCHAR(15) NOT NULL,
    code_Postal INT NOT NULL,
    par_defaut BOOLEAN DEFAULT 0,
    id_utilisateur INT NOT NULL,
    FOREIGN KEY (id_utilisateur) 
        REFERENCES utilisateurs(id_utilisateur)
        ON DELETE CASCADE
);

CREATE TABLE categories (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nomCategorie VARCHAR(100) NOT NULL,
    description VARCHAR(50)
);

CREATE TABLE marques (
    id_marque INT AUTO_INCREMENT PRIMARY KEY,
    nomMarque VARCHAR(50),
    slug VARCHAR(100) UNIQUE
);

CREATE TABLE produits (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(100) NOT NULL,
    prixAchat DECIMAL(10,2) NOT NULL,
    prixVente DECIMAL(10,2) NOT NULL,
    quantiteStock INT NOT NULL,
    stock_critique INT NOT NULL,
    slug VARCHAR(200) UNIQUE,
    description TEXT NOT NULL,
    date_mise_en_vente DATETIME,
    id_marque INT NOT NULL,
    id_categorie INT NOT NULL,
    FOREIGN KEY (id_marque) REFERENCES marques(id_marque),
    FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie)
);

CREATE TABLE commandes (
    id_commande INT AUTO_INCREMENT PRIMARY KEY,
    NumCommande VARCHAR(50) NOT NULL,
    date_commande DATETIME NOT NULL,
    statut ENUM('en_attente','en_cours','livrée','annulée') DEFAULT 'en_attente' NOT NULL ,
    id_adresse INT NOT NULL,
    id_utilisateur INT NOT NULL,
    FOREIGN KEY (id_adresse) REFERENCES adresses(id_adresse),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

CREATE TABLE images_produit (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    texte_alt VARCHAR(225),
    est_principal BOOLEAN DEFAULT 0,
    id_Produit INT NOT NULL,
    FOREIGN KEY (id_Produit) REFERENCES produits(id_Produit)
);

CREATE TABLE promotions (
    id_promo INT AUTO_INCREMENT PRIMARY KEY,
    valeur_discount DECIMAL(10,2) NOT NULL,
    date_debut DATETIME NOT NULL,
    dure INT NOT NULL,
    id_Produit INT NOT NULL,
    FOREIGN KEY (id_Produit) REFERENCES produits(id_Produit)
);

CREATE TABLE reviews (
    id_review INT AUTO_INCREMENT PRIMARY KEY,
    rating INT,
    comment VARCHAR(50),
    titre VARCHAR(50),
    id_Produit INT NOT NULL,
    FOREIGN KEY (id_Produit) REFERENCES produits(id_Produit)
);

CREATE TABLE caracteristiques (
    id_caracteristique INT AUTO_INCREMENT PRIMARY KEY,
    caracteristique VARCHAR(50),
    value_caracteristique VARCHAR(50) NOT NULL,
    id_Produit INT NOT NULL,
    FOREIGN KEY (id_Produit) REFERENCES produits(id_Produit)
);

CREATE TABLE lignesCommande (
    id_produit INT,
    id_commande INT,
    quantité INT NOT NULL,
    prixUnitaire DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id_produit, id_commande),
    FOREIGN KEY (id_produit) REFERENCES produits(id_produit),
    FOREIGN KEY (id_commande) REFERENCES commandes(id_commande)
);

ALTER TABLE utilisateurs ADD COLUMN role VARCHAR(50) DEFAULT 'user';

ALTER TABLE commandes 
MODIFY COLUMN statut ENUM('en_attente','en_cours','livrée','annulée','payé') 
DEFAULT 'en_attente' 
NOT NULL;