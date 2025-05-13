<?php
// log de la méthode dans la console du serveur
file_put_contents('php://stdout', "▶ METHOD=" . ($_SERVER['REQUEST_METHOD'] ?? 'NULL') . "\n");
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    die('Accès interdit');
}
// Crée le dossier data si besoin
$dir = __DIR__ . '/data';
if (!is_dir($dir)) mkdir($dir, 0755);

// Récupère les données structurées
$title     = trim($_POST['title']     ?? '');
$description = trim($_POST['description'] ?? ''); // Ajoute la description
$closeRaw    = trim($_POST['close']       ?? '');
$questions = $_POST['questions']      ?? [];
$options   = $_POST['options']        ?? [];

// Validation minimale
if (!$title || !is_array($questions) || empty($questions)) {
    die('Il faut un titre et au moins une question.');
}

// Vérifie que date de clôture est bien au format datetime-local et future
$closeTs = strtotime($closeRaw);
if (!$closeRaw || $closeTs === false || $closeTs <= time()) {
    die('Date de clôture invalide (doit être une date future).');
}

// Prépare la structure
$poll = [
  'id'        => $id = uniqid('poll_'),
  'title'     => $title,
  'description' => $description,
  'close'       => $closeTs,
  'questions' => []
];

// Pour chaque question idx => label
foreach ($questions as $idx => $qLabel) {
    $qLabel = trim($qLabel);
    if ($qLabel === '') continue;
    $opts = [];
    foreach ($options[$idx] ?? [] as $optLabel) {
        $optLabel = trim($optLabel);
        if ($optLabel === '') continue;
        $opts[] = ['label'=>$optLabel, 'votes'=>0];
    }
    if (count($opts) < 2) {
        die("Chaque question doit avoir au moins 2 options ({$qLabel}).");
    }
    $poll['questions'][] = [
        'label'   => $qLabel,
        'options' => $opts
    ];
}

// 4. Sauvegarde au format JSON
file_put_contents("$dir/{$id}.json", json_encode($poll, JSON_PRETTY_PRINT));

// 5. Redirection vers la page de vote
header("Location: sondage.php?id={$id}");
exit;
