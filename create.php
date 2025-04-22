<?php
// 1. Récupération et nettoyage
$title   = trim($_POST['title'] ?? '');
$options = array_filter(array_map('trim', $_POST['options'] ?? []));

// 2. Validation
if (!$title || count($options) < 2) {
    die('Il faut un titre et au moins deux options.');
}

// 3. Préparation du sondage
$id = uniqid('poll_');
$poll = [
    'id'      => $id,
    'title'   => $title,
    'options' => array_map(fn($opt) => ['label'=>$opt,'votes'=>0], $options),
];

// 4. Sauvegarde JSON
file_put_contents(__DIR__ . "/data/{$id}.json", json_encode($poll, JSON_PRETTY_PRINT));

// 5. Redirection vers la page de vote
header("Location: sondage.php?id={$id}");
exit;
