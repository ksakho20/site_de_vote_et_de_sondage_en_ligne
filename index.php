<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Créer un sondage</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js" defer></script>
</head>
<body>
    <div class="container">
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
</body>
</html>
