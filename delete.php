<?php
session_start();
include 'bd.php'; // Connexion à la base de données

if (!isset($_SESSION['user_id'])) {
    echo "Erreur : utilisateur non connecté.";
    exit;
}

$user_id = $_SESSION['user_id'];

// Supprimer l'utilisateur de la base de données
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
if ($stmt->execute()) {
    session_destroy(); // Détruire la session
    echo "Votre compte a été supprimé avec succès.";
} else {
    echo "Erreur lors de la suppression du compte.";
}
$stmt->close();
$conn->close();
?>



<?php
session_start();
include 'bd.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['pseudo'])) {
    header('Location: co.php');
    exit();
}

$pseudo = $_SESSION['pseudo'];

// Supprimer les messages de l'utilisateur
$bdd->prepare('DELETE FROM messages WHERE pseudo = ?')->execute([$pseudo]);

// Supprimer le compte utilisateur
$bdd->prepare('DELETE FROM users WHERE pseudo = ?')->execute([$pseudo]);
 

// Rediriger vers la page d'accueil
header('Location: accueil.php');
exit();
?>
