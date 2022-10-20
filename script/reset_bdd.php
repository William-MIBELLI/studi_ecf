<?php

try{
    $pdo = new PDO('mysql:host=localhost;', 'root');
} catch (PDOException $e){
    echo 'Erreur pendant la remise à zéro de la base de donnée : '.$e->getMessage();
}

$pdo->exec('DROP DATABASE IF EXISTS ecf_database');
$pdo->exec('CREATE DATABASE ecf_database');
$pdo = null;
$pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');


$pdo->exec('CREATE TABLE Role (
    id_role INT PRIMARY KEY NOT NULL,
    name VARCHAR(100)
)');
$res = $pdo->exec('CREATE TABLE User (
    id_user INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    commercial_name VARCHAR(100),
    firstname VARCHAR(100),
    lastname VARCHAR(100), 
    address VARCHAR(255),
    postal_code VARCHAR(5),
    city VARCHAR(100),
    mail VARCHAR(255) UNIQUE,
    phone VARCHAR(10),
    password VARCHAR(100),
    role_id INT NOT NULL,
    is_active TINYINT,
    first_connection TINYINT,
    FOREIGN KEY (role_id) REFERENCES Role(id_role)
)');
$pdo->exec('CREATE TABLE permission (
    id_permission INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    description VARCHAR(255)
)');
$pdo->exec('CREATE TABLE partner (
    id_partner INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE
)');
$pdo->exec('CREATE TABLE global (
    id_global INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    permission_id INT NOT NULL,
    partner_id INT NOT NULL,
    is_active_global TINYINT NOT NULL,
    FOREIGN KEY (permission_id) REFERENCES permission (id_permission) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (partner_id) REFERENCES partner (id_partner) ON DELETE CASCADE ON UPDATE CASCADE
)');
$pdo->exec('CREATE TABLE structure (
    id_structure INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    partner_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (partner_id) REFERENCES partner (id_partner) ON DELETE CASCADE ON UPDATE CASCADE
)');
$pdo->exec('CREATE TABLE local (
    id_local INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    global_id INT NOT NULL,
    structure_id INT NOT NULL,
    is_active_local TINYINT NOT NULL,
    FOREIGN KEY (global_id) REFERENCES global(id_global) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (structure_id) REFERENCES structure (id_structure) ON DELETE CASCADE ON UPDATE CASCADE
)');
$pdo->exec(
    'INSERT INTO permission 
    (name, description) 
    VALUES 
    ("Distributeur de boissons", "WorkOUT Base met à disposition des distributeurs de boissons énergisantes au sein de votre salle"),
    ("Produits dérivés", "Possibilité de vendre différents produits à l\'éffigie de la marque"),
    ("Open 24 - 24", "Mise en place d\'un système d\'accés automatisé pour les membres afin de pouvoir laisser la salle ouverte 24H sur 24"),
    ("Publicité locale", "Vous profitez des encart publicitaire achetés par le groupe afin de promouvoir votre salle"),
    ("Newsletter", "Tous vos membres recoivent la newsletter du groupe"),
    ("Chaine TV musicale", "Diffuse des clips musicaux tout au long de la journée"),
    ("Gestion décentralisée", "WorkOUT gère pour vous toute la partie administration et comptabilité"),
    ("Relais Pick-up", "Vos clients peuvent se faire livrer leurs colis directement dans votre salle"),
    ("Coach fitness", "Un coach fitness vient donner 2 cours par semaine dans votre salle"),
    ("Nettoyage des locaux", "Une société partenaire s\'occupe de l\'entretien de votre salle à un tarif préférentiel")');
$pdo->exec('INSERT INTO role (id_role, name) VALUES (1,"ROLE_ADMIN"), (2, "ROLE_PARTNER"), (3, "ROLE_STRUCTURE")');
$pdo->exec('INSERT INTO user 
(id_user, commercial_name, firstname, lastname, address, postal_code, city, mail, phone, password, role_id, is_active, first_connection)
    VALUES 
    (NULL,"Buckito Corp", "William", "MIBELLI", "42 rue du chateau", "11270", "LA FORCE", "william.mibelli@gmail.com", "0505050505", "monMDP", 1, 1, 1),
    (NULL,"saucisse industry", "saucisse", "le chat", "42 rue du chateau", "11270", "LA FORCE", "saucisse.gm@gmail.com", "0707070707", "mdpDesEnfersss", 1, 1, 1),
    (NULL,"Company du Billy", "Nicolas", "MIBELLI", "18 rue Barbès", "11000", "CARCASSONNE", "nicolasmj@gmail.com","0606060606" , "MdpdeMALADE", 2, 1, 1)');
    $pdo->exec('INSERT INTO partner (user_id) VALUES (1)');
    $pdo->exec('INSERT INTO partner (user_id) VALUES (3)');
    $pdo->exec('INSERT INTO partner (user_id) VALUES (2)');
    $pdo->exec('INSERT INTO global (permission_id, partner_id, is_active_global) VALUES (1,1,1),(2,1,1),(3,1,1)');

