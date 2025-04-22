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
  <title><?= htmlspecialchars($poll['title']) ?></title>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js" defer></script>
</head>
<body>
  <h1><?= htmlspecialchars($poll['title']) ?></h1>

  <!-- Formulaire de vote -->
  <form id="vote-form">
    <!-- On garde l’ID du sondage en champ caché -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($poll['id']) ?>">

    <?php foreach ($poll['options'] as $idx => $opt): ?>
      <div>
        <input type="radio"
               id="opt<?= $idx ?>"
               name="choice"
               value="<?= $idx ?>">
        <label for="opt<?= $idx ?>"><?= htmlspecialchars($opt['label']) ?></label>
      </div>
    <?php endforeach; ?>

    <button type="submit">Voter</button>
  </form>

  <!-- Zone où s’afficheront les résultats -->
  <div id="results"></div>
</body>
</html>
