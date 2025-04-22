<?php
header('Content-Type: application/json');

$id     = $_POST['id']      ?? '';
$choice = isset($_POST['choice']) ? (int)$_POST['choice'] : null;
$file   = __DIR__ . "/data/{$id}.json";

if (!$id || $choice === null || !file_exists($file)) {
    http_response_code(400);
    echo json_encode(['status'=>'error','message'=>'Données invalides.']);
    exit;
}

$poll = json_decode(file_get_contents($file), true);

// On vérifie que l’option existe
if (!isset($poll['options'][$choice])) {
    http_response_code(400);
    echo json_encode(['status'=>'error','message'=>'Option invalide.']);
    exit;
}

// Incrémentation du vote
$poll['options'][$choice]['votes']++;
file_put_contents($file, json_encode($poll, JSON_PRETTY_PRINT));

// On renvoie le sondage mis à jour
echo json_encode(['status'=>'success','poll'=>$poll]);
