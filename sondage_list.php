<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: auth.php');
    exit;
}
$dataDir = __DIR__.'/data';
$files   = array_filter(scandir($dataDir), fn($f)=>str_ends_with($f,'.json'));
$polls   = [];
foreach($files as $f){
  $json = json_decode(file_get_contents("$dataDir/$f"),true);
  if($json) $polls[] = [
    'id'=>$json['id'],
    'title'=>$json['title'] ?? 'Sans titre',
    'mtime'=>filemtime("$dataDir/$f")
  ];
}
usort($polls, fn($a,$b)=>$b['mtime']<=>$a['mtime']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes sondages</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container">
      <h1 class="site-logo"><a href="index.php">GoSondage</a></h1>
      <nav class="site-nav">
        <a href="index.php" class="active">Accueil</a>
        <a href="logout.php">Déconnexion</a>
      </nav>
    </div>
  </header>
  <?php include 'header.php'; // ou ton header nav ?>
  <main class="site-main container">
    <div class="card">
      <h2>Mes sondages</h2>
      <?php if (empty($polls)): ?>
        <p>Aucun sondage. <a href="index.php">Crée-en un !</a></p>
      <?php else: ?>
        <ul class="poll-list">
          <?php foreach($polls as $p): ?>
            <li>
              <strong><?=htmlspecialchars($p['title'])?></strong><br>
              <small><?=date('d/m/Y H:i',$p['mtime'])?></small><br>
              <a href="sondage.php?id=<?=$p['id']?>">Voir / Voter</a>
            </li>
          <?php endforeach;?>
        </ul>
      <?php endif;?>
    </div>
  </main>
  <?php include 'footer.php'; ?>
  <div id="toast" class="toast">✅ Vote enregistré</div>

</body>
</html>
