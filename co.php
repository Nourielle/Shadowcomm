<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - ShadowComm</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0a0a0a;
            color: white;
        }
        .container {
            background: rgba(20, 20, 20, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px cyan;
            width: 350px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: cyan;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: #111;
            color: white;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: cyan;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            color: black;
            margin-top: 10px;
            transition: 0.3s;
        }
        .btn:hover {
            background: #00bcd4;
            box-shadow: 0 0 10px cyan;
        }
        .link {
            margin-top: 15px;
            display: block;
            color: cyan;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="redirection.php" method="POST">
            <input type="text" name="username" placeholder="Nom de code" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="hidden" name="login" value="1">
            <button type="submit" class="btn">Se connecter</button>
        </form>
        <a href="inscri.php" class="link">Pas encore inscrit ? Inscrivez-vous ici</a>
    </div>
</body>
</html>
