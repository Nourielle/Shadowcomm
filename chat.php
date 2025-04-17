<?php
session_start();
include 'bd.php'; // Connexion à la base de données
include 'Chiffrement.php'; // Fonctions de chiffrement

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die("Erreur : utilisateur non connecté.");
}

// Gestion de l'envoi de message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = caesar_cipher($_POST['message']); // Chiffrer le message
    $sender_id = $_SESSION['user_id'];
    $timestamp = date('Y-m-d H:i:s'); // Date et heure actuelles

    $conn->query("INSERT INTO messages (sender_id, content, timestamp) VALUES ('$sender_id', '$message', '$timestamp')");
}

// Gestion de la suppression de compte
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account'])) {
    $user_id = $_SESSION['user_id'];

    // Supprimer les messages associés à l'utilisateur avant de supprimer l'utilisateur
    $conn->query("DELETE FROM messages WHERE sender_id = '$user_id'");

    // Supprimer l'utilisateur
    if ($conn->query("DELETE FROM users WHERE id = '$user_id'")) {
        session_destroy(); // Détruire la session
        echo "<script>alert('Votre compte a été supprimé.'); window.location.href='inscri.php';</script>";
        exit;
    }
}

// Récupérer et afficher les messages
$messages = $conn->query("SELECT users.username, messages.content, messages.timestamp 
     FROM messages 
     JOIN users ON messages.sender_id = users.id 
     ORDER BY messages.id ASC"); 
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chat Sécurisé</title>
    <style>
        /* Styles pour la mise en page du chat */
        body { background: #0a0a0a; color: #00ffcc; font-family: Arial, sans-serif; text-align: center; }
        .chat-box { width: 50%; margin: auto; border: 1px solid #00ffcc; padding: 20px; background: #222; border-radius: 10px; display: flex; flex-direction: column; }
        .messages-container { flex-grow: 1; overflow-y: auto; display: flex; flex-direction: column; }
        .message { margin: 10px 0; padding: 10px; background: #333; border-radius: 5px; }
        .timestamp { font-size: 0.8em; color: #888; display: block; margin-top: 5px; }
        input, button { padding: 10px; margin-top: 10px; }
        .delete-btn { background: red; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; }
        .logout-btn { background: #00bcd4; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="chat-box">
        <h2>Chat Sécurisé</h2>
        <div class="messages-container" id="messages">
            <!-- Affichage des messages -->
            <?php while ($msg = $messages->fetch_assoc()): ?>
                <div class="message">
                    <strong><?= htmlspecialchars($msg['username']) ?>:</strong> <?= htmlspecialchars(caesar_decipher($msg['content'])) ?>
                    <span class="timestamp"><?= htmlspecialchars(date('H\hi', strtotime($msg['timestamp']))) ?></span>
                </div>
            <?php endwhile; ?>
        </div>
        <!-- Formulaire pour envoyer un message -->
        <form method="POST">
            <input type="text" name="message" required>
            <button type="submit">Envoyer</button>
        </form>
        <!-- Formulaire pour supprimer le compte -->
        <form method="POST">
            <button type="submit" name="delete_account" class="delete-btn">Supprimer mon compte</button>
        </form>
        <!-- Bouton de déconnexion -->
        <form action="logout.php" method="POST">
            <button type="submit" class="logout-btn">Déconnexion</button>
        </form>
    </div>
    <script>
        // Faire défiler automatiquement vers le bas pour afficher les nouveaux messages
        const messagesContainer = document.getElementById('messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    </script>
</body>
</html>