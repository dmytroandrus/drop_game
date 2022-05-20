<?php
require_once __DIR__ . '/classes/Player.php';
require_once __DIR__ . '/classes/Game.php';

try {
  $player1 = new Player('Заяц', 10);
  $player2 = new Player('Волк', 20);

  $game = new Game($player1, $player2);
  $game->play();
} catch (Exception $e) {
  echo $e->getMessage();
}
