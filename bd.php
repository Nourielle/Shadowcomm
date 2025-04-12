<?php

$host = 'localhost:3306'; // Adresse du serveur MySQL
$dbname = 'shadowcomm'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur MySQL
$password = ''; // Mot de passe MySQL 

// Connexion à la base de données
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    // Afficher un message d'erreur et arrêter l'exécution si la connexion échoue
    die("Échec de la connexion : " . $conn->connect_error);
}
?>
