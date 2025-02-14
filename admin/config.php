<?php
// config.php

$host = 'mysql-decodumonde.alwaysdata.net'; // Adresse du serveur
$dbname = 'decodumonde_personnalisation'; // Nom de la base de données
$username = '390609'; // Nom d'utilisateur de la base de données
$password = '2024DDM!'; // Mot de passe de la base de données

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configuration pour afficher les erreurs SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
