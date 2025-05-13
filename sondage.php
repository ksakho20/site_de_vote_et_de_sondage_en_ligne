<?php
// Démarre la session pour vérifier l’authentification
session_start();

// Si l’utilisateur n’est pas connecté, on le renvoie vers la page de connexion
if (!isset($_SESSION['authenticated'])) {
    header('Location: auth.php');
    exit;
}

// Récupère l’ID du sondage depuis l’URL (?id=poll_xxx)
$id   = $_GET['id'] ?? '';
$file = __DIR__ . "/data/{$id}.json";

// Si l’ID est manquant ou que le fichier JSON n’existe pas, on bloque
if (!$id || !file_exists($file)) {
    die('Sondage introuvable.');
}

// Charge le contenu du fichier JSON et le décode en tableau PHP
$poll = json_decode(file_get_contents($file), true);

// Calcule la date actuelle et vérifie si le sondage est passé après sa date de clôture
$now    = time();
$closed = isset($poll['close']) && $now > $poll['close'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <!-- Titre de l’onglet : titre du sondage -->
  <title><?= htmlspecialchars($poll['title']) ?></title>
  <!-- Chargement du CSS global -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Chargement du JS de vote (AJAX + rendu des résultats) -->
  <script src="js/vote.js" defer></script>
</head>
<body>
  <!-- Header commun avec navigation -->
  <header class="site-header">
    <div class="container">
      <h1 class="site-logo"><a href="index.php">GoSondage</a></h1>
      <nav class="site-nav">
        <a href="index.php">Créer</a>
        <a href="logout.php">Déconnexion</a>
      </nav>
    </div>
  </header>

  <main class="site-main container">
    <!-- Carte principale : titre, description, date de clôture -->
    <div class="card">
      <!-- Affiche le titre -->
      <h1><?= htmlspecialchars($poll['title']) ?></h1>

      <!-- Si une description existe, on l’affiche -->
      <?php if (!empty($poll['description'])): ?>
        <p><em><?= nl2br(htmlspecialchars($poll['description'])) ?></em></p>
      <?php endif; ?>

      <!-- Si une date de clôture est définie, on l’affiche -->
      <?php if (isset($poll['close'])): ?>
        <p><small>Clôture prévue le : <?= date('d/m/Y H:i', $poll['close']) ?></small></p>
      <?php endif; ?>

      <!-- Si le sondage est fermé, on affiche un message et on n’affiche pas le formulaire -->
      <?php if ($closed): ?>
        <p class="closed-msg">🔒 Ce sondage est clôturé.</p>
      <?php else: ?>
        <!-- Sinon, on affiche le formulaire de vote -->
        <form id="vote-form">
          <!-- Champ caché : identifiant du sondage -->
          <input type="hidden" name="id" value="<?= htmlspecialchars($poll['id']) ?>">

          <!-- Boucle sur chaque question -->
          <?php foreach ($poll['questions'] as $qIdx => $question): ?>
            <fieldset class="question-block">
              <!-- Légende de la question -->
              <legend><?= htmlspecialchars($question['label']) ?></legend>
              <!-- Boucle sur chaque option de la question -->
              <?php foreach ($question['options'] as $optIdx => $opt): ?>
                <div class="form-option">
                  <!-- Bouton radio pour cette option -->
                  <input
                    type="radio"
                    id="q<?= $qIdx ?>o<?= $optIdx ?>"
                    name="choices[<?= $qIdx ?>]"
                    value="<?= $optIdx ?>">
                  <label for="q<?= $qIdx ?>o<?= $optIdx ?>">
                    <?= htmlspecialchars($opt['label']) ?>
                  </label>
                </div>
              <?php endforeach; ?>
            </fieldset>
          <?php endforeach; ?>

          <!-- Bouton pour soumettre le vote -->
          <button type="submit">Voter</button>
        </form>
      <?php endif; ?>
    </div>

    <!-- Carte des résultats, toujours affichée -->
    <div class="card">
      <div id="results"></div>
    </div>
  </main>

  <!-- Footer commun -->
  <footer class="site-footer">
    <div class="container">
      <p>&copy; 2025 GoSondage • <a href="about.php">À propos</a></p>
    </div>
  </footer>
  <div id="toast" class="toast">✅ Vote enregistré</div>
</body>
</html>
