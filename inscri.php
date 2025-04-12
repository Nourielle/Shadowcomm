<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - ShadowComm</title>
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
        .input-container {
            position: relative;
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
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2em;
            color: cyan;
        }
        .rgpd { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 0.9em; 
            margin-top: 10px; 
        }
        .rgpd input { 
            width: auto; 
            margin-right: 10px; 
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
        .error { 
            color: red; 
            font-size: 0.9em; 
            margin-top: 5px; 
        }
        .link { 
            margin-top: 15px; 
            display: block; 
            color: cyan; 
            text-decoration: none; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <form id="registerForm" action="redirection.php" method="POST">
            <!-- Champ pour le nom d'utilisateur -->
            <input type="text" name="username" id="username" placeholder="Nom de code" required>
            <p class="error" id="usernameError"></p>
            
            <!-- Champ pour le mot de passe avec option de visibilité -->
            <div class="input-container">
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <span class="toggle-password" onclick="togglePassword('password', this)">🙈</span>
            </div>
            <p class="error" id="passwordError"></p>
            
            <!-- Champ pour confirmer le mot de passe -->
            <div class="input-container">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer le mot de passe" required>
                <span class="toggle-password" onclick="togglePassword('confirm_password', this)">🙈</span>
            </div>
            
            <!-- Champ  pour indiquer une inscription -->
            <input type="hidden" name="register" value="1">
            
            <!-- Checkbox pour accepter les conditions d'utilisation -->
            <div class="rgpd">
                <input type="checkbox" id="rgpd" required>
                <label for="rgpd">J'accepte les conditions d'utilisation</label>
            </div>
            <p class="error" id="errorMessage"></p>
            
            <!-- Bouton pour soumettre le formulaire -->
            <button type="submit" class="btn">S'inscrire</button>
            
            <!-- Lien pour rediriger vers la page de connexion -->
            <a href="co.php" class="link">Déjà inscrit ? Connectez-vous ici</a>
        </form>
    </div>
    <script>
        // Fonction pour basculer la visibilité du mot de passe
        function togglePassword(id, element) {
            let input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                element.textContent = "🙉"; // Œil ouvert
            } else {
                input.type = "password";
                element.textContent = "🙈"; // Œil fermé
            }
        }

        // Validation du formulaire avant soumission
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            let username = document.getElementById("username").value;
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirm_password").value;
            let errorMessage = document.getElementById("errorMessage");
            let usernameError = document.getElementById("usernameError");
            let passwordError = document.getElementById("passwordError");
            
            // Politique de mot de passe stricte
            let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*_-])[A-Za-z\d!@#$%^&*_-]{8,}$/;
            if (!passwordRegex.test(password)) {
                passwordError.textContent = "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
                event.preventDefault();
            } else if (password !== confirmPassword) {
                errorMessage.textContent = "Les mots de passe ne correspondent pas.";
                event.preventDefault();
            }
            
            // Vérification si le nom d'utilisateur existe déjà
            fetch('verifier_nom_code.php?username=' + encodeURIComponent(username))
                .then(response => response.text())
                .then(data => {
                    if (data.includes("existe")) {
                        usernameError.textContent = "Ce nom de code est déjà utilisé.";
                        event.preventDefault();
                    }
                });
        });
    </script>
</body>
</html>
