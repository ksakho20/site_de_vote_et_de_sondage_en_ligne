<?php
session_start();
// Si déjà authentifié, redirige vers index
if (isset($_SESSION['authenticated'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ici tu peux ajouter une vraie vérif, pour l'exemple on l'autorise toujours
    $_SESSION['authenticated'] = true;
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Système de Vote • Connexion</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="./js/create.js" defer></script>
  <link rel="icon" type="image/png" href="img/icone.png">
</head>
<body class="auth-page">
  <div class="auth-overlay"></div>
  <div class="auth-container">
    <div class="auth-card">
      <h2>Connexion</h2>
      <?php if ($error): ?><p class="error"><?=htmlspecialchars($error)?></p><?php endif; ?>
      <form method="post" action="auth.php">
        <label for="user">Nom d’utilisateur :</label>
        <input type="text" id="user" name="user" required>
        <label for="pass">Mot de passe :</label>
        <input type="password" id="pass" name="pass" required>
        <button type="submit">Se connecter</button>
      </form>
      <p class="legal">&copy; 2025 Notre GoSondage • <a href="about.php">Mentions légales</a></p>
    </div>
  </div>
</body>
</html>