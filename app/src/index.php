<?php

declare(strict_types=1);


// Setzen Sie den Content-Type Header auf JSON
header("Content-Type: application/json");

// Holen Sie sich den Request-Pfad
$request = $_SERVER['REQUEST_URI'];

// Entfernen Sie den Basispfad, falls vorhanden
$base_path = '/'; // Ändern Sie dies, wenn Ihre Anwendung in einem Unterverzeichnis läuft
$request = substr($request, strlen($base_path));

require 'api.php';

// Wenn kein Endpoint gefunden wurde
if (!$GLOBALS["routed"]) {
  http_response_code(404);
  echo json_encode(['error' => 'Endpoint nicht gefunden']);
}

function main() {}
