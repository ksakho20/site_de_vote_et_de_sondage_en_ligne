<?php
header('Content-Type: application/json');

$id   = $_GET['id'] ?? '';
$file = __DIR__ . "/data/{$id}.json";

if (!$id || !file_exists($file)) {
    http_response_code(404);
    echo json_encode(['error'=>'Sondage introuvable.']);
    exit;
}

echo file_get_contents($file);
