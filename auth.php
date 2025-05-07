<?php
session_start();

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Accepter tous les utilisateurs sans vérification
    $_SESSION['authenticated'] = true;
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/styleauto.css"> 
</head>
<body>
    <h1 class="titre-principal">Bienvenue dans notre site de sondage – Hajar et Kaba</h1>
    <h2 class="titre-secondaire">Connexion</h2>

    <p>Entrez votre identifiant pour vous connecter.</p>
    <form method="post" action="auth.php">
        <label for="username">Nom d'utilisateur :</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>

</html>
