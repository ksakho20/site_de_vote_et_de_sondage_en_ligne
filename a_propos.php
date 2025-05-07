<?php
// about.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Sondagiste • À propos</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="site-header">
    <div class="container">
      <h1 class="site-logo"><a href="index.php">Mon Sondagiste</a></h1>
      <nav class="site-nav">
        <a href="index.php">Créer</a>
        <a href="about.php" class="active">À propos</a>
      </nav>
    </div>
  </header>

  <main class="site-main container">
    <div class="card">
      <h2>À propos de notre site de Vote & de Sondage</h2>
      <p>Notre Sondagiste est un projet de L3 Informatique à l’Université Sorbonne Paris Nord.</p>
      <ul>
        <li><strong>Stack :</strong> PHP natif, JSON pour stocker les sondages, JavaScript (AJAX).</li>
        <li><strong>Fonctionnalités :</strong> création de sondages multi-questions, vote en temps réel, rafraîchissement périodique.</li>
        <li><strong>Développement :</strong> structuration en MVC léger, pas de base de données, tout stocké en JSON.</li>
      </ul>
      <p> <strong> Réalisé par : Kaba & Hajar</strong></p>
    </div>
  </main>

  <footer class="site-footer">
    <div class="container">
      &copy; 2025 Mon SiteDeVote • <a href="#">Mentions légales</a>
    </div>
  </footer>
</body>
</html>
