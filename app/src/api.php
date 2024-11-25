<?php

declare(strict_types=1);

require 'playerdata.php';

define("THIS_SESSION", 'testsesh');

$request = $_SERVER['REQUEST_URI'];
$GLOBALS["routed"] = false;

// Definieren Sie eine einfache Routing-Funktion
function route($method, $path, $callback)
{
  global $request;
  if ($_SERVER['REQUEST_METHOD'] !== $method) {
    return false;
  }
  $pattern = '#^' . $path . '$#';
  if (!preg_match($pattern, $request)) {
    return false;
  }
  $callback();
  $GLOBALS["routed"] = true;
  return true;
}

// GET /players
route('GET', '/players', function () {
  echo json_encode(Player::createPlayers(THIS_SESSION));
});

route('POST', '/players/point', function() {
  if(!isset($_POST['username'])) echo "try ?username=urUserName";
  $player = Player::createPlayerFromData(THIS_SESSION, $_GET["username"]);
  $player->givePoint();
  $player->savePlayerData(THIS_SESSION);
  echo $_GET["username"] . "has now $player->points Points";
});

// POST /users
route('POST', '/players/create', function () {
  $newPlayer = new Player($_POST['username']);
  $newPlayer->savePlayerData(THIS_SESSION);
  echo json_encode(['message' => 'Neuer Benutzer erstellt', 'data' => $newPlayer]);
});
