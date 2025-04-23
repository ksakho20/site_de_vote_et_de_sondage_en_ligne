<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Sondagiste • Créer un sondage</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/create.js" defer></script>

</head>
<body>
    <header class="site-header">
        <div class="container">
        <h1 class="site-logo"><a href="index.php">Mon Sondagiste</a></h1>
        <nav class="site-nav">
            <a href="index.php">Créer</a>
            <a href="#">À propos</a>
        </nav>
        </div>
    </header>
    <main class="site-main container">
        <div class="card">
            <h1>Créer un nouveau sondage</h1>
            <form action="create.php" method="post" id="create-form">
                <div>
                <label for="title">Titre du sondage :</label>
                <input type="text" name="title" id="title" required>
                </div>
                <div id="options-container">
                <label>Options :</label>
                <div>
                    <input type="text" name="options[]" placeholder="Option 1" required>
                </div>
                <div>
                    <input type="text" name="options[]" placeholder="Option 2" required>
                </div>
                </div>
                <button type="button" id="add-option">Ajouter une option</button>
                <br><br>
                <button type="submit">Créer le sondage</button>
            </form>
        </div>
    </main>

    <footer class="site-footer">
    <div class="container">
      <p>&copy; 2025 Mon Sondagiste • <a href="#">Mentions légales</a></p>
    </div>
  </footer>
</body>
</html>
