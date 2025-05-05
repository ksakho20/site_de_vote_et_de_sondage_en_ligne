<?php
// create.php
// Ce fichier permet de créer un nouveau sondage
// et de le sauvegarder au format JSON.
// On commence par vérifier que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Accès interdit.');
}
// On vérifie que le dossier de sauvegarde existe
if (!is_dir(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0777, true);
}
// On vérifie que le fichier de sauvegarde est accessible
if (!is_writable(__DIR__ . '/data')) {
    die('Le dossier de sauvegarde n\'est pas accessible.');
}


// 1. Récupération et nettoyage
$title   = trim($_POST['title'] ?? '');
$options = array_filter(array_map('trim', $_POST['options'] ?? []));
$questions = array_filter(array_map('trim', $_POST['questions'] ?? []));
// 2. Validation
if (!$title || count($options) < 2) {
    die('Il faut un titre et au moins deux options.');
}

// 3. Préparation du sondage
$id = uniqid('poll_');
$poll = [
    'id'      => $id,
    'title'   => $title,
    'questions' => $questions,
    'options' => array_map(fn($opt) => ['label'=>$opt,'votes'=>0], $options),
];

// 4. Sauvegarde JSON
file_put_contents(__DIR__ . "/data/{$id}.json", json_encode($poll, JSON_PRETTY_PRINT));

// 5. Redirection vers la page de vote
header("Location: sondage.php?id={$id}");
exit;