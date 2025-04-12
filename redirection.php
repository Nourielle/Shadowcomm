<?php
session_start();
include 'bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (isset($_POST['register'])) {
        // Vérifier si l'utilisateur existe déjà
        $query = "SELECT id FROM users WHERE username = '$username'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<script>alert('Utilisateur déjà existant'); window.location.href='inscri.php';</script>";
            exit;
        }

        // Hash du mot de passe et insertion
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        
        if ($conn->query($query)) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['username'] = $username;
            header("Location: chat.php");
            exit;
        } else {
            echo "<script>alert('Erreur lors de l'inscription'); window.location.href='inscri.php';</script>";
        }
    }

    if (isset($_POST['login'])) {
        $query = "SELECT id, password FROM users WHERE username = '$username'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Vérifier si le mot de passe est correct
            if (isset($user['password']) && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                header("Location: chat.php");
                exit;
            } else {
                echo "<script>alert('Mot de passe incorrect'); window.location.href='co.php';</script>";
            }
        } else {
            echo "<script>alert('Utilisateur introuvable'); window.location.href='co.php';</script>";
        }
    }
}
$conn->close();
?>
