<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>GoSondage • À propos</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <header class="site-header">
    <div class="container">
      <h1 class="site-logo"><a href="index.php">GoSondage</a></h1>
      <nav class="site-nav">
        <a href="index.php" class="active">Accueil</a>
        <a href="logout.php">Déconnexion</a>
      </nav>
    </div>
  </header>
  <main class="site-main container">
    <div class="card">
      <h1>À propos de GoSondage</h1>
      <p>GoSondage est un petit projet universitaire de création de sondages en ligne, développé en PHP natif, JavaScript (Ajax) et CSS.</p>
      <h2>Pourquoi ce projet ?</h2>
      <ul>
        <li>Apprendre les interactions client-serveur avec PHP sans base de données.</li>
        <li>Maîtriser l’AJAX pour une UX fluide.</li>
        <li>Découvrir la gestion de fichiers JSON et le versioning Git.</li>
      </ul>
      <h2>Technologies utilisées</h2>
      <ul>
        <li><strong>HTML5 & CSS3</strong> (avec variables CSS et animations) pour le design.</li>
        <li><strong>JavaScript</strong> : form dynamically, Ajax pour le vote et le rafraîchissement des résultats.</li>
        <li><strong>PHP 8</strong> : back-end, gestion des sondages en JSON.</li>

      </ul>
      <h2>L’équipe</h2>
      <p>Réalisé par <strong>Kaba SAKHO</strong> et <strong>Hajar BITARI</strong> dans le cadre du cours de Programmation Web L3 à l’USPN.</p>
    </div>
  </main>

  <?php include 'footer.php'; ?>
</body>
</html>
