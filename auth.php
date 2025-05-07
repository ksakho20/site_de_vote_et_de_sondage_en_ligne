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
  <title>Mon Sondagiste • Connexion</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">

  <!-- Calque sombre au-dessus du background -->
  <div class="auth-overlay"></div>

  <!-- Formulaire centré -->
  <div class="auth-container">
    <div class="auth-card">
      <h2>Connexion</h2>
      <form action="auth.php" method="post">
        <label for="user">Nom d’utilisateur :</label>
        <input type="text" id="user" name="user" required>

        <label for="pass">Mot de passe :</label>
        <input type="password" id="pass" name="pass" required>

        <button type="submit">Se connecter</button>
      </form>
      <p class="legal">&copy; 2025 Mon Sondagiste • <a href="about.php">Mentions légales</a></p>
    </div>
  </div>

</body>
</html>

