<?php

declare(strict_types=1);

class Player
{
    public string $name;
    public int $points = 0;

    public function __construct(string $name, int $points = 0)
    {
        $this->name = $name;
        $this->points = $points;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function givePoint(): void
    {
        $this->points ++;
        echo '+1 Point';
    }


    public function savePlayerData(string $session): bool
    {
        if(!is_dir($session)) mkdir($session);
        try
        {
            file_put_contents("$session/$this->name.json", json_encode(["name"=>$this->name, "points"=>$this->getPoints()]));
            return true;
        } catch (Exception $e) {
            echo "Error: $e";
            return false;
        }
    }

    private static function stdClassToPlayer(stdClass $s)
    {
        return new Player($s->name, $s->points);
    }

    public static function createPlayerFromData(string $dir, string $name): Player
    {
        //TODO hier wird es fehler in windows geben
        $content = file_get_contents($dir . '/' . $name);

        if(!$content) die("File konnte nicht ausgelesen werden.");

        //erstellen des spieler objects
        return Player::stdClassToPlayer(json_decode($content));
    }

    public static function createPlayers(string $dir): array
    {
        $files = scandir($dir);
        if(!$files) return false;

        //remove . and .. from list
        $files = array_slice($files, 2);

        $players = [];
        foreach ($files as $file)
        {
            //TODO hier wird es fehler in windows geben
            $content = file_get_contents($dir . '/' . $file);

            if(!$content) die("File konnte nicht ausgelesen werden.");

            //erstellen des spieler objects
            array_push($players,Player::stdClassToPlayer(json_decode($content)));
        }
        return $players;
    }


    public function updatePlayerFromData(string $dir): void
    {
        //TODO hier wird es fehler in windows geben
        $content = file_get_contents($dir . '/' . $this->name . '.json');

        if(!$content) die("File konnte nicht ausgelesen werden.");

        //auslesen der Informationen der Datei
        $this->name = json_decode($content)->name;
        $this->points = json_decode($content)->points;
    }

    public function __toString()
    {
        return "Name: $this->name,\nPoints: $this->points";
    }
}

function testCreatePlayers()
{
    $testplayer = new Player('Test', 12);
    $testplayer2 = new Player('test2', 13);
    $testplayer3 = new Player('Test3');

    $testplayer->savePlayerData('testsesh');
    $testplayer2->savePlayerData('testsesh');
    $testplayer3->savePlayerData('testsesh');

    $players = Player::createPlayers('testsesh');

    foreach($players as $player)
    {
        print($player . "\n");
    }
}
