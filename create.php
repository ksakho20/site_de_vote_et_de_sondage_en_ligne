<?php
if ($_SERVER['REQUEST_METHOD'] ?? ''  !== 'POST') {
    die('Accès interdit');
}

// Crée le dossier data si besoin
$dir = __DIR__ . '/data';
if (!is_dir($dir)) mkdir($dir, 0755);

// Récupère les données structurées
$title     = trim($_POST['title']     ?? '');
$questions = $_POST['questions']      ?? [];
$options   = $_POST['options']        ?? [];

// Validation minimale
if (!$title || !is_array($questions) || empty($questions)) {
    die('Il faut un titre et au moins une question.');
}

// Prépare la structure
$poll = [
  'id'        => $id = uniqid('poll_'),
  'title'     => $title,
  'questions' => []
];

// Pour chaque question idx => label
foreach ($questions as $idx => $qLabel) {
    $qLabel = trim($qLabel);
    if ($qLabel === '') continue;
    $opts = [];
    // Parcours des options de cette question
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

// Sauvegarde JSON
file_put_contents("$dir/{$id}.json", json_encode($poll, JSON_PRETTY_PRINT));

// Redirection
header("Location: sondage.php?id={$id}");
exit;
