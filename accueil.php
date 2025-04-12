<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShadowComm - Accueil</title>
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            color: #f5f5f5;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }
        h1 {
            font-size: 2.5em;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #ffffff;
        }
        p {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #dcdcdc;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            margin: 10px;
            font-size: 1.1em;
            text-transform: uppercase;
            color: #fff;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 0 15px rgba(37, 117, 252, 0.5);
            transition: transform 0.2s, box-shadow 0.3s;
        }
        .btn:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
            box-shadow: 0 0 20px rgba(37, 117, 252, 0.8);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue chez ShadowComm</h1>
        <p>L'agence de communication secrète pour les espions infiltrés.</p>
        <a href="co.php" class="btn">Connexion</a>
        <a href="inscri.php" class="btn">Inscription</a>
    </div>
</body>
</html>
