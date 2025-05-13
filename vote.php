<?php
header('Content-Type: application/json');

$id     = $_POST['id']      ?? '';
$choices= $_POST['choices'] ?? [];
$file   = __DIR__ . "/data/{$id}.json";

//  Validation initiale
if (!$id || !file_exists($file) || !is_array($choices)) {
    http_response_code(400);
    echo json_encode(['status'=>'error','message'=>'Données invalides.']);
    exit;
}

// ⚠️ Charge le sondage pour vérifier la date de clôture
$poll = json_decode(file_get_contents($file), true);
$now  = time();

//  Blocage si clôturé
if (isset($poll['close']) && $now > $poll['close']) {
    http_response_code(403);
    echo json_encode(['status'=>'error','message'=>'Ce sondage est clôturé, plus de vote possible.']);
    exit;
}

// Poursuivre ton code d’incrémentation…
$choices = $_POST['choices'] ?? [];
// pas touché

header('Content-Type: application/json');
$id     = $_POST['id']           ?? '';
$choices= $_POST['choices']      ?? [];
$file   = __DIR__ . "/data/{$id}.json";

if (!$id || !file_exists($file) || !is_array($choices)) {
  http_response_code(400);
  echo json_encode(['status'=>'error','message'=>'Données invalides.']);
  exit;
}

$poll = json_decode(file_get_contents($file), true);

// Pour chaque réponse postée
foreach ($choices as $qIdx => $optIdx) {
  if (!isset($poll['questions'][$qIdx]['options'][$optIdx])) continue;
  $poll['questions'][$qIdx]['options'][$optIdx]['votes']++;
}

// Sauvegarde
file_put_contents($file, json_encode($poll, JSON_PRETTY_PRINT));
echo json_encode(['status'=>'success','poll'=>$poll]);
