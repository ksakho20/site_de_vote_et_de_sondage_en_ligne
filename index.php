<?php
session_start();
// Protection : si pas authentifié, redirection vers auth.php
if (!isset($_SESSION['authenticated'])) {
    header('Location: auth.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Sondagiste • Créer un sondage</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/create.js" defer></script>
</head>
<body>
  <header class="site-header">
    <div class="container">
      <h1 class="site-logo"><a href="index.php">GoSondage</a></h1>
      <nav class="site-nav">
        <a href="index.php" class="active">Créer</a>
        <!--<a href="sondage.php">Mes sondages</a>*/-->
        <a href="sondage_list.php">Mes Sondages</a>
        <a href="a_propos.php"> À-Propos</a>
        <a href="logout.php">Déconnexion</a>
      </nav>
    </div>
  </header>

  <main class="site-main container">
    <div class="card">
      <h1>Créer un nouveau sondage</h1>
      <form action="create.php" method="post" id="create-form">
        <!-- champ titre -->
        <div class="field">
          <label for="title">Titre du sondage :</label>
          <input type="text" name="title" id="title" required>
        </div>
        <!-- champ description -->
        <div class="field">
          <label for="description">Description :</label>
          <textarea name="description" id="description" rows="3" required></textarea>
        </div>


        <!-- champ date de clôture -->
       <div class="field">
         <label for="close">Date de clôture :</label>
         <input
           type="datetime-local"
           name="close"
           id="close"
           required>
       </div>

        <!-- questions dynamiques -->
        <div id="questions-container">
          <template id="question-template">
            <div class="question-block" data-idx="{idx}">
              <div class="field">
                <label>Question {num} :</label>
                <input type="text" name="questions[{idx}]" placeholder="Question {num}" required>
              </div>
              <div class="options-container">
                <div class="field">
                  <input type="text" name="options[{idx}][]" placeholder="Option 1" required>
                </div>
                <div class="field">
                  <input type="text" name="options[{idx}][]" placeholder="Option 2" required>
                </div>
              </div>
              <button type="button" class="btn-add-option" data-idx="{idx}">
                Ajouter une option
              </button>
            </div>
          </template>
        </div>
        <button type="button" id="add-question">Ajouter une question</button>
        <br><br>
        <button type="submit">Créer le sondage</button>
      </form>
    </div>
  </main>

  <footer class="site-footer">
    <div class="container">
      <p>&copy; 2025  Notre GoSondage • <a href="about.php">À propos</a></p>
    </div>
  </footer>
</body>
</html>
