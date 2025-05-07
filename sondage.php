<?php
// 1. On récupère l’ID du sondage depuis l’URL
$id   = $_GET['id'] ?? '';
$file = __DIR__ . "/data/{$id}.json";

// 2. On vérifie que le fichier existe
if (!$id || !file_exists($file)) {
    die('Sondage introuvable.');
}

// 3. On charge et décode le JSON
$poll = json_decode(file_get_contents($file), true);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Sondagiste • <?= htmlspecialchars($poll['title']) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/vote.js" defer></script>
</head>
<body>
  <!-- Header commun -->
  <header class="site-header">
    <div class="container">
      <h1 class="site-logo"><a href="index.php">Mon Sondagiste</a></h1>
      <nav class="site-nav">
        <a href="index.php">Créer</a>
        <a href="#">À propos</a>
      </nav>
    </div>
  </header>

  <!-- Contenu principal -->
  <main class="site-main container">
    <!-- Affichage de la description -->
    <div class="card">
        <h2>Description</h2>
        <p><?= nl2br(htmlspecialchars($poll['description'])) ?></p>
    </div>
    <div class="card">
      <h1><?= htmlspecialchars($poll['title']) ?></h1>
      <form id="vote-form">
        <input type="hidden" name="id" value="<?= htmlspecialchars($poll['id']) ?>">

        <?php foreach($poll['questions'] as $qIdx => $question): ?>
          <fieldset class="question-block">
            <legend><?= htmlspecialchars($question['label']) ?></legend>

            <?php foreach($question['options'] as $optIdx => $opt): ?>
              <div class="form-option">
                <input
                  type="radio"
                  id="q<?=$qIdx?>o<?=$optIdx?>"
                  name="choices[<?=$qIdx?>]" 
                  value="<?=$optIdx?>" >
                <label for="q<?=$qIdx?>o<?=$optIdx?>">
                  <?= htmlspecialchars($opt['label']) ?>
                </label>
              </div>
            <?php endforeach; ?>
          </fieldset>
        <?php endforeach; ?>

        <button type="submit">Voter</button>
      </form>
    </div>

    <div class="card">
      <div id="results"></div>
    </div>
  </main>

  <!-- Footer commun -->
  <footer class="site-footer">
    <div class="container">
      <p>&copy; 2025 Mon Sondagiste • <a href="#">Mentions légales</a></p>
    </div>
  </footer>
</body>
</html>
